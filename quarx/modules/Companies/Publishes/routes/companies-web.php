<?php 

Route::group(['namespace' => 'Quarx', 'middleware' => ['web']], function () {

/*
|--------------------------------------------------------------------------
| Company App Routes
|--------------------------------------------------------------------------
*/

Route::resource('companies', 'CompaniesController', ['only' => ['show', 'index']]);


});