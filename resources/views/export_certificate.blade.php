@extends('layouts.app')

@section('title')
	Exportar certificado
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
					<h3 class="panel-title">Exportar certificado</h3>
				</div>
				<div class="panel-body">
					<form action="{{route('export_certificate')}}" method="post">
						<div class="form-group">
							<label>Selecione o certificado:</label>
							<select class="form-control {{ $errors->has('certificate') ? 'has-error' : '' }}" name="certificate">
								@foreach (Certificates::showCertificates() as $key => $certificate)
									<option value="{{ $certificate['id'] }}">{{ $certificate['name'] }}</option>
								@endforeach
								@if ($errors->has('certificate'))
									@foreach ($errors->get('certificate') as $certificateError)
										<p class="help-block">{{ $certificateError }}</p>
									@endforeach
								@endif
							</select>
						</div>
						<div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
							<label for="sshUserName">Nome de usuário</label>
							<input type="text" name="username" class="form-control" id="sshUserName" placeholder="Usuário para SSH">
							@if ($errors->has('username'))
								@foreach ($errors->get('username') as $userNameError)
									<p class="help-block">{{ $userNameError }}</p>
								@endforeach
							@endif
						</div>
						<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
							<label for="sshUserPass">Senha</label>
							<input type="password" name="password" class="form-control" id="sshUserPass" placeholder="Senha para SSH">
							@if ($errors->has('password'))
								@foreach ($errors->get('password') as $passwordError)
									<p class="help-block">{{ $passwordError }}</p>
								@endforeach
							@endif
						</div>
						<div class="form-group {{ $errors->has('host') ? 'has-error' : '' }}">
							<label for="sshRemoteHost">Remote host</label>
							<input type="text" name="host" class="form-control" id="sshRemoteHost" placeholder="IP do host">
							@if ($errors->has('host'))
								@foreach ($errors->get('host') as $hostError)
									<p class="help-block">{{ $hostError }}</p>
								@endforeach
							@endif
						</div>
						<div class="form-group {{ $errors->has('destination') ? 'has-error' : '' }}">
							<label for="sshRemoteDestination">Remote destination folder</label>
							<input type="text" name="destination" class="form-control" id="sshRemoteDestination" placeholder="Caminho de destino">
							@if ($errors->has('destination'))
								@foreach ($errors->get('destination') as $destinationError)
									<p class="help-block">{{ $destinationError }}</p>
								@endforeach
							@endif
						</div>
						<input type="hidden" name="_token" value="{{ Session::token() }}">
						<button type="submit" class="btn btn-primary">Enviar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection