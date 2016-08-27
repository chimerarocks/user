@extends('layouts.app')

@section('content')

	<div class="container">
		<h3>Create User</h3>

		{!! Form::open(['method' => 'user', 'route' => ['admin.users.store']]) !!}

		<div class="form-group">
			{!! Form::label('Email', 'Email:') !!}
			{!! Form::text('email', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('Name', 'Name:') !!}
			{!! Form::text('name', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Create User', ['class' => 'form-control']) !!}
		</div>

		{!! Form::close() !!}

	</div>

@endsection