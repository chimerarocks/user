<?php

namespace ChimeraRocks\User\Controllers;

use ChimeraRocks\User\Repositories\UserRepositoryInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
	private $userRepository;
	private $response;

	public function __construct(UserRepositoryInterface $userRepository, ResponseFactory $response)
	{
		$this->userRepository = $userRepository;
		$this->response = $response;
	}

	public function index()
	{
		return $this->response->view('chimerauser::index', [
			'users' => $this->userRepository->all()
		]);
	}

	public function create()
	{
		$users = $this->userRepository->all();
		return $this->response->view('chimerauser::create', compact('users'));
	}

	public function store(Request $request)
	{
		$this->userRepository->create($request->all());
		return redirect()->route('admin.users.index');
	}

	public function edit($id)
	{
		$user = $this->userRepository->find($id);
		return $this->response->view('chimerauser::edit', compact('user'));
	}

	public function update(Request $request, $id)
	{
		$data = $request->all();
		$user = $this->userRepository->update($data, $id);

		return redirect()->route('admin.users.index');
	}
}