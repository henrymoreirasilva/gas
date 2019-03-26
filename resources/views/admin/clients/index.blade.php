@extends('app')
@section('content')
<div class="container">
	<h4>Clientes</h4>
	<a href="{{ route('admin.clients.create') }}" class="btn btn-default">Novo cliente</a>
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
		@foreach($clients as $client)
			<tr>
				<td>{{ $client->id }}</td>
				<td>{{ $client->company_name }}</td>
				<td>{{ $client->branch->company_name }}</td>
				<td>{{ $client->document }}</td>
				<td>{{ $client->phone }}</td>
				<td>{{ $client->email }}</td>
				<td>{{ $client->city }}-{{ $client->state }}</td>
				<td>
				<a href="{{ route('admin.clients.edit', ['id' => $client->id]) }}" class="btn btn-default btn-sm">Editar</a>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	{!! $clients->render() !!}
</div>
@endsection()