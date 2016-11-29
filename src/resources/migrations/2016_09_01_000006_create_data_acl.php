<?php

use ChimeraRocks\User\Models\Permission;
use ChimeraRocks\User\Models\Role;
use Illuminate\Database\Migrations\Migration;

class CreateDataAcl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		$roleAdmin = Role::create([
			'name' => Role::ROLE_ADMIN
		]);

		$permissionAccessRoles = Permission::create([
			'name' => 'access_permissions',
			'desctiption' => 'Permissão para acessar a àrea de papéis'
		]);
		$permissionAccessPermissions = Permission::create([
			'name' => 'access_roles',
			'desctiption' => 'Permissão para acessar a àrea de permissões'
		]);
		$permissionAccessUsers = Permission::create([
			'name' => 'access_users',
			'desctiption' => 'Permissão para acessar a àrea de users'
		]);

		$roleAdmin->permissions()->save($permissionAccessRoles);
		$roleAdmin->permissions()->save($permissionAccessPermissions);
		$roleAdmin->permissions()->save($permissionAccessUsers);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
