@extends('layouts.app')

@section('title')
	Exportar certificado
@endsection

@section('content')
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Exportar certificado</h3>
				</div>
				<div class="panel-body">
					<form action="{{route('export_certificate')}}" method="post">
						<div class="form-group">
							<label for="sshUserName">Nome de usuário</label>
							<input type="text" name="username" class="form-control" id="sshUserName" placeholder="Usuário para SSH">
						</div>
						<div class="form-group">
							<label for="sshUserPass">Senha</label>
							<input type="password" name="password" class="form-control" id="sshUserPass" placeholder="Senha para SSH">
						</div>
						<div class="form-group">
							<label for="sshRemoteHost">Remote host</label>
							<input type="password" name="password" class="form-control" id="sshRemoteHost" placeholder="IP do host">
						</div>
						<div class="form-group">
							<label for="sshRemoteDestination">Remote destination folder</label>
							<input type="password" name="password" class="form-control" id="sshRemoteDestination" placeholder="Caminho de destino">
						</div>
						<input type="hidden" name="_token" value="{{Session::token() }}">
						<button type="submit" class="btn btn-primary">Enviar</button>
					</form>
				</div>
			</div>
		</div>
@endsection