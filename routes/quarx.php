<?php
/*
|--------------------------------------------------------------------------
| Quarx Routes
|--------------------------------------------------------------------------
 */

Route::group(['namespace' => 'Quarx', 'middleware' => ['quarx-language', 'quarx-analytics']], function () {
    Route::get('', 'PagesController@home');
    Route::get('pages', 'PagesController@all');
    Route::get('page/{url}', 'PagesController@show');
    Route::get('p/{url}', 'PagesController@show');

    Route::get('gallery', 'GalleryController@all');
    Route::get('gallery/{tag}', 'GalleryController@show');

    Route::get('blog', 'BlogController@all');
    Route::get('blog/{url}', 'BlogController@show');
    Route::get('blog/tags/{tag}', 'BlogController@tag');

    Route::get('faqs', 'FaqController@all');

    Route::get('events', 'EventsController@calendar');
    Route::get('events/{month}', 'EventsController@calendar');
    Route::get('events/all', 'EventsController@all');
    Route::get('events/date/{date}', 'EventsController@date');
    Route::get('events/event/{id}', 'EventsController@show');
});

// /*
// |--------------------------------------------------------------------------
// | Login/ Logout/ Password
// |--------------------------------------------------------------------------
//  */
// Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('login', 'Auth\LoginController@login');
// Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// // Password Reset Routes...
// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// /*
// |--------------------------------------------------------------------------
// | Registration & Activation
// |--------------------------------------------------------------------------
//  */
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');

// Route::get('activate/token/{token}', 'Auth\ActivateController@activate');
// Route::group(['middleware' => ['auth']], function () {
//     Route::get('activate', 'Auth\ActivateController@showActivate');
//     Route::get('activate/send-token', 'Auth\ActivateController@sendToken');
// });

// /*
// |--------------------------------------------------------------------------
// | Authenticated Routes
// |--------------------------------------------------------------------------
//  */
// Route::group(['middleware' => ['auth']], function () {

//     /*
//     |--------------------------------------------------------------------------
//     | General
//     |--------------------------------------------------------------------------
//      */

//     Route::get('/users/switch-back', 'Admin\UserController@switchUserBack');

//     /*
//     |--------------------------------------------------------------------------
//     | User
//     |--------------------------------------------------------------------------
//      */

//     Route::group(['prefix' => 'user', 'namespace' => 'User'], function () {
//         Route::get('settings', 'SettingsController@settings');
//         Route::post('settings', 'SettingsController@update');
//         Route::get('password', 'PasswordController@password');
//         Route::post('password', 'PasswordController@update');
//     });

//     /*
//     |--------------------------------------------------------------------------
//     | Admin
//     |--------------------------------------------------------------------------
//      */

//     Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {

//         Route::get('dashboard', 'DashboardController@index');

//         /*
//         |--------------------------------------------------------------------------
//         | Users
//         |--------------------------------------------------------------------------
//          */
//         Route::resource('users', 'UserController', ['except' => ['create', 'show']]);
//         Route::post('users/search', 'UserController@search');
//         Route::get('users/search', 'UserController@index');
//         Route::get('users/invite', 'UserController@getInvite');
//         Route::get('users/switch/{id}', 'UserController@switchToUser');
//         Route::post('users/invite', 'UserController@postInvite');

//         /*
//         |--------------------------------------------------------------------------
//         | Roles
//         |--------------------------------------------------------------------------
//          */
//         Route::resource('roles', 'RoleController', ['except' => ['show']]);
//         Route::post('roles/search', 'RoleController@search');
//         Route::get('roles/search', 'RoleController@index');
//     });
// });
