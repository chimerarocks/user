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
		$this->migrate();
	}

	public function test_can_create_user()
	{
		$user = $this->createUser();

		$this->assertEquals('Teste', $user->name);
		$this->assertEquals('test@test.com', $user->email);
		$this->assertTrue(Hash::check('654321', $user->password));
	}

	public function test_can_create_roles()
	{
		$this->createUser();
		//roles estão sendo criadas na migration
		$this->assertCount(3, $this->app->make(RoleRepositoryInterface::class)->all());
		$this->app->make(UserRepositoryInterface::class)->addRoles(1,[1,2,3]);
		//uma role já é adicionada para o user na migration
		$this->assertCount(4, User::find(1)->roles);
		//uma role já é adicionada para o user na migration
		$this->assertCount(2, Role::find(1)->users);
		$this->assertTrue(User::find(1)->isAdmin());
	}

	public function test_can_create_permissions()
	{
		//roles estão sendo criadas na migration
		$this->createPermissions();
		$this->assertCount(3, $this->app->make(RoleRepositoryInterface::class)->all());
		
		$this->app->make(RoleRepositoryInterface::class)->addPermissions(1,[1,2]);
		$this->app->make(RoleRepositoryInterface::class)->addPermissions(2,[1]);
		$this->app->make(RoleRepositoryInterface::class)->addPermissions(3,[1,2,3]);

		//roles estão sendo criadas na migration
		$this->assertCount(3, Role::find(2)->permissions);
		$this->assertCount(2, Role::find(1)->permissions);
		$this->assertCount(4, Role::find(3)->permissions);
		$this->assertCount(4, Permission::find(1)->roles);
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