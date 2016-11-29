<?php

namespace ChimeraRocks\User\Routing;

use Illuminate\Support\Facades\Route;

class Router
{
	use \Illuminate\Console\AppNamespaceDetectorTrait;
	public function auth()
	{
		dd($this->getAppNamespace());
		$namespace = "\\ChimeraRocks\\User\\Controllers";

		Route::group(['namespace' => null], function () use ($namespace) {
			// Authentication Routes...
	        Route::get('login', $namespace . '\\Auth\\LoginController@showLoginForm');
	        Route::post('login', $namespace . '\\Auth\\LoginController@login');
	        Route::get('logout', $namespace . '\\Auth\\LoginController@logout');

	        // Password Reset Routes...
	        Route::get('password/reset/{token?}', $namespace . '\\Auth\\ForgotPasswordController@showResetForm');
	        Route::post('password/email', $namespace . '\\Auth\\ForgotPasswordController@sendResetLinkEmail');
	        Route::post('password/reset', $namespace . '\\Auth\\ForgotPasswordController@reset');
		});
	}
}