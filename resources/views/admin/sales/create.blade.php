@extends('app')
@section('content')
<div class="container">
	<h4>Nova venda</h4>
	
	<div class="col-sm-6">
	@include('errors._check')
	
	{!! Form::open(['route' => 'admin.sales.store', 'class' => 'form-horizontal', 'onsubmit' => 'return valida_sale()']) !!}
	
	@include('admin.sales._form')
	
	{!! Form::close() !!}
	</div>
</div>
@endsection()