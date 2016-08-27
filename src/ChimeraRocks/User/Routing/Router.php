<?php

namespace ChimeraRocks\User\Routing;

use Illuminate\Support\Facades\Route;

class Router
{
	public function auth()
	{	
		$namespace = "\\ChimeraRocks\\User\\Controllers";

		Route::group(['namespace' => null], function () use ($namespace) {
			// Authentication Routes...
	        Route::get('login', $namespace . '\\Auth\AuthController@showLoginForm');
	        Route::post('login', $namespace . '\\Auth\\AuthController@login');
	        Route::get('logout', $namespace . '\\Auth\\AuthController@logout');

	        // Password Reset Routes...
	        Route::get('password/reset/{token?}', $namespace . '\\Auth\\PasswordController@showResetForm');
	        Route::post('password/email', $namespace . '\\Auth\\PasswordController@sendResetLinkEmail');
	        Route::post('password/reset', $namespace . '\\Auth\\PasswordController@reset');
		});
	}
}