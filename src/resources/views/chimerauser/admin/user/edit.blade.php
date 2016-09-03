@extends('layouts.app')

@section('content')

	<div class="container">
		<h3>Update User</h3>

		{!! Form::open(['method' => 'user', 'route' => ['admin.users.update', $user->id]]) !!}

		<div class="form-group">
			{!! Form::label('Email', 'Email:') !!}
			{!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('Name', 'Name:') !!}
			{!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('roles[]', 'Roles:') !!}
			{!! Form::select('roles[]', $roles, $user->roles->lists('id')->toArray(),
				['class' => 'form-control', 'multiple' => 'multiple']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Update', ['class' => 'form-control']) !!}
		</div>

		{!! Form::close() !!}

	</div>

@endsection