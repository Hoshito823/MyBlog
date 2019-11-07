<?php

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

//admin/以降に続くURLの処理を記述していく。->middleware('Auth')はリダイレクトされる際の処理
Route::group(['prefix' => 'admin', 'middleware' => 'auth'],function(){
    Route::get('blog/create','Admin\BlogController@add');
    Route::post('blog/create','Admin\BlogController@create');
    Route::get('blog/index','Admin\BlogController@index');
    Route::get('blog/edit','Admin\BlogController@edit');
    Route::get('blog/delete','Admin\BlogController@delete');
    Route::post('blog/edit','Admin\BlogController@update');
    Route::get('profile/create','Admin\ProfileController@add');
    Route::get('profile/edit','Admin\ProfileController@edit');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'BlogController@index');

