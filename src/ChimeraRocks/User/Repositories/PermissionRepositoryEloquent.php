<?php

namespace ChimeraRocks\User\Repositories;

use ChimeraRocks\Database\AbstractEloquentRepository;
use ChimeraRocks\User\Models\Permission;
use ChimeraRocks\User\Repositories\PermissionRepositoryInterface;

class PermissionRepositoryEloquent extends AbstractEloquentRepository implements PermissionRepositoryInterface
{
	public function model()
	{
		return Permission::class;
	}

	public function lists($column, $key = null)
	{
		$this->applyCriteria();
		$permissions = $this->model->get([$column, 'id']);

		$list = [];
		foreach ($permissions as $p) {
			$list[$p->id] = $p->$column;
		}

		return $list;
	}
}