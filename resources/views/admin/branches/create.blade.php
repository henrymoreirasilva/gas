@extends('app')
@section('content')
<div class="container">
	<h3>NOVA FILIAL</h3>
	
	<div class="col-sm-6">
	@include('errors._check')
	
	{!! Form::open(['route' => 'admin.branches.store', 'class' => 'form']) !!}
	
	@include('admin.branches._form')
	
	{!! Form::close() !!}
	</div>
</div>
@endsection()