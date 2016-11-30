<?php

namespace ChimeraRocks\User\Controllers;

use ChimeraRocks\User\Repositories\PermissionRepositoryInterface;
use ChimeraRocks\User\Repositories\RoleRepositoryInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class AdminRoleController extends Controller
{
	private $roleRepository;
	private $response;
	private $permissionRepository;

	public function __construct(
		RoleRepositoryInterface $roleRepository, 
		ResponseFactory $response,
		PermissionRepositoryInterface $permissionRepository
		)
	{
		$this->roleRepository = $roleRepository;
		$this->response = $response;
		$this->permissionRepository = $permissionRepository;
	}

	public function index()
	{
		return $this->response->view('chimerauser::admin.role.index', [
			'roles' => $this->roleRepository->all()
		]);
	}

	public function create()
	{
		$permissions = $this->permissionRepository->lists('name', 'id');
		return $this->response->view('chimerauser::admin.role.create', compact('permissions'));
	}

	public function store(Request $request)
	{
		$role = $this->roleRepository->create($request->all());
		$this->roleRepository->addPermissions($role->id, $request->get('permissions'));
		return redirect()->route('admin.roles.index');
	}

	public function edit($id)
	{
		$permissions = $this->permissionRepository->lists('name');
		$rolePermissions = $this->roleRepository->listPermissions('id', $id);
		$role = $this->roleRepository->find($id);
		return $this->response->view('chimerauser::admin.role.edit', compact('role', 'permissions', 'rolePermissions'));
	}

	public function update(Request $request, $id)
	{
		$data = $request->all();
		$role = $this->roleRepository->update($data, $id);
		$this->roleRepository->removePermissions($role->id);
		$this->roleRepository->addPermissions($role->id, $request->get('permissions'));

		return redirect()->route('admin.roles.index');
	}
}