@extends('apppesquisa')
@section('content')
<form class="form-inline" id="expressao-form" action="{{ route('admin.sellers.pesquisa') }}/{{$branch_id}}" method="get">
	<div class="input-group">
      <input type="text" class="form-control" placeholder="Procurar por..." name="exp" id="expressao-filtro" value="{{ $exp }}" />
      <span class="input-group-btn">
        
        @if ($exp == '')
        	<button class="btn btn-default" type="submit">Filtrar</button>
        @else
    		<button class="btn btn-default" type="submit" onclick="$('#expressao-filtro').val('')">Limpar filtro</button>
		@endif
      </span>
    </div>
</form>
<div class="container-fluid">
	<table class="table table-condensed">
		<thead>
			<tr>
				<th>ID</th>
				<th>NOME</th>
				<th>FONE</th>
				<th>E-MAIL</th>
			</tr>
		</thead>
		<tbody>	
		@foreach($sellers as $seller)
			<tr>
				<td><button class="btn btn-sm btn-default" onclick="setSellerId({{ $seller->id }})">{{ $seller->id }}</button></td>
				<td>{{ $seller->name }}</td>
				<td>{{ $seller->phone }}</td>
				<td>{{ $seller->email }}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	{!! $sellers->render() !!}
</div>
@endsection()
<script>
function setSellerId(id) {
	parent.top.document.getElementById('seller_id').value = id;

	parent.top.getSeller(id);
	
	parent.top.$('#myModal').modal('hide');
	parent.top.$('#sale_date').focus();
}
</script>