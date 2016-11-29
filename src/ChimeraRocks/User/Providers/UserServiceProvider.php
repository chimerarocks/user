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

		$this->publishes([
			__DIR__ . '/../../../resources/views/email' => base_path('resources/views/email')
			],'email');

		$this->publishes([
			__DIR__ . '/../../../resources/views/chimerauser' => base_path('resources/views/chimerauser')
		],'chimerauser');

		$this->publishes([
			__DIR__ . '/../../../resources/views/layouts' => base_path('resources/views/layouts')
		],'layouts');

		$this->loadViewsFrom(base_path('resources/views/chimerauser'), 'chimerauser');

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

		$this->app->bind(
			\ChimeraRocks\User\Repositories\RoleRepositoryInterface::class,
				\ChimeraRocks\User\Repositories\RoleRepositoryEloquent::class
		);

		$this->app->bind(
			\ChimeraRocks\User\Repositories\PermissionRepositoryInterface::class,
				\ChimeraRocks\User\Repositories\PermissionRepositoryEloquent::class
		);

		$this->app->register(
			\ChimeraRocks\User\Providers\EventServiceProvider::class
		);

		$this->app->register(
			\ChimeraRocks\User\Providers\AuthServiceProvider::class
		);

		$this->app->register(
			\Laravel\Passport\PassportServiceProvider::class
		);

		$this->app->singleton('chimerarocks_user_route', function() {
			return new Router();
		});
	}
}