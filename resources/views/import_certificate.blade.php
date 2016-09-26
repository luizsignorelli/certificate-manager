@extends('layouts.app')

@section('title')
	Importar certificado
@endsection

@section('content')
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Importar certificado</h3>
				</div>
				<div class="panel-body">
					<form action="{{ route('import_certificate') }}" method="post">
						<div class="form-group">
							<label for="certFile">File input</label>
							<input type="file" name="cert_file" id="certFile">
							<p class="help-block">Selecione o certificado</p>
						</div>
						<div class="form-group">
							<label for="certName">Nome do certificado</label>
							<input type="text" name="cert_name" class="form-control" id="certName" placeholder="Indentificador para o certificado">
						</div>
						<div class="form-group">
							<label for="certPass">Senha do certificado</label>
							<input type="password" name="cert_pass" class="form-control" id="certPass" placeholder="Senha do certificado">
						</div>
						<input type="hidden" name="_token" value="{{Session::token() }}">
						<button type="submit" class="btn btn-primary">Enviar</button>
					</form>
				</div>
			</div>
		</div>
	</div>	
@endsection