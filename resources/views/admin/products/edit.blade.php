@extends('app')
@section('content')
<div class="container">
	<h4>Produto: {{ $product->name }}</h4>

	<div class="col-sm-6">
	@include('errors._check')
	
	{!! Form::model($product, ['route' => ['admin.products.update', $product->id], 'class' => 'form-horizontal']) !!}
	
	@include('admin.products._form')
	
	{!! Form::close() !!}
	</div>
</div>
@endsection()