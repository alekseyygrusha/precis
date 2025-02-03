import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path'
import { createSvgIconsPlugin } from 'vite-plugin-svg-icons';


export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        createSvgIconsPlugin({
            iconDirs: [path.resolve(__dirname, 'resources/assets/icons')], // Путь к директории с SVG
            symbolId: 'icon-[dir]-[name]', // Формат id для иконок,
            generatePreviewHtml: true,
            inject: 'body-last' | 'body-first',
            svgoOptions: false, // Оптимизация SVG при помощи SVGO (по умолчанию включено)
        }),
    ],
    build: {
        rollupOptions: {
            input: {
                main: 'resources/js/app.js', // Основной входной файл
            },
        },
    },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'),
            '~': path.resolve(__dirname, 'node_modules')
        },
    }

});
