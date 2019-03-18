@extends('app')
@section('content')
<div class="container">
	<h3>PRODUTOS</h3>
	<a href="#" class="btn btn-default">Novo produto</a>
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>NOME</th>
				<th>PREÇO</th>
				<th>SITUAÇÃO</th>
				<th>AÇÃO</th>
			</tr>
		</thead>
		<tbody>	
		@foreach($products as $product)
			<tr>
				<td>{{ $product->id }}</td>
				<td>{{ $product->name }} - {{ $product->unidade }}</td>
				<td>{{ $product->sale_price }}</td>
				<td>{{ $product->situation }}</td>
				
				<td>&nbsp;</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	{!! $products->render() !!}
</div>
@endsection()