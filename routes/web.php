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


use App\QuikService\Constants\Auth\Role;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Get Mobile Login OTP from log
Route::get('otp', ['as' => 'otp', 'uses' => 'Controller@otp']);

// Verify the Email & Token.
Route::get('verify-email/{token}', ['as' => 'verify_email', 'uses' => 'ConfirmationController@verifyEmail']);

// Get the verify intimation.
Route::get('verify', ['as' => 'verify', 'uses' => 'ConfirmationController@verify']);

Route::namespace('Auth')
    ->group(function () {

        Route::prefix('login')
            ->group(function () {
                // Get Login View
                Route::get('/', ['as' => 'login_view', 'uses' => 'LoginController@view']);

                // Do Login
                Route::post('/', ['as' => 'login', 'uses' => 'LoginController@login']);
            }, null);

        // Do Logout
        Route::get('logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);

        // Request Mobile OTP
        Route::post('request-otp', ['as' => 'request_otp', 'uses' => 'LoginController@requestOTP']);

        Route::prefix('register')
            ->group(function () {

                // Get the Registration view
                Route::get('/', ['as' => 'register_view', 'uses' => 'RegisterController@view']);

                // Do the User Registration
                Route::post('/', ['as' => 'register', 'uses' => 'RegisterController@register']);
            }, null);

        Route::prefix('forgot-password')
            ->group(function () {

                // Get the Forgot Password view
                Route::get('/', ['as' => 'forgot_password_view', 'uses' => 'ForgotPasswordController@view']);

                // Submit the forgot password request
                Route::post('/', ['as' => 'forgot_password', 'uses' => 'ForgotPasswordController@forgotPassword']);
            }, null);

        Route::prefix('reset-password')
            ->group(function () {

                // Get the Reset Password view
                Route::get('{token}', ['as' => 'reset_password_view', 'uses' => 'ForgotPasswordController@resetView']);

                // Reset the password
                Route::post('{token}', ['as' => 'reset_password', 'uses' => 'ForgotPasswordController@reset']);
            }, null);

    }, null);

Route::middleware(role_middleware([Role::USER]))
    ->group(function () {

        //Get the Home page
        Route::get('home', ['as' => 'home', 'uses' => 'HomeController']);

    }, null);



Route::prefix('shops')
    ->namespace('Shop')
    ->group(function () {

        // Get Shop Register view
        Route::get('new', ['as' => 'add_new_shop', 'uses' => 'ShopRegistrationController@view']);

        Route::post('new', ['as' => 'register_shop', 'uses' => 'ShopRegistrationController@register']);



//        Route::get('/', ['as' => 'shop_list', 'uses' => 'ShopController@index']);



//        Route::get('{shop_code}/details', ['as' => 'shop_detail', 'uses' => 'ShopDetailController@show']);
}, null);

Route::prefix('availability-check')
    ->namespace('Verify')
    ->group(function () {

        // Check if a shop is available.
        Route::post('shop', ['as' => 'verify_shop', 'uses' => 'SignUpVerifyController@shop']);
    }, null);

