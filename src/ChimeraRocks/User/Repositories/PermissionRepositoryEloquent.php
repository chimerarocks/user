<?php

namespace ChimeraRocks\User\Repositories;

use ChimeraRocks\Database\AbstractEloquentRepository;
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
		return $this->model->lists($column, $key);
	}
}