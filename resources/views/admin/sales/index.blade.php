@extends('app')
@section('content')
<div class="container">
	<h4>Vendas</h4>
	<a href="{{ route('admin.sales.create') }}" class="btn btn-default">Nova venda</a>
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>CLIENTE</th>
				<th>VENDEDOR</th>
				<th>DATA</th>
				<th>VALOR</th>
				<th>AÇÃO</th>
			</tr>
		</thead>
		<tbody>	
		@foreach($sales as $sale)
			<tr>
				<td>{{ $sale->id }}</td>
				<td>{{ $sale->client->name }}</td>
				<td>{{ $sale->seller->name }}</td>
				<td>{{ $sale->sale_date }}</td>
				<td class="money">{{ $sale->amount }}</td>
				<td>
				<a href="{{ route('admin.sales.edit', ['id' => $sale->id]) }}" class="btn btn-default btn-sm">Editar</a>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	{!! $sales->render() !!}
</div>
@endsection()