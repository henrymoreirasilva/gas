	<div class="form-group ">
		{!! Form::label('name', 'Nome:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-10">
		{!! Form::text('name', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group ">
		{!! Form::label('description', 'Descrição:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-10">
		{!! Form::textarea('description', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('unidade', 'Unidade:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-2">
		{!! Form::text('unidade', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('sale_price', 'Preço de venda:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-5">
		{!! Form::text('sale_price', null, ['class' => 'form-control email money']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('cost_price', 'Preço de custo:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-5">
		{!! Form::text('cost_price', null, ['class' => 'form-control money']) !!}
		</div>
	</div>
	
	<div class="form-group">
		{!! Form::label('active', 'Ativo:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-4">
		{!! Form::select('active', [1=>'Ativo', 0 => 'Inativo'], null, ['class' => 'form-control']) !!}
		</div>
	</div>
	
	<div>
		{!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
		<a href="javascript:history.back()" class="btn btn-default">Voltar</a>
	</div>
	<p></p>