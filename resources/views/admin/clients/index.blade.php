@extends('app')
@section('content')
<div class="container">
    <h4>Clientes</h4>
    <a href="{{ route('admin.clients.create') }}" class="btn btn-default">Novo cliente</a><br /><br />
    <form class="" id="expressao-form" action="{{ route('admin.clients.index') }}" method="get">
        <div class="form-group col-sm-2">
            <label for="branch_id">Filial:</label>

            {!! Form::select('branch_id', $branches, $data['branch_id'], ['class' => 'form-control']) !!}

        </div>
        <div class="form-group col-sm-2">
            <label for="exp">Pesquisa:</label>
            <input type="text" class="form-control" placeholder="Procurar por..." name="exp" id="expressao-filtro" value="{{ $data['exp'] }}" />
        </div>  
        <div class="form-group col-sm-2">
            <label for="ordenacao">Ordenar:</label>
            <select class="form-control"  name="ordenacao" id="ordenacao">
                <option value="Codigo" {{ $data['ordenacao'] == 'Codigo'?'selected':'' }}>Código</option>
                <option value="Cliente" {{ $data['ordenacao'] == 'Cliente'?'selected':'' }}>Cliente - Fantasia</option>
                <option value="Cliente2" {{ $data['ordenacao'] == 'Cliente2'?'selected':'' }}>Cliente - Razão</option>
                <option value="Filial" {{ $data['ordenacao'] == 'Filial'?'selected':'' }}>Filial</option>
            </select>
        </div>
        <div class="form-group col-sm-2">
                <br/>
            <button type="submit" class="btn btn-default">Aplicar</button>
        </div>
    </form>
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
                <td>{{ $client->name }}<br /><small>{{ $client->company_name }}</small></td>
                <td>{{ $client->branch_name }}</td>
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