@extends('app')
@section('content')
<div class="container">
	<h3>VENDAS</h3>
	<a href="#" class="btn btn-default">Nova venda</a>
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>CLIENTE</th>
				<th>VENDEDOR</th>
				<th>DATA</th>
				<th>VAOR</th>
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
				<td>{{ $sale->amount }}</td>
				<td>&nbsp;</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	{!! $sales->render() !!}
</div>
@endsection()