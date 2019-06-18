@extends('apppesquisa')
@section('content')
<form class="form-inline" id="expressao-form" action="{{ route('admin.clients.pesquisa') }}" method="get">
	<div class="input-group">
            <input type="text" autofocus="true" tabindex="1" class="form-control" placeholder="Procurar por..." name="exp" id="expressao-filtro" value="{{ $exp }}" />
      <span class="input-group-btn">

          <button class="btn btn-default" type="submit">Filtrar</button>

      </span>
    </div>
</form>
<div class="container-fluid">
	<table class="table table-condensed">
		<thead>
			<tr>
				<th>ID</th>
				<th>NOME</th>
				<th>CPF/CNPJ</th>
				<th>FONE</th>
				<th>E-MAIL</th>
			</tr>
		</thead>
		<tbody>	
		@foreach($clients as $client)
			<tr>
				<td><button class="btn btn-sm btn-default" onclick="setClientId({{ $client->id }}, {{ $client->branch_id }})">{{ $client->id }}</button></td>
				<td>{{ $client->name }}<br /><small>{{ $client->company_name }}</small></td>
				<td>{{ $client->document }}</td>
				<td>{{ $client->phone }}</td>
				<td>{{ $client->email }}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	{!! $clients->render() !!}
</div>
@endsection()
<script>
function setClientId(id, branch_id) {

	parent.top.document.getElementById('client_id').value = id;
	parent.top.document.getElementById('branch_id').value = branch_id;

	parent.top.getBranch(branch_id);
	parent.top.getClient(id);
	
	parent.top.$('#myModal').modal('hide');
	
}
</script>