@extends('layouts.app')

@section('title')
	Importar chave
@endsection

@section('content')
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Importar chave</h3>
				</div>
				<div class="panel-body">
					<form action="#" method="post">
						<div class="form-group">
							<label for="keyFile">File input</label>
							<input type="file" name="key_file" id="keyFile">
							<p class="help-block">Selecione a chave</p>
						</div>
						<div class="form-group">
							<label for="keyName">Nome da chave</label>
							<input type="text" name="key_name" class="form-control" id="keyName" placeholder="Indentificador para a chave">
						</div>
						<div class="form-group">
							<label for="keyPass">Senha da chave</label>
							<input type="password" name="key_pass" class="form-control" id="keyPass" placeholder="Senha da chave">
						</div>
						<input type="hidden" name="_token" value="{{Session::token() }}">
						<button type="submit" class="btn btn-primary">Enviar</button>
					</form>
				</div>
			</div>
		</div>
	</div>	
@endsection