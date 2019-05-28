@extends('app')
@section('content')
<div class="container">
    <h4>Vendas</h4>
    <a href="{{ route('admin.sales.create') }}" class="btn btn-default">Nova venda</a> 
    <br /><br />
    <form class="clearfix" id="expressao-form" action="{{ route('admin.sales.index') }}" method="get">
        <div class="form-group col-sm-2">
            <label for="date1">Data inicial</label>
            <input type="text" class="form-control date" id="date1" name="date1" value="{{ $data['date1'] }}" >
        </div>
        <div class="form-group col-sm-2">
            <label for="date2">Data final</label>
            <input type="text" class="form-control date" id="date2" name="date2" value="{{ $data['date2'] }}" >
        </div>
        <div class="form-group col-sm-2">
            <label for="branch_id">Filial:</label>

            {!! Form::select('branch_id', $branches, $data['branch_id'], ['class' => 'form-control']) !!}

        </div>
        <div class="form-group col-sm-2">
            <label for="seller_id">Vendedor:</label>

            {!! Form::select('seller_id', $sellers, $data['seller_id'], ['class' => 'form-control']) !!}

        </div>

        <div class="form-group col-sm-2">
            <label for="exp">Pesquisa:</label>
            <input type="text" class="form-control" placeholder="Procurar por..." name="exp" id="expressao-filtro" value="{{ $data['exp'] }}" />
        </div>  
        <div class="form-group col-sm-2">
            <label for="ordenacao">Ordenar:</label>
            <select class="form-control"  name="ordenacao" id="ordenacao">
                <option value="Venda" {{ $data['ordenacao'] == 'Venda'?'selected':'' }}>Venda</option>
                <option value="Cliente" {{ $data['ordenacao'] == 'Cliente'?'selected':'' }}>Cliente - Fantasia</option>
                <option value="Cliente2" {{ $data['ordenacao'] == 'Cliente2'?'selected':'' }}>Cliente - Razão</option>
                <option value="Filial" {{ $data['ordenacao'] == 'Filial'?'selected':'' }}>Filial</option>
                <option value="Vendedor" {{ $data['ordenacao'] == 'Vendedor'?'selected':'' }}>Vendedor</option>
                <option value="Data" {{ $data['ordenacao'] == 'Data'?'selected':'' }}>Data</option>
            </select>
        </div>
        <div class="form-group col-sm-2">
            <button type="submit" class="btn btn-default">Aplicar</button>
        </div>
    </form>
    <!--div class="text-info text-right">
        Valor total das vendas para o filtro aplicado: R$ 999.999,99
    </div-->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>CLIENTE</th>
                <th>FILIAL</th>
                <th>VENDEDOR</th>
                <th>DATA</th>
                <th>VALOR</th>
                <th>AÇÃO</th>
            </tr>
        </thead>
        <tbody>	
            @foreach($sales as $sale)
            <tr>
                <td>{{ $sale->id }}</td>
                <td>{{ $sale->client_name }}<br />{{ $sale->client_company_name }}</td>
                <td>{{ $sale->branch_name }}</td>
                <td>{{ $sale->seller_name }}</td>
                <td>{{ $sale->sale_date }}</td>
                <td class="money">{{ $sale->amount }}</td>
                <td>
                    <a href="{{ route('admin.sales.edit', ['id' => $sale->id]) }}" class="btn btn-default btn-sm">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $sales->render() !!}
</div>
@endsection()