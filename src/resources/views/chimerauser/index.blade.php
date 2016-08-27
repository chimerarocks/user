@extends('layouts.app')

@section('content')

	<div class="container">
		<h3>Users</h3>
		<a href="{{route('admin.users.create')}}">Create</a>
		<br><br>

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Email</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@forelse($users as $user)
				<tr>
					<td>{{$user->id}}</td>
					<td>{{$user->email}}</td>
					<td><a href="{{route('admin.users.edit', ['id' => $user->id])}}">Update</a></td>
				@empty
					<td colspan="4"> Nenhum usuário registrado </td>
				</tr>
				@endforelse
			</tbody>
		</table>
	</div>

@endsection