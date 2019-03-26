@extends('app')
@section('content')
<div class="container">
	<h4>Nova filial</h4>
	
	<div class="col-sm-6">
	@include('errors._check')
	
	{!! Form::open(['route' => 'admin.branches.store', 'class' => 'form-horizontal']) !!}
	
	@include('admin.branches._form')
	
	{!! Form::close() !!}
	</div>
</div>
@endsection()