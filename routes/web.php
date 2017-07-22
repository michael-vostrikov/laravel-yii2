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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
    Route::get('/order', 'OrderController@index')->name('order.index');
    Route::get('/order/view/{id}', 'OrderController@view')->name('order.view');
    Route::get('/order/create', 'OrderController@create')->name('order.create');
    Route::get('/order/update/{id}', 'OrderController@update')->name('order.update');
    Route::post('/order/create', 'OrderController@create');
    Route::post('/order/update/{id}', 'OrderController@update');
    Route::post('/order/delete/{id}', 'OrderController@delete')->name('order.delete');
});
