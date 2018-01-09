<?php 

Route::group(['namespace' => 'Quarx\Modules\Companies\Controllers', 'prefix' => config('quarx.backend-route-prefix', 'quarx'), 'middleware' => ['web', 'auth', 'quarx']], function () { 

/*
|--------------------------------------------------------------------------
| Companies Routes
|--------------------------------------------------------------------------
*/

Route::resource('companies', 'CompaniesController', [ 'except' => ['show'], 'as' => config('quarx.backend-route-prefix', 'quarx') ]);
Route::post('companies/search', 'CompaniesController@search');

});