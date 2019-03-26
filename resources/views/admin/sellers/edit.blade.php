@extends('app')
@section('content')
<div class="container">
	<h4>Vendedor: {{ $seller->name }}</h4>

	<div class="col-sm-6">
	@include('errors._check')
	
	{!! Form::model($seller, ['route' => ['admin.sellers.update', $seller->id], 'class' => 'form-horizontal']) !!}
	
	@include('admin.sellers._form')
	
	{!! Form::close() !!}
	</div>
</div>
@endsection()