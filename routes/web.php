<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//if name is AdminController itchu adalah Dashboard Controller
Route::get('/', 'AdminController@Dashboard')->name('Dashboard');
Route::get('/content/dashboard', 'AdminController@Dashboard');
//if name is NewsController itchu adalah News Controller
Route::get('/content/artikel', 'ArtikelController@index')->name('content.index');
Route::get('/content/artikel/datatables', 'ArtikelController@datatables')->name('content.datatables');
Route::get('/content/news', 'NewsController@index');
//if name is PromoController itchu adalah Promo Controller
Route::get('/content/promo', 'PromoController@index')->name('content.promo');
Route::get('/content/promo/dtPromo', 'PromoController@dtPromo')->name('content.dtPromo');