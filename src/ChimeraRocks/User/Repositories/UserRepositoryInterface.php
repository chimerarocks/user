<?php

namespace ChimeraRocks\User\Repositories;

use ChimeraRocks\Database\Contracts\CriteriaCollectionInterface;
use ChimeraRocks\Database\Contracts\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface, CriteriaCollectionInterface
{
	public function addRoles($id, array $roles);

	public function removeRoles($id);

	public function listRoles($column, $id);
}