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
							<div class="col-md-4">
								<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
									<label for="certName">Nome do certificado</label>
									<input type="text" class="form-control" name="name" id="certName" placeholder="Indentificador para o certificado">
									@if ($errors->has('name'))
										@foreach ($errors->get('name') as $nameError)
											<p class="help-block">{{ $nameError }}</p>
										@endforeach
									@endif
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
							<div class="col-md-4">
								<div class="form-group {{ $errors->has('country') ? 'has-error' : '' }}">
									<label for="c">C</label>
									<input type="text" class="form-control" name="country" id="c" placeholder="Country">
									@if ($errors->has('country'))
										@foreach ($errors->get('country') as $countryError)
											<p class="help-block">{{ $countryError }}</p>
										@endforeach
									@endif
								</div>
								<div class="form-group {{ $errors->has('state') ? 'has-error' : '' }}">
									<label for="st">ST</label>
									<input type="text" class="form-control" name="state" id="st" placeholder="State">
									@if ($errors->has('state'))
										@foreach ($errors->get('state') as $stateError)
											<p class="help-block">{{ $stateError }}</p>
										@endforeach
									@endif
								</div>
								<div class="form-group {{ $errors->has('organization_unit') ? 'has-error' : '' }}">
									<label for="ou">OU</label>
									<input type="text" class="form-control" name="organization_unit" id="ou" placeholder="Organizational Unit">
									@if ($errors->has('organization_unit'))
										@foreach ($errors->get('organization_unit') as $organizationUnitError)
											<p class="help-block">{{ $organizationUnitError }}</p>
										@endforeach
									@endif
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
									<label for="l">L</label>
									<input type="text" class="form-control" name="city" id="l" placeholder="City Name">
									@if ($errors->has('city'))
										@foreach ($errors->get('city') as $cityError)
											<p class="help-block">{{ $cityError }}</p>
										@endforeach
									@endif
								</div>
								<div class="form-group {{ $errors->has('organization') ? 'has-error' : '' }}">
									<label for="o">O</label>
									<input type="text" class="form-control" name="organization" id="o" placeholder="Organization">
									@if ($errors->has('organization'))
										@foreach ($errors->get('organization') as $organizationError)
											<p class="help-block">{{ $organizationError }}</p>
										@endforeach
									@endif
								</div>
								<div class="form-group {{ $errors->has('common_name') ? 'has-error' : '' }}">
									<label for="cn">CN</label>
									<input type="text" class="form-control" name="common_name" id="cn" placeholder="Common Name">
									@if ($errors->has('common_name'))
										@foreach ($errors->get('common_name') as $commonNameError)
											<p class="help-block">{{ $commonNameError }}</p>
										@endforeach
									@endif
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