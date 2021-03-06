@extends('layouts.app')

@section('content')

	<div class="container">
		<h3>Permissions</h3>
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
				@forelse($permissions as $permission)
				<tr>
					<td>{{$permission->id}}</td>
					<td>{{$permission->name}}</td>
					<td><a href="{{route('admin.permissions.view', ['id' => $permission->id])}}">View</a></td>
				@empty
					<td colspan="4"> Nenhuma permission registrada </td>
				</tr>
				@endforelse
			</tbody>
		</table>
	</div>

@endsection