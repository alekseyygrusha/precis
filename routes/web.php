<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/parsing', [Controller::class, 'filtersParsingController']);
Route::get('/parsingLinks', [Controller::class, 'parsingLinks']);
Route::get('/parsingPages', [Controller::class, 'parseDownloadPages']);

/*Route::get('/{url}', fn() => view('index'))
    ->where('url', '.*');*/
