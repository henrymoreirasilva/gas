@extends('app')
@section('content')
<div class="container">
	<h4>Cliente: {{ $client->name }}</h4>

	<div class="col-sm-6">
	@include('errors._check')
	
	{!! Form::model($client, ['route' => ['admin.clients.update', $client->id], 'class' => 'form-horizontal']) !!}
	
	@include('admin.clients._form')
	
	{!! Form::close() !!}
	</div>
</div>
@endsection()