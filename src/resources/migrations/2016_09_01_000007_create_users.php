<?php

use ChimeraRocks\User\Models\Permission;
use ChimeraRocks\User\Models\Role;
use ChimeraRocks\User\Models\User;
use Illuminate\Database\Migrations\Migration;

class CreateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $roleAdmin = Role::where('name', Role::ROLE_ADMIN)->first();
    	
        $user = User::create([
            'name' => 'Administrator',
            'email' => 'admin@user.com',
            'password' => bcrypt(123546)
        ]);

    	$user->roles()->save($roleAdmin);
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
