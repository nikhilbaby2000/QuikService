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


Route::prefix('shop')
    ->namespace('Shop')
    ->group(function () {
        Route::get('/', ['as' => 'shop_list', 'uses' => 'ShopController@index']);
        Route::get('{shop_code}/details', ['as' => 'shop_detail', 'uses' => 'ShopDetailController@show']);
});