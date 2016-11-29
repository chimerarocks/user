<?php

namespace ChimeraRocks\User\Controllers;

use ChimeraRocks\User\Repositories\PermissionRepositoryInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class AdminPermissionController extends Controller
{
	private $permissionRepository;
	private $response;

	public function __construct(PermissionRepositoryInterface $permissionRepository, ResponseFactory $response)
	{
		$this->permissionRepository = $permissionRepository;
		$this->response = $response;
	}

	public function index()
	{
		return $this->response->view('chimerauser::admin.permission.index', [
			'permissions' => $this->permissionRepository->all()
		]);
	}

	public function view($id)
	{
		$permission = $this->permissionRepository->find($id);
		return $this->response->view('chimerauser::admin.permission.view', ['permission' => $permission]);
	}
}