<?php

namespace ChimeraRocks\User\Repositories;

use ChimeraRocks\Database\AbstractEloquentRepository;
use ChimeraRocks\User\Events\UserCreatedEvent;
use ChimeraRocks\User\Models\User;
use ChimeraRocks\User\Repositories\UserRepositoryInterface;

class UserRepositoryEloquent extends AbstractEloquentRepository implements UserRepositoryInterface
{
	public function model()
	{
		return User::class;
	}

	public function create(array $data)
	{
		$password = $data['password'];
		$data['password'] = bcrypt($password);
		$result = parent::create($data);
		event(new UserCreatedEvent($result, $password));
		return $result;
	}

	public function addRoles($id, array $roles)
	{
		$model = $this->find($id);
		foreach ($users as $user) {
			$model->users()->save($this->userRepo->find($user));
		}
		return $model;
	}
}