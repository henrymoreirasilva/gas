@extends('app')
@section('content')
<div class="container">
	<h4>Novo usuário</h4>
	
	<div class="col-sm-6">
	@include('errors._check')
	
	{!! Form::open(['route' => 'admin.users.store', 'class' => 'form']) !!}
	
	@include('admin.users._form')
	
	{!! Form::close() !!}
	</div>
</div>
@endsection()