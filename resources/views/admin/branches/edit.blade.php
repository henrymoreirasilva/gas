@extends('app')
@section('content')
<div class="container">
	<h4>Editando filial: {{ $branch->company_name }}</h4>

	<div class="col-sm-6">
	@include('errors._check')
	
	{!! Form::model($branch, ['route' => ['admin.branches.update', $branch->id], 'class' => 'form-horizontal']) !!}
	
	@include('admin.branches._form')
	
	{!! Form::close() !!}
	</div>
</div>
@endsection()