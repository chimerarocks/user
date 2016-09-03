<?php

namespace ChimeraRocks\User\Repositories;

use ChimeraRocks\Database\Contracts\CriteriaCollectionInterface;
use ChimeraRocks\Database\Contracts\RepositoryInterface;

interface PermissionRepositoryInterface extends RepositoryInterface, CriteriaCollectionInterface
{
	public function lists($column, $key = null);
}