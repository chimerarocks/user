<?php

namespace Test\User\Repository;

use ChimeraRocks\User\Events\UserCreatedEvent;
use ChimeraRocks\User\Repositories\RoleRepositoryInterface;
use ChimeraRocks\User\Repositories\UserRepositoryEloquent;
use Illuminate\Support\Facades\Hash;
use Mockery;
use Test\AbstractTestCase;

class UserRepositoryTest extends AbstractTestCase
{

	private $repository;

	public function setUp()
	{
		parent::setUp();
		$this->migrate();
		$mock = Mockery::mock(RoleRepositoryInterface::class);
		$this->repository = new UserRepositoryEloquent($mock);
	}

	public function test_can_create_user()
	{
		$this->expectsEvents(UserCreatedEvent::class);
		$user = $this->repository->create([
			'name' => 'Teste',
			'email' => 'test@test.com',
			'password' => '654321'
		]);

		$this->assertEquals('Teste', $user->name);
		$this->assertEquals('test@test.com', $user->email);
		$this->assertTrue(Hash::check('654321', $user->password));
	}
}