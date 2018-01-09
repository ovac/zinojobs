<?php 

Route::group(['namespace' => 'Quarx\Modules\Jobs\Controllers', 'prefix' => config('quarx.backend-route-prefix', 'quarx'), 'middleware' => ['web', 'auth', 'quarx']], function () { 

/*
|--------------------------------------------------------------------------
| Jobs Routes
|--------------------------------------------------------------------------
*/

Route::resource('jobs', 'JobsController', [ 'except' => ['show'], 'as' => config('quarx.backend-route-prefix', 'quarx') ]);
Route::post('jobs/search', 'JobsController@search');

});