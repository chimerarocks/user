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

		$permissionAccessUsers = Permission::create([
			'name' => 'access_users',
			'desctipion' => 'Permissão para acessar a àrea de usuários'
		]);

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
