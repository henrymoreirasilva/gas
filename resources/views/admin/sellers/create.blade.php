@extends('app')
@section('content')
<div class="container">
	<h4>Novo vendedor</h4>
	
	<div class="col-sm-6">
	@include('errors._check')
	
	{!! Form::open(['route' => 'admin.sellers.store', 'class' => 'form-horizontal']) !!}
	
	@include('admin.sellers._form')
	
	{!! Form::close() !!}
	</div>
</div>
@endsection()