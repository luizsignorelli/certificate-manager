@extends('layouts.app')

@section('title')
	Criar certificado
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Criar certificado</h3>
				</div>
				<div class="panel-body">
					<form action="{{ route('create_certificate') }}" method="post">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="certName">Nome do certificado</label>
									<input type="text" class="form-control" name="name" id="certName" placeholder="Indentificador para o certificado">
								</div>
								<div class="form-group">
									<label for="certPass">Senha do certificado</label>
									<input type="password" class="form-control" name="password" id="certPass" placeholder="Senha do certificado">
								</div>
								<div class="form-group">
									<label for="certEmail">E-mail</label>
									<input type="email" class="form-control" name="email" id="certEmail" placeholder="Email do certificado">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="c">C</label>
									<input type="text" class="form-control" name="country" id="c" placeholder="Country">
								</div>
								<div class="form-group">
									<label for="st">ST</label>
									<input type="text" class="form-control" name="state" id="st" placeholder="State">
								</div>
								<div class="form-group">
									<label for="ou">OU</label>
									<input type="text" class="form-control" name="organization_unit" id="ou" placeholder="Organizational Unit">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="l">L</label>
									<input type="text" class="form-control" name="city" id="l" placeholder="City Name">
								</div>
								<div class="form-group">
									<label for="o">O</label>
									<input type="text" class="form-control" name="organization" id="o" placeholder="Organization">
								</div>
								<div class="form-group">
									<label for="cn">CN</label>
									<input type="text" class="form-control" name="common_name" id="cn" placeholder="Common Name">
								</div>
							</div>
						</div>
						<input type="hidden" name="_token" value="{{Session::token()}}">
						<button type="submit" class="btn btn-primary">Enviar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	@if (isset($callback))
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Certificado</h3>
					</div>
					<div class="panel-body">
						<form>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label for="csr">Sign Request</label>
										<textarea class="form-control" rows="5">{{$callback['csr']}}</textarea>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="crt">Certificate</label>
										<textarea class="form-control" rows="5">{{$callback['crt']}}</textarea>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="crt">Key</label>
										<textarea class="form-control" rows="5">{{$callback['key']}}</textarea>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	@endif
@endsection