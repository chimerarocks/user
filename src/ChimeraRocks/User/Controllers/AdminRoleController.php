<?php

namespace ChimeraRocks\User\Controllers;

use ChimeraRocks\User\Repositories\RoleRepositoryInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class AdminRoleController extends Controller
{
	private $roleRepository;
	private $response;
	private $permissinoRepository;

	public function __construct(
		RoleRepositoryInterface $roleRepository, 
		ResponseFactory $response,
		PermissionRepositoryInterface $permissinoRepository
		)
	{
		$this->authorize('access_roles');
		$this->roleRepository = $roleRepository;
		$this->response = $response;
		$this->permissinoRepository = $permissinoRepository;
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
		$permissions = $this->permissionRepository->lists('name', 'id');
		$role = $this->roleRepository->find($id);
		return $this->response->view('chimerauser::admin.role.edit', compact('role', 'permissions'));
	}

	public function update(Request $request, $id)
	{
		$data = $request->all();
		$role = $this->roleRepository->update($data, $id);
		$this->roleRepository->addPermissions($role->id, $request->get('permissions'));

		return redirect()->route('admin.roles.index');
	}
}