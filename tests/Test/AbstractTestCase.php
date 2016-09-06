<?php

namespace Test;

use Orchestra\Testbench\TestCase;

abstract class AbstractTestCase extends TestCase
{
	/**
	 * Copied from https://github.com/orchestral/testbench
	 * Define environment setup.
	 *
	 * @param  \Illuminate\Foundation\Application  $app
	 * @return void
	 */
	protected function getEnvironmentSetUp($app)
	{
	    // Setup default database to use sqlite :memory:
	    // $app['config']->set('database.default', 'testbench');
	    // $app['config']->set('database.connections.testbench', [
	    //     'driver'   => 'sqlite',
	    //     'database' => ':memory:',
	    //     'prefix'   => '',
	    // ]);

	    config(['database' => require __DIR__ . '/config/database.php']);

	    config(['auth' => require __DIR__ . '/../../src/config/auth.php']);
	}

	public function migrate()
	{
		$this->artisan('migrate', [
			'--realpath' => realpath(__DIR__ . '/../../src/resources/migrations')
		]);
	}

	public function migrateRefresh()
	{
		$this->artisan('migrate:refresh', [
			'--realpath' => realpath(__DIR__ . '/../../src/resources/migrations')
		]);
	}

	public function migrateReset()
	{
		$this->artisan('migrate:reset', [
			'--realpath' => realpath(__DIR__ . '/../../src/resources/migrations')
		]);
	}

	public function getPackageProviders($app)
	{
		return [
			\Illuminate\Auth\AuthServiceProvider::class,
			\Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
			\ChimeraRocks\User\Providers\UserServiceProvider::class,
		];
	}
}