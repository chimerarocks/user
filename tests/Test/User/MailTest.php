<?php

namespace Test\User;

use ChimeraRocks\User\Events\UserCreatedEvent;
use ChimeraRocks\User\Repositories\UserEloquentInterface;
use ChimeraRocks\User\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Mockery;
use Test\AbstactMailTestCase;

class MailTest extends AbstactMailTestCase
{

	private $repository;

	public function setUp()
	{
		parent::setUp();
		$this->migrate();
		$this->repository = new UserRepositoryEloquent();
	}

	public function test_can_create_user()
	{
		$user = $this->repository->create([
			'name' => 'Teste',
			'email' => 'test@test.com',
			'password' => '654321'
		]);

		$this->assertEquals('Test', $user->name);
		$this->assertEquals('test@test.com', $user->email);
		$this->assertTrue(Hash::check('123456', $user->password));
	}
}