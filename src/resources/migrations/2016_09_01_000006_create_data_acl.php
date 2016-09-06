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
    	$roleEditor = Role::create([
        	'name' => Role::ROLE_EDITOR
    	]);
    	$roleRedator = Role::create([
        	'name' => Role::ROLE_REDATOR
    	]);

    	$permissionPublishPost = Permission::create([
    		'name' => 'publish_post',
    		'desctipion' => 'Permissão para publicar posts que estão em rascunho'
		]);
		$permissionAccessCatogeries = Permission::create([
    		'name' => 'access_categories',
    		'desctipion' => 'Permissão para acessar a àrea de categorias'
		]);
		$permissionAccessTags = Permission::create([
    		'name' => 'access_tags',
    		'desctipion' => 'Permissão para acessar a àrea de tags'
		]);
		$permissionAccessPosts = Permission::create([
    		'name' => 'access_posts',
    		'desctipion' => 'Permissão para acessar a àrea de posts'
		]);
		$permissionAccessUsers = Permission::create([
    		'name' => 'access_users',
    		'desctipion' => 'Permissão para acessar a àrea de users'
		]);

    	$roleEditor->permissions()->save($permissionPublishPost);
    	$roleEditor->permissions()->save($permissionAccessPosts);

    	$roleRedator->permissions()->save($permissionAccessPosts);
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
