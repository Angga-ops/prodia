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

Route::middleware(['auth_granted'])->group(function(){
    // Route::get('/', 'AdminController@Dashboard')->name('Dashboard');
    // Route::get('/content/dashboard', 'AdminController@Dashboard');
    //if name is NewsController itchu adalah News Controller
    Route::get('/', 'ArtikelController@index')->name('content.index');
    Route::get('/content/artikel/show/{article_id}', 'ArtikelController@show')->name('artikel.show');
    Route::get('/content/artikel/delete/{article_id}', 'ArtikelController@destroy')->name('artikel.delete');
    Route::get('/content/artikel/datatables', 'ArtikelController@datatables')->name('content.datatables');
    //if name is PromoController itchu adalah Promo Controller
    Route::get('/content/promo', 'PromoController@index')->name('content.promo');
    Route::post('/content/promo/add', 'PromoController@add')->name('content.promo.add');
    Route::get('/content/promo/{promo_id}', 'PromoController@delete')->name('content.promo.delete');
    Route::post('/content/promo/{promo_id}', 'PromoController@delete')->name('content.promo.edit');
    Route::get('/logout', 'AuthController@logout')->name('logout');
});

Route::middleware(['auth_denied'])->group(function(){
    Route::match(['get','post'], '/login', 'AuthController@index')->name('login');
});
