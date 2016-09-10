<?php

Route::group([
	'prefix' => 'admin/', 
	'namespace' => 'ChimeraRocks\User\Controllers',
	'as' => 'admin.',
	'middleware' => ['web', 'auth']
	], function() {
	
	Route::group([
		'prefix' => 'users', 
		'as' => 'users.',
		'middleware' => ['access_users']
		], function() {
		Route::get('/', ['uses' => 'AdminUserController@index', 'as' => 'index']);
		Route::get('/create', ['uses' => 'AdminUserController@create', 'as' => 'create']);
		Route::post('/store', ['uses' => 'AdminUserController@store', 'as' => 'store']);
		Route::get('/edit/{id}', ['uses' => 'AdminUserController@edit', 'as' => 'edit']);
		Route::post('/update/{id}', ['uses' => 'AdminUserController@update', 'as' => 'update']);
	});

	Route::group([
		'prefix' => 'roles', 
		'as' => 'roles.',
		'middleware' => ['authorization:access_roles'],
		], function() {
		Route::get('/', ['uses' => 'AdminRoleController@index', 'as' => 'index']);
		Route::get('/create', ['uses' => 'AdminRoleController@create', 'as' => 'create']);
		Route::post('/store', ['uses' => 'AdminRoleController@store', 'as' => 'store']);
		Route::get('/edit/{id}', ['uses' => 'AdminRoleController@edit', 'as' => 'edit']);
		Route::post('/update/{id}', ['uses' => 'AdminRoleController@update', 'as' => 'update']);
	});
	
	Route::group([
		'prefix' => 'permissions', 
		'as' => 'permissions.', 
		'middleware' => ['authorization:access_permissions']
		], function() {
		Route::get('/', ['uses' => 'AdminPermissionController@index', 'as' => 'index']);
		Route::get('/view/{id}', ['uses' => 'AdminPermissionController@view', 'as' => 'view']);
	});
});