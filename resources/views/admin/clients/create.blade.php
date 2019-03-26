@extends('app')
@section('content')
<div class="container">
	<h4>Novo cliente</h4>
	
	<div class="col-sm-6">
	@include('errors._check')
	
	{!! Form::open(['route' => 'admin.clients.store', 'class' => 'form-horizontal']) !!}
	
	@include('admin.clients._form')
	
	{!! Form::close() !!}
	</div>
</div>
@endsection()