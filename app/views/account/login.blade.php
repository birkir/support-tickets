@extends('layouts.master')

@section('content')

	{{ Form::open(['url' => 'account/login', 'class' => 'form col-sm-4 col-sm-offset-4']) }}

		@if ($errors->has())
			<div class="alert alert-warning">
				<h4>There were errors:</h4>
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		<div class="form-group">
			{{ Form::label('loginEmail', 'E-Mail Address') }}
			{{ Form::email('email', NULL, ['class' => 'form-control', 'id' => 'loginEmail']) }}
			@if ($errors->has('email'))
				<p class="help-block">{{ $errors->first('email') }}</p>
			@endif
		</div>

		<div class="form-group">
			{{ Form::label('loginPassword', 'Password') }}
			{{ Form::password('password', ['class' => 'form-control', 'id' => 'loginPassword']) }}
			@if ($errors->has('password'))
				<p class="help-block">{{ $errors->first('password') }}</p>
			@endif
		</div>

		<div class="form-group">
			<label for="rememberCheckbox" class="checkbox-inline">
				{{ Form::checkbox('remember', 'on', FALSE, ['id' => 'rememberCheckbox'])}}
				Remember me
			</label><br><br>
			<button type="submit" class="btn btn-primary">Login</button>
			<a href="/account/register" class="btn btn-link">@lang('Sign up (it\'s free!)')</a>
		</div>

	{{ Form::close() }}
@stop