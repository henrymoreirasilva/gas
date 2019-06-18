@extends('apppesquisa')
@section('content')
<form class="form-inline" id="expressao-form" action="{{ route('admin.products.pesquisa') }}" method="get">
    <div class="input-group">
        <input type="text" class="form-control" autofocus="true" placeholder="Procurar por..." name="exp" id="expressao-filtro" value="{{ $exp }}" />
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
				<th>PREÇO</th>
				<th>SITUAÇÃO</th>
			
            </tr>
        </thead>
        <tbody>	
            @foreach($products as $product)
            <tr>
                <td><button class="btn btn-sm btn-default" onclick="setProductId({{ $product->id }})">{{ $product->id }}</button></td>
                <td>{{ $product->name }} - {{ $product->unidade }}</td>
                <td>{{ $product->sale_price }}</td>
                <td>{{ $product->active?'Ativo':'Inativo' }}</td>
           
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $products->render() !!}
</div>
@endsection()
<script>
    function setProductId(id) {
        parent.top.document.getElementById('item_id').value = id;

        parent.top.getProduct(id);
        
        parent.top.$('#myModal').modal('hide');
        //parent.top.$('#item_qtd').focus();
    }
</script>