@extends('app')
@section('content')
<div class="container">
	<h4>Produtos</h4>
	<a href="{{ route('admin.products.create') }}" class="btn btn-default">Novo produto</a>
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
				<td class="money">{{ $product->sale_price }}</td>
                                <td>{{ $product->active?'Ativo':'Inativo' }}</td>
				
				<td>
				<a href="{{ route('admin.products.edit', ['id' => $product->id]) }}" class="btn btn-default btn-sm">Editar</a>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	{!! $products->render() !!}
</div>
@endsection()