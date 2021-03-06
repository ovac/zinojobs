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
Route::get('test', function () {
    return view('test');
});

Route::get('login/{id}', function (User $id) {
    Auth::login($id);
    return redirect('/');
});

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
 */
Route::view('/', 'quarx-frontend::pages.home');

Route::get('/dashboard', function () {
    return Redirect::to('/');
});

Route::resource('jobs', 'JobController');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
 */
Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
 */
Route::group(['middleware' => 'auth'], function () {

    Route::resource('account', 'AccountController');

    Route::resource('applications', 'ApplicationController');

    Route::group(['prefix' => 'jobs/{job}'], function () {

        Route::resource('applications', 'ApplicationController');

        Route::group(['prefix' => 'applications/{application}'], function () {

            Route::resource('messages', 'MessageController');
        });
    });

    Route::group(['prefix' => 'employer', 'namespace' => 'Employer'], function () {

        Route::resource('setup', 'SetupController');

        Route::group(['middleware' => 'can-employ'], function () {

            Route::resource('jobs', 'JobController');

            Route::group(['prefix' => 'jobs/{job}'], function () {

                Route::resource('applications', 'ApplicationController');

                Route::group(['prefix' => 'applications/{application}'], function () {

                    Route::resource('messages', 'MessageController');

                    Route::resource('invitation', 'InvitationController');
                });
            });
        });
    });
});
