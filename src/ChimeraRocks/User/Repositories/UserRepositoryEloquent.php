<?php

namespace ChimeraRocks\User\Repositories;

use ChimeraRocks\Database\AbstractEloquentRepository;
use ChimeraRocks\User\Events\UserCreatedEvent;
use ChimeraRocks\User\Models\User;
use ChimeraRocks\User\Repositories\RoleRepositoryInterface;
use ChimeraRocks\User\Repositories\UserRepositoryInterface;

class UserRepositoryEloquent extends AbstractEloquentRepository implements UserRepositoryInterface
{
	private $roleRepository;


	public function __construct(RoleRepositoryInterface $roleRepository)
	{
		parent::__construct();
		$this->roleRepository = $roleRepository;
	}

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
		foreach ($roles as $role) {
			$model->roles()->save($this->roleRepository->find($role));
		}
		return $model;
	}

	public function removeRoles($id)
	{
		$model = $this->find($id);
		$model->roles()->detach();
	}
	
	public function listRoles($column, $id)
	{
		$model = $this->find($id);
		$roles = $model->roles()->getResults();

		$list = [];
		foreach ($roles as $p) {
			$list[$p->id] = $p->$column;
		}

		return $list;
	}
}