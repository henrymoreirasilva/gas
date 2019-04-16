@extends('app')
@section('content')
<div class="container">
	<h4>Venda: #{{ $sale->id }}</h4>

	<div class="col-sm-6">
	@include('errors._check')
	
	{!! Form::model($sale, ['route' => ['admin.sales.update', $sale->id], 'class' => 'form-horizontal', 'onsubmit' => 'return valida_sale()']) !!}
	
	@include('admin.sales._form')
	
	{!! Form::close() !!}
	</div>
</div>
@endsection()