<?php

namespace ChimeraRocks\User\Repositories;

use ChimeraRocks\Database\Contracts\CriteriaCollectionInterface;
use ChimeraRocks\Database\Contracts\RepositoryInterface;

interface RoleRepositoryInterface extends RepositoryInterface, CriteriaCollectionInterface
{
	public function addPermissions($id, array $permissions);

	public function lists($column, $key = null);
}