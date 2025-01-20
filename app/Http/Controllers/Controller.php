<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * Создаём директории в public. Прописываем названия им такие, как в контроллерх, либо сами придумываем.
     * filtersParsingController - парсит данные фильтра из директории в которую сами загружаем файлы с сайта
     * parsingLinks - парсит все ссылки с загруженной в папку html-страницы. Затем он бежит на сайт с этими ссылками и скачивает все страницы и загружает их в папку (можно переделать и через ссылку на сайт)
     * parseDownloadPages - Пасит данные со страниц, которые мы скачали через parsingLinks.
     */
    use AuthorizesRequests, ValidatesRequests;

    public static function filtersParsingController()
    {
        $allFilters = [];
        $directoryPath = public_path('htmlPages/*.html');

        $files = glob($directoryPath);

        if (empty($files)) {
            die('В директории нет HTML-файлов.');
        }

        $files = glob($directoryPath);

        if (empty($files)) {
            die('В директории нет HTML-файлов.');
        }
        foreach ($files as $filePath) {
            $htmlContent = file_get_contents($filePath);

            if ($htmlContent === false) {
                die('Ошибка при чтении файла.');
            }

            // Используем регулярное выражение для поиска содержимого тега
            if (preg_match('/<script id="__NEXT_DATA__" type="application\/json">(.*?)<\/script>/s', $htmlContent, $matches)) {
                // Извлекаем JSON-данные
                $jsonData = $matches[1];

                // Декодируем JSON в PHP-массив или объект
                $data = json_decode($jsonData, true); // true для массива, false для объекта

                if (json_last_error() !== JSON_ERROR_NONE) {
                    die('Ошибка при декодировании JSON: ' . json_last_error_msg());
                }

                $filters = $data['props']['initialState']['catalogs']['filters'];
                $categoryName = $data['props']['initialState']['catalogs']['categoryName'];

                if(!$filters) {
                    die('Фильтры не обнаружены');
                }

                $filterData = [];
                foreach($filters as $filter) {
                    $name = $filter['name'];
                    $filterData[$name] = [];

                    if($filter['values']) {
                        foreach($filter['values'] as $value) {
                            $value = $value['name'];
                            $filterData[$name][]= $value;
                        }
                    }
                }
                $allFilters[$categoryName] = $filterData;
            } else {
                die('Тег <script id="__NEXT_DATA__"> не найден.');
            }
        }
        $filePath = public_path('filters.json'); // Укажите путь к файлу

        $jsonData = json_encode($allFilters, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        $result = file_put_contents($filePath, $jsonData);
        // 4. Проверяем, успешно ли записан файл
        if ($result === false) {
            die('Ошибка при записи JSON в файл.');
        } else {
            echo "Данные успешно записаны в файл: $filePath\n";
        }

    }

    public static function parsingLinks()
    {
        set_time_limit(300);
        $filePath = public_path('parseLinksPage/toyota.html'); //страница с которой собираем ссылки

        $htmlContent = file_get_contents($filePath);

        if ($htmlContent === false) {
            die('Ошибка при чтении файла.');
        }

        $linksPages = [];
        $siteUrl = 'https://emex.ru';
        if (preg_match('/<script id="__NEXT_DATA__" type="application\/json">(.*?)<\/script>/s', $htmlContent, $matches)) {
            $jsonData = $matches[1];

            // Декодируем JSON в PHP-массив или объект
            $data = json_decode($jsonData, true); // true для массива, false для объекта

            if (json_last_error() !== JSON_ERROR_NONE) {
                die('Ошибка при декодировании JSON: ' . json_last_error_msg());
            }

            $pageCategoryLink = $data['props']['initialProps']['pageProps']['pathname'];
            $pageCategoryId =  $data['props']['initialProps']['pageProps']['category'];

            $pageCategoryUrl = str_replace('[category]', $pageCategoryId, $pageCategoryLink) . '/';

            $pageProducts = $data['props']['initialState']['catalogs']['products'];
            foreach($pageProducts as $product) {
                $productLink = $siteUrl . $pageCategoryUrl . $product['productId'] . '?productCode=' . $product['productCode'];
                $linksPages[] = $productLink;
            }


            $directory = public_path('parseLinksPage/downloadPages');
            //Проверяем, существует ли директория, и создаём её, если нет
            if (!is_dir($directory)) {
                mkdir($directory, 777, true); // Создаём директорию с правами 0755
            }

            if (File::exists($directory)) {
                // Очищаем директорию
                File::cleanDirectory($directory);
                echo "Директория $directory успешно очищена.\n";
            }

            foreach ($linksPages as $index => $linkPage) {
                $url = $linkPage;
                //Получаем содержимое страницы
                $content = file_get_contents($url);

                if ($content === false) {
                    die('Ошибка при получении содержимого страницы.');
                }

                // 3. Сохраняем содержимое в файл
                $filePath = $directory . '/' . 'Page_' . $index . '.html';
                $result = file_put_contents($filePath, $content);

                // 4. Проверяем, успешно ли сохранён файл
                if ($result === false) {
                    die('Ошибка при сохранении файла.');
                } else {
                    echo "Страница успешно сохранена в файл: $filePath\n";
                }

                sleep(1);
            }

            echo "Все прошло успешно. Все страницы сохранены в директорию";
            /*dd($linksPages);
            dd($data['props']['initialState']['catalogs']);*/
        } else {
            die('Тег <script id="__NEXT_DATA__"> не найден.');
        }
    }

    public static function parseDownloadPages()
    {
        $directory = public_path('parseLinksPage/downloadPages/*.html');
        if(empty($directory)) {
            die('Папка пуста или не существует');
        }

        $files = glob($directory);
        $pagesData = [];
        foreach ($files as $filePath) {

            $htmlContent = file_get_contents($filePath);

            if ($htmlContent === false) {
                die('Ошибка при чтении файла.');
            }

            // Используем регулярное выражение для поиска содержимого тега
            if (preg_match('/<script id="__NEXT_DATA__" type="application\/json">(.*?)<\/script>/s', $htmlContent, $matches)) {

                $jsonData = $matches[1];

                // Декодируем JSON в PHP-массив или объект
                $data = json_decode($jsonData, true); // true для массива, false для объекта

                //ПАРСИНГ ДАННЫХ СТРАНИЦЫ
                $initialProps = $data['props']['initialProps'];
                $initialState = $data['props']['initialState'];

                $pageProduct = $initialState['catalogs']['product']['product'];

                $parsePageData = [
                    'Артикул' => $initialProps['pageProps']['productCode'],
                    'Название' => $pageProduct['productName'],
                    'Описание' => $pageProduct['description'],
                    'Цена' => $pageProduct['price']['value'],
                    'Категория' => $initialState['catalogs']['categoryName']
                ];

                $characteristics = [];

                foreach ($pageProduct['properties'] as $characteristics_item) {
                    $characteristics[$characteristics_item['caption']] = $characteristics_item['value'];
                }

                $parsePageData['Характеристики'] = $characteristics;
                $pagesData[$pageProduct['productName']][] = $parsePageData;


                //ПАРСИНГ ДАННЫХ СТРАНИЦЫ
            }
        }

        $filePath = public_path('pagesData.json'); // Файл в который выгрузим парсинг страниц

        $jsonData = json_encode($pagesData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        $result = file_put_contents($filePath, $jsonData);
        // 4. Проверяем, успешно ли записан файл
        if ($result === false) {
            die('Ошибка при записи JSON в файл.');
        } else {
            echo "Данные успешно записаны в файл: $filePath\n";
        }

    }
}
