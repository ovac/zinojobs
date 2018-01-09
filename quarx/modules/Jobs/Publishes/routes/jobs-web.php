<?php 

Route::group(['namespace' => 'Quarx', 'middleware' => ['web']], function () {

/*
|--------------------------------------------------------------------------
| Job App Routes
|--------------------------------------------------------------------------
*/

Route::resource('jobs', 'JobsController', ['only' => ['show', 'index']]);


});