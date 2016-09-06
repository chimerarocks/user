<?php

namespace Test\User;

use ChimeraRocks\User\Events\UserCreatedEvent;
use ChimeraRocks\User\Models\Permission;
use ChimeraRocks\User\Models\Role;
use ChimeraRocks\User\Models\User;
use ChimeraRocks\User\Repositories\PermissionRepositoryInterface;
use ChimeraRocks\User\Repositories\RoleRepositoryInterface;
use ChimeraRocks\User\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Mockery;
use Test\AbstractTestCase;

class AuthorizationRepositoryTest extends AbstractTestCase
{
	public function setUp()
	{
		parent::setUp();
		$this->migrateRefresh();
	}

	public function test_can_create_user()
	{
		$user = $this->createUser();

		$this->assertEquals('Test', $user->name);
		$this->assertEquals('test@test.com', $user->email);
		$this->assertTrue(Hash::check('123456', $user->password));
	}

	public function test_can_create_roles()
	{
		$this->createUser();
		$this->createRoles();
		$this->assertCount(3, $this->app->make(PermissionRepositoryInterface::class)->all());
		$this->app->make(UserRepositoryInterface::class)->addRoles(1,[1,2,3]);
		$this->assertCount(3, User::find(1)->roles);
		$this->assertCount(1, Role::find(1)->users);
		$this->assertTrue(User::find(1)->isAdmin());
	}

	public function test_can_create_permissions()
	{
		$this->createRoles();
		$this->createPermission();
		$this->assertCount(3, $this->app->make(RoleRepositoryInterface::class)->all());
		
		$this->app->make(RoleRepositoryInterface::class)->addPermissions(1,[1,2]);
		$this->app->make(RoleRepositoryInterface::class)->addPermissions(2,[1]);
		$this->app->make(RoleRepositoryInterface::class)->addPermissions(3,[1,2,3]);

		$this->assertCount(1, Role::find(2)->permissions);
		$this->assertCount(2, Role::find(1)->permissions);
		$this->assertCount(3, Role::find(3)->permissions);
		$this->assertCount(3, Permission::find(1)->roles);
	}

	public function createUser()
	{
		$this->expectsEvents(UserCreatedEvent::class);
		return $this->app->make(UserRepositoryInterface::class)->create([
			'name' => 'Teste',
			'email' => 'test@test.com',
			'password' => '654321'
		]);
	}

	public function createRoles()
	{
		$this->app->make(RoleRepositoryInterface::class)->create([
			'name' => 'Admin'
		]);

		$this->app->make(RoleRepositoryInterface::class)->create([
			'name' => 'Editor'
		]);

		$this->app->make(RoleRepositoryInterface::class)->create([
			'name' => 'Redator'
		]);
	}

	public function createPermissions()
	{
		$this->app->make(PermissionRepositoryInterface::class)->create([
			'name' => 'insert'
		]);

		$this->app->make(PermissionRepositoryInterface::class)->create([
			'name' => 'update'
		]);

		$this->app->make(PermissionRepositoryInterface::class)->create([
			'name' => 'remove'
		]);
	}
}