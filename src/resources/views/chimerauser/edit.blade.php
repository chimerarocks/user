@extends('layouts.app')

@section('content')

	<div class="container">
		<h3>Update Post</h3>

		{!! Form::open(['method' => 'post', 'route' => ['admin.posts.update', $post->id]]) !!}

		<div class="form-group">
			{!! Form::label('Email', 'Email:') !!}
			{!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('Name', 'Name:') !!}
			{!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Update', ['class' => 'form-control']) !!}
		</div>

		{!! Form::close() !!}

	</div>

@endsection