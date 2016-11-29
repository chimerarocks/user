<?php

namespace ChimeraRocks\User\Repositories;

use ChimeraRocks\Database\AbstractEloquentRepository;
use ChimeraRocks\User\Events\UserCreatedEvent;
use ChimeraRocks\User\Models\Role;
use ChimeraRocks\User\Models\User;
use ChimeraRocks\User\Repositories\RoleRepositoryInterface;

class RoleRepositoryEloquent extends AbstractEloquentRepository implements RoleRepositoryInterface
{
	private $permissionRepo;

	public function __construct(PermissionRepositoryInterface $permissionRepo)
	{
		parent::__construct();
		$this->permissionRepo = $permissionRepo;
	}

	public function model()
	{
		return Role::class;
	}

	public function addPermissions($id, array $permissions)
	{
		$model = $this->find($id);
		foreach ($permissions as $permission) {
			$model->permissions()->save($this->permissionRepo->find($permission));
		}
		return $model;
	}

	public function lists($column, $key = null)
	{
		$this->applyCriteria();
		$roles = $this->model->get([$column, 'id']);

		$list = [];
		foreach ($roles as $p) {
			$list[$p->id] = $p->$column;
		}

		return $list;
	}
}