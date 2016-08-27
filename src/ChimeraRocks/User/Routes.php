<?php

Route::group([
	'prefix' => 'admin/users', 
	'namespace' => 'ChimeraRocks\User\Controllers',
	'as' => 'admin.users.',
	'middleware' => ['web']
	], function() {
	Route::get('/', ['uses' => 'AdminUserController@index', 'as' => 'index']);
	Route::get('/create', ['uses' => 'AdminUserController@create', 'as' => 'create']);
	Route::user('/store', ['uses' => 'AdminUserController@store', 'as' => 'store']);
	Route::get('/edit/{id}', ['uses' => 'AdminUserController@edit', 'as' => 'edit']);
	Route::user('/update/{id}', ['uses' => 'AdminUserController@update', 'as' => 'update']);
	
});