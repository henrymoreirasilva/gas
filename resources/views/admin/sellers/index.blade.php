@extends('app')
@section('content')
<div class="container">
	<h4>Vendedores</h4>
	<a href="{{ route('admin.sellers.create') }}" class="btn btn-default">Novo vendedor</a>
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>NOME</th>
				<th>FILIAL</th>
				<th>CPF/CNPJ</th>
				<th>FONE</th>
				<th>E-MAIL</th>
				<th>CIDADE</th>
				<th>AÇÃO</th>
			</tr>
		</thead>
		<tbody>	
		@foreach($sellers as $seller)
			<tr>
				<td>{{ $seller->id }}</td>
				<td>{{ $seller->name }}</td>
				<td>{{ $seller->branch->company_name }}</td>
				<td>{{ $seller->document }}</td>
				<td>{{ $seller->phone }}</td>
				<td>{{ $seller->email }}</td>
				<td>{{ $seller->city }}-{{ $seller->state }}</td>
				<td>
					<a href="{{ route('admin.sellers.edit', ['id' => $seller->id]) }}" class="btn btn-default btn-sm">Editar</a>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	{!! $sellers->render() !!}
</div>
@endsection()