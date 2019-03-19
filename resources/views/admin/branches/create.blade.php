@extends('app')
@section('content')
<div class="container">
	<h3>NOVA FILIAL</h3>
	@if ($errors->any())
		<ul class="alert">
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li> 
			@endforeach
		</ul>
	@endif
	{!! Form::open(['route' => 'admin.branches.store', 'class' => 'form']) !!}
	
	<div class="form-group">
		{!! Form::label('company_name', 'Nome:') !!}
		{!! Form::text('company_name', null, ['class' => 'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::submit('Criar filial', ['class' => 'btn btn-primary']) !!}
	</div>
	{!! Form::close() !!}
	
</div>
@endsection()