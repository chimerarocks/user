<?php

namespace ChimeraRocks\User\Providers;

use ChimeraRocks\User\Routing\Router;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
	public function boot()
	{
		$this->publishes([
			__DIR__ . '/../../../config/auth.php' => base_path('config/auth.php')
			],'config');

		$this->publishes([
			__DIR__ . '/../../../resources/migrations/' => base_path('database/migrations')
			],'migrations');

		$this->publishes([
			__DIR__ . '/../../../resources/views/auth' => base_path('resources/views/auth')
			],'auth');


		$this->loadViewsFrom(__DIR__ . '/../../../resources/views/chimerauser', 'chimerauser');

		require __DIR__ . '/../Routes.php';
	}

	/**
     * Register the service provider.
     *
     * @return void
     */
	public function register()
	{
		$this->app->bind(
			\ChimeraRocks\User\Repositories\UserRepositoryInterface::class,
				\ChimeraRocks\User\Repositories\UserRepositoryEloquent::class
		);

		$this->app->singleton('chimerarocks_user_route', function() {
			return new Router();
		});
	}
}