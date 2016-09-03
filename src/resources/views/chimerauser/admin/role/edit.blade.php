@extends('layouts.app')

@section('content')

	<div class="container">
		<h3>Update Role</h3>

		{!! Form::open(['method' => 'role', 'route' => ['admin.roles.update', $role->id]]) !!}

		<div class="form-group">
			{!! Form::label('Name', 'Name:') !!}
			{!! Form::text('name', $role->name, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('permissions[]', 'Permissions:') !!}
			{!! Form::select('permissions[]', $permissions, $role->permissions->lists('id')->toArray(),
				['class' => 'form-control', 'multiple' => 'multiple']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Update', ['class' => 'form-control']) !!}
		</div>

		{!! Form::close() !!}

	</div>

@endsection