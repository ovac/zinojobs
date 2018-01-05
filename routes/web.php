<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a given Closure or controller and enjoy the fresh air.
|
 */

Route::get('redis', function (User $id) {
});

Route::get('login/{id}', function (User $id) {
    Auth::login($id);
    return redirect('/');
});

Route::resource('jobs', 'JobController');

Route::resource('account', 'AccountController');

Route::resource('applications', 'ApplicationController');

Route::group(['prefix' => 'jobs/{job}', 'middleware' => 'auth'], function () {

    Route::resource('applications', 'ApplicationController');

    Route::group(['prefix' => 'applications/{application}'], function () {

        Route::resource('messages', 'MessageController');
    });
});

Route::group(['prefix' => 'employer', 'namespace' => 'Employer', 'middleware' => 'auth'], function () {

    Route::resource('setup', 'SetupController');
});

Route::group(['prefix' => 'employer', 'middleware' => ['auth', 'can-employ'], 'namespace' => 'Employer'], function () {

    Route::resource('jobs', 'JobController');

    Route::group(['prefix' => 'jobs/{job}', 'middleware' => 'auth'], function () {

        Route::resource('applications', 'ApplicationController');

        Route::group(['prefix' => 'applications/{application}'], function () {

            Route::resource('messages', 'MessageController');

            Route::resource('chat-schedule', 'ChatScheduleController');
        });
    });
});

/*
|--------------------------------------------------------------------------
| Welcome Page
|--------------------------------------------------------------------------
 */

Route::get('/', 'PagesController@home');

/*
|--------------------------------------------------------------------------
| Login/ Logout/ Password
|--------------------------------------------------------------------------
 */
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

/*
|--------------------------------------------------------------------------
| Registration & Activation
|--------------------------------------------------------------------------
 */
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::get('activate/token/{token}', 'Auth\ActivateController@activate');
Route::group(['middleware' => ['auth']], function () {
    Route::get('activate', 'Auth\ActivateController@showActivate');
    Route::get('activate/send-token', 'Auth\ActivateController@sendToken');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
 */
Route::group(['middleware' => ['auth']], function () {

    /*
    |--------------------------------------------------------------------------
    | General
    |--------------------------------------------------------------------------
     */

    Route::get('/users/switch-back', 'Admin\UserController@switchUserBack');

    /*
    |--------------------------------------------------------------------------
    | User
    |--------------------------------------------------------------------------
     */

    Route::group(['prefix' => 'user', 'namespace' => 'User'], function () {
        Route::get('settings', 'SettingsController@settings');
        Route::post('settings', 'SettingsController@update');
        Route::get('password', 'PasswordController@password');
        Route::post('password', 'PasswordController@update');
    });

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
     */

    Route::get('/dashboard', function () {
        return Redirect::to('quarx/dashboard');
    });

    /*
    |--------------------------------------------------------------------------
    | Admin
    |--------------------------------------------------------------------------
     */

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {

        Route::get('dashboard', 'DashboardController@index');

        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
         */
        Route::resource('users', 'UserController', ['except' => ['create', 'show']]);
        Route::post('users/search', 'UserController@search');
        Route::get('users/search', 'UserController@index');
        Route::get('users/invite', 'UserController@getInvite');
        Route::get('users/switch/{id}', 'UserController@switchToUser');
        Route::post('users/invite', 'UserController@postInvite');

        /*
        |--------------------------------------------------------------------------
        | Roles
        |--------------------------------------------------------------------------
         */
        Route::resource('roles', 'RoleController', ['except' => ['show']]);
        Route::post('roles/search', 'RoleController@search');
        Route::get('roles/search', 'RoleController@index');
    });
});
