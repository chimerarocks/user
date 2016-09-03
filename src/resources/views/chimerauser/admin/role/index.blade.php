@extends('layouts.app')

@section('content')

	<div class="container">
		<h3>Users</h3>
		<a href="{{route('admin.roles.create')}}">Create</a>
		<br><br>

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@forelse($roles as $role)
				<tr>
					<td>{{$role->id}}</td>
					<td>{{$role->name}}</td>
					<td><a href="{{route('admin.roles.edit', ['id' => $role->id])}}">Update</a></td>
				@empty
					<td colspan="4"> Nenhuma role registrada </td>
				</tr>
				@endforelse
			</tbody>
		</table>
	</div>

@endsection