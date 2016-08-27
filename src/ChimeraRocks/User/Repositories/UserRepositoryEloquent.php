<?php

namespace ChimeraRocks\User\Repositories;

use ChimeraRocks\User\Models\User;
use ChimeraRocks\User\Repositories\UserRepositoryInterface;
use ChimeraRocks\Database\AbstractEloquentRepository;

class UserRepositoryEloquent extends AbstractEloquentRepository implements UserRepositoryInterface
{
	public function model()
	{
		return User::class;
	}
}