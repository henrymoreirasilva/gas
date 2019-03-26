@extends('app')
@section('content')
<div class="container">
	<h4>Usuários</h4>
	<!--a href="#" class="btn btn-default">Novo usuário</a-->
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nome</th>
				<th>E-mail</th>
				<th>Regra</th>
				<th>Filial</th>
				<th>Situação</th>
				<th>Ação</th>
			</tr>
		</thead>
		<tbody>	
		@foreach($users as $user)
			<tr>
				<td>{{ $user->id }}</td>
				<td>{{ $user->name }}</td>
				<td>{{ $user->email }}</td>
				<td>{{ $user->role }}</td>
				@if ($user->branch)
				<td>{{ $user->branch->company_name }}</td>
				@else
				<td>-</td>
				@endif
				<td>{{ $user->situation }}</td>
				<td>
				<a href="{{ route('admin.users.edit', ['id' => $user->id]) }}" class="btn btn-default btn-sm">Editar</a>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	{!! $users->render() !!}
</div>
@endsection()