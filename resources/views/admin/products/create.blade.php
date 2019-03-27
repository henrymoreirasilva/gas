@extends('app')
@section('content')
<div class="container">
	<h4>Novo produto</h4>
	
	<div class="col-sm-6">
	@include('errors._check')
	
	{!! Form::open(['route' => 'admin.products.store', 'class' => 'form-horizontal']) !!}
	
	@include('admin.products._form')
	
	{!! Form::close() !!}
	</div>
</div>
@endsection()