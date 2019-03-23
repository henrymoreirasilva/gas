	<div class="form-group ">
		{!! Form::label('name', 'Nome:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-10">
		{!! Form::text('name', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('email', 'E-mail:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-10">
		{!! Form::text('email', null, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('branch_id', 'Filial:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-4">
		{!! Form::select('branch_id', $branches, null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('role', 'Regra:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-4">
		{!! Form::select('role', ['' => 'sem regra', 'user'=>'Usuário', 'admin' => 'Administrador'], null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('situation', 'Ativo:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-4">
		{!! Form::select('situation', ['ativo'=>'Ativo', 'inativo' => 'Inativo'], null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group ">
		{!! Form::label('password', 'Senha:', ['class' => 'col-sm-2']) !!}
		<div class="col-sm-10">
		{!! Form::password('password', null, ['class' => 'form-control']) !!}
		</div>
	</div>	
	<div>
		{!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
		<a href="javascript:history.back()" class="btn btn-default">Voltar</a>
	</div>
	<p></p>