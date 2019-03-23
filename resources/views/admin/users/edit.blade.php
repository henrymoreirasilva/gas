@extends('app')
@section('content')
<div class="container">
	<h4>Usuário: {{ $user->name }}</h4>

	<div class="col-sm-6">
	@include('errors._check')
	
	{!! Form::model($user, ['route' => ['admin.users.update', $user->id], 'class' => 'form-horizontal']) !!}
	
	@include('admin.users._form')
	
	{!! Form::close() !!}
	</div>
</div>
@endsection()