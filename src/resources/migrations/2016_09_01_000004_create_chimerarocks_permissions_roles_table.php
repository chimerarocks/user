<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChimerarocksPermissionsRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chimerarocks_permissions_roles', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->foreign('permission_id')->references('id')->on('chimerarocks_permissions');
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('chimerarocks_roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('chimerarocks_permissions_roles');
    }
}
