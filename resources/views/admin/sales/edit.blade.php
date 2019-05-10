@extends('app')
@section('content')
<div class="container">
	<h4>Venda: #{{ $sale->id }}</h4>

	<div class="col-sm-6">
	@include('errors._check')
	
	{!! Form::model($sale, ['route' => ['admin.sales.update', $sale->id], 'class' => 'form-horizontal', 'onsubmit' => 'return valida_sale()']) !!}
	
	@include('admin.sales._form')
	
	{!! Form::close() !!}

        {!! Form::open(['url' => 'admin/sales/delete/'.$sale->id, 'method' => 'DELETE', 'onsubmit' => 'return confirma()', 'style'  => 'text-align:right']) !!}
        {!! Form::button('Excluir', ['type' => 'submit',  'class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
        <br/><br/>
	</div>
</div>
<script>
function confirma() {
    return confirm('Confirma a exclusão?'); 
}
</script>
@endsection()