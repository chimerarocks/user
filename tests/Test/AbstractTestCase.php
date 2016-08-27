<?php

namespace Test;

use Orchestra\Testbench\TestCase;

abstract class AbstactTestCase extends TestCase
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
	    $app['config']->set('database.default', 'testbench');
	    $app['config']->set('database.connections.testbench', [
	        'driver'   => 'sqlite',
	        'database' => ':memory:',
	        'prefix'   => '',
	    ]);

	    config(['auth' => require __DIR__ . '/../../src/config/auth.php']);
	}

	public function migrate()
	{
		$this->artisan('migrate', [
			'--realpath' => realpath(__DIR__ . '/../../src/resources/migrations')
		]);
	}

	public function getPackageProviders($app)
	{
		return [
			\Illuminate\Auth\AuthServiceProvider::class,
			\Illuminate\Auth\Passwords\PasswordResetServiceProvider::class
		];
	}
}