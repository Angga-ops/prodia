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
    //if name is ArtikelController itchu adalah menu Artikel 
    Route::get('/', 'ArtikelController@index')->name('content.index');
    Route::get('/content/artikel/show/{article_id}', 'ArtikelController@show')->name('artikel.show');
    Route::get('/content/artikel/delete/{article_id}', 'ArtikelController@destroy')->name('artikel.delete');
    Route::post('/content/artikel/tambah', 'ArtikelController@addArticle')->name('artikel.add');
    Route::post('/content/artikel/edit/{article_id}', 'ArtikelController@editArticle')->name('artikel.edit');
    
    // Route::get('/content/artikel/datatables', 'ArtikelController@datatables')->name('content.datatables');
    
    //if name is PromoController itchu adalah Promo Controller
    Route::get('/content/promo', 'PromoController@index')->name('content.promo');
    Route::post('/content/promo/add', 'PromoController@add')->name('content.promo.add');
    Route::get('/content/promo/{promo_id}', 'PromoController@delete')->name('content.promo.delete');
    Route::post('/content/promo/{promo_id}', 'PromoController@edit')->name('content.promo.edit');
    //Controller Diskusi
    Route::get('/content/diskusi', 'DiskusiController@index')->name('content.diskusi');
    //COntroller Forum
    Route::get('/content/forum', 'ForumController@index')->name('content.forum');
    Route::get('/form/forum/{forum_id}', 'ForumController@detail')->name('forum.detail');
    Route::post('/form/forum/detail/{forum_id}', 'ForumController@reply')->name('reply.tambah');

    Route::get('/forum/delete/{forum_reply_id}', 'ForumController@deleteReply')->name('delete.reply');

    Route::get('/form/forum/tambah/index', 'ForumController@add')->name('forum.tambah');
    Route::post('/form/forum/tambah/index', 'ForumController@post')->name('forum.post');
    Route::get('/content/forum/{forum_id}', 'ForumController@delete')->name('forum.delete');
    Route::get('/logout', 'AuthController@logout')->name('logout');
});

Route::middleware(['auth_denied'])->group(function(){
    Route::match(['get','post'], '/login', 'AuthController@index')->name('login');
});
