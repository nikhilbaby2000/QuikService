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


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::namespace('Auth')
    ->group(function () {
        Route::get('login', ['as' => 'login_view', 'uses' => 'LoginController@showLoginForm']);
        Route::post('login', ['as' => 'login', 'uses' => 'LoginController@loginBy']);
        Route::post('request-otp', ['as' => 'request_otp', 'uses' => 'LoginController@requestOTP']);

        Route::get('logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);

        Route::get('register', ['as' => 'register_view', 'uses' => 'RegisterController@showRegistrationForm']);
        Route::post('register', ['as' => 'register', 'uses' => 'RegisterController@register']);

        Route::get('forgot-password', ['as' => 'forgot_password', 'uses' => 'LoginController@forgotPassword']);

    });

Route::prefix('shop')
    ->namespace('Shop')
    ->group(function () {
        Route::get('/', ['as' => 'shop_list', 'uses' => 'ShopController@index']);
        Route::get('{shop_code}/details', ['as' => 'shop_detail', 'uses' => 'ShopDetailController@show']);
});