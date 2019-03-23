	<div class="form-group ">
		{!! Form::label('company_name', 'Nome:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-10">
		{!! Form::text('company_name', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('phone', 'Telefone:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-10">
		{!! Form::text('phone', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('email', 'E-mail:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-10">
		{!! Form::text('email', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('address', 'Endereço:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-10">
		{!! Form::text('address', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('address_number', 'Número:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-2">
		{!! Form::text('address_number', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('complement', 'Complemento:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-10">
		{!! Form::text('complement', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('city', 'Cidade:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-10">
		{!! Form::text('city', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('state', 'UF:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-2">
		{!! Form::text('state', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('zip_code', 'CEP:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-4">
		{!! Form::text('zip_code', null, ['class' => 'form-control']) !!}
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