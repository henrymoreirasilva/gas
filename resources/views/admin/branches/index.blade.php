@extends('app')
@section('content')
<div class="container">
	<h3>Filiais</h3>
	<a href="{{ route('admin.branches.create') }}" class="btn btn-default">Nova filial</a>
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nome</th>
				<th>Fone</th>
				<th>E-mail</th>
				<th>Ação</th>
			</tr>
		</thead>
		<tbody>	
		@foreach($branches as $branch)
			<tr>
				<td>{{ $branch->id }}</td>
				<td>{{ $branch->company_name }}</td>
				<td>{{ $branch->phone }}</td>
				<td>{{ $branch->email }}</td>
				<td>
					<a href="{{ route('admin.branches.edit', ['id' => $branch->id]) }}" class="btn btn-default btn-sm">Editar</a>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	{!! $branches->render() !!}
</div>
@endsection()