	<div class="form-group">
		{!! Form::label('branch_id', 'Filial:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-10">
		{!! Form::select('branch_id', $branches, null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('client_id', 'Cliente:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-10">
		{!! Form::select('client_id', $clients, null, ['class' => 'form-control']) !!}
		</div>
	</div>
		<div class="form-group">
		{!! Form::label('seller_id', 'Vendedor:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-10">
		{!! Form::select('seller_id', $sellers, null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('sale_date', 'Data da venda:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-4">
		{!! Form::text('sale_date', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group ">
		{!! Form::label('amount', 'Valor total:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-4">
		{!! Form::text('amount', null, ['class' => 'form-control money']) !!}
		</div>
	</div>
	<div class="form-group ">
		{!! Form::label('payment_form', 'Forma de pagamento:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-10">
		{!! Form::text('payment_form', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('plots', 'Parcelas:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-2">
		{!! Form::text('plots', null, ['class' => 'form-control money']) !!}
		</div>
	</div>
	
	<div class="form-group">
		{!! Form::label('situation', 'Situação:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-4">
		{!! Form::select('situation', [1=>'Ativo',  0 => 'Cancelado'], null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<p></p>
	<h5>ITENS</h5>
	<table class="table">
		<thead>
			<tr><th>Item</th><th>Nome</th><th>Quantidade</th><th>Preço</th><th>Valor</th></tr>
		</thead>
		<tbody>
			<tr><td>99</td><td>xxxxxx</td><td>99</td><td>99,99</td><td>99,99</td></tr>
			<tr><td>99</td><td>xxxxxx</td><td>99</td><td>99,99</td><td>99,99</td></tr>
			<tr><td>99</td><td>xxxxxx</td><td>99</td><td>99,99</td><td>99,99</td></tr>
			<tr><td>99</td><td>xxxxxx</td><td>99</td><td>99,99</td><td>99,99</td></tr>
			<tr><td>99</td><td>xxxxxx</td><td>99</td><td>99,99</td><td>99,99</td></tr>
		</tbody>
	</table>
	
	<div>
		{!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
		<a href="javascript:history.back()" class="btn btn-default">Voltar</a>
	</div>
	<p></p>