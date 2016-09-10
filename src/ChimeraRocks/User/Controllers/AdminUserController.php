<?php

namespace ChimeraRocks\User\Controllers;

use ChimeraRocks\User\Repositories\RoleRepositoryInterface;
use ChimeraRocks\User\Repositories\UserRepositoryInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
	private $userRepository;
	private $response;
	private $roleRepository;

	public function __construct(UserRepositoryInterface $userRepository, ResponseFactory $response, RoleRepositoryInterface $roleRepository)
	{
		$this->userRepository = $userRepository;
		$this->response = $response;
		$this->roleRepository = $roleRepository;
	}

	public function index()
	{
		return $this->response->view('chimerauser::admin.user.index', [
			'users' => $this->userRepository->all()
		]);
	}

	public function create()
	{
		$roles = $this->roleRepository->lists('name', 'id');
		$users = $this->userRepository->all();
		return $this->response->view('chimerauser::admin.user.create', compact('users', 'roles'));
	}

	public function store(Request $request)
	{
		$this->userRepository->create($request->all());
		$this->userRepository->addRoles($user->id, $request->get('roles'));
		return redirect()->route('admin.users.index');
	}

	public function edit($id)
	{
		$roles = $this->roleRepository->lists('name', 'id');
		$user = $this->userRepository->find($id);
		return $this->response->view('chimerauser::admin.user.edit', compact('user', 'roles'));
	}

	public function update(Request $request, $id)
	{
		$data = $request->all();
		if (isset($data['password'])) {
			unset($data['password']);
		}
		$user = $this->userRepository->update($data, $id);
		$this->userRepository->addRoles($user->id, $request->get('roles'));
		return redirect()->route('admin.users.index');
	}
}