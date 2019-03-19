@extends('app')
@section('content')
<div class="container">
	<h3>FILIAIS</h3>
	<a href="{{ route('admin.branches.create') }}" class="btn btn-default">Nova filial</a>
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>NOME</th>
				<th>FONE</th>
				<th>E-MAIL</th>
				<th>AÇÃO</th>
			</tr>
		</thead>
		<tbody>	
		@foreach($branches as $branch)
			<tr>
				<td>{{ $branch->id }}</td>
				<td>{{ $branch->company_name }}</td>
				<td>{{ $branch->phone }}</td>
				<td>{{ $branch->email }}</td>
				<td>&nbsp;</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	{!! $branches->render() !!}
</div>
@endsection()