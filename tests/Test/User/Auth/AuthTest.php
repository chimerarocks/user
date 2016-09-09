<?php

namespace Test\User\Models;

use ChimeraRocks\User\Models\User;
use Illuminate\Support\Facades\Auth;
use Orchestra\Testbench\Traits\WithFactories;
use Test\AbstractTestCase;

class AuthTest extends AbstractTestCase
{
	use WithFactories;

	public function setUp()
	{
		parent::setUp();
		$this->migrate();
		$this->withFactories(__DIR__ . '/../../../../src/resources/factories');
	}
	
	public function test_check_if_not_authenticated()
	{
		$this->assertFalse(Auth::check());
	}	

	public function test_check_if_is_authenticated()
	{
		$user = factory(User::class)->create();
		Auth::login($user);
		$this->assertTrue(Auth::check());
	}
}