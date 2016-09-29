@extends('layouts.app')

@section('title')
	Importar certificado
@endsection

@section('content')
	@if (isset($callback['ok']))
		<div class="alert alert-success" role="alert">
		  <a href="#" class="alert-link">{{ $callback['ok'] }}</a>
		</div>
	@elseif (isset($callback['error']))
		<div class="alert alert-danger" role="alert">
		  <a href="#" class="alert-link"> {{ $callback['error'] }} </a>
		</div>
	@endif
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Importar certificado</h3>
				</div>
				<div class="panel-body">
					<form action="{{route('import_certificate')}}" enctype="multipart/form-data" method="post">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="certFile">CRT input</label>
									<input type="file" name="cert_file" id="certFile">
									<p class="help-block">Selecione o certificado</p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="certKey">KEY input</label>
									<input type="file" name="key_file" id="certFile">
									<p class="help-block">Selecione a chave</p>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="certName">Nome do certificado</label>
							<input type="text" name="name" class="form-control" id="certName" placeholder="Indentificador para o certificado">
						</div>
						<div class="form-group">
							<label for="certPass">Senha do certificado</label>
							<input type="password" name="password" class="form-control" id="certPass" placeholder="Senha do certificado">
						</div>
						<input type="hidden" name="_token" value="{{Session::token() }}">
						<button type="submit" class="btn btn-primary">Enviar</button>
					</form>
				</div>
			</div>
		</div>
@endsection