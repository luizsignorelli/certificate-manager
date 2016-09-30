@extends('layouts.app')

@section('title')
	Mostrar certificados
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Mostrar certificados</h3>
				</div>
				<div class="panel-body">
					<div>
						<table class="table table-hover table-bordered">
							<thead>
								<tr>
									<th>#</th>
									<th>Nome</th>
									<th>C</th>
									<th>ST</th>
									<th>L</th>
									<th>O</th>
									<th>OU</th>
									<th>CN</th>
									<th>Expira</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($callback as $certificate)
								    <tr>
								    	<td>{{ $certificate['id'] }}</td>
								    	<td>{{ $certificate['name'] }}</td>
								    	<td>{{ $certificate['country'] }}</td>
								    	<td>{{ $certificate['state'] }}</td>
								    	<td>{{ $certificate['city'] }}</td>
								    	<td>{{ $certificate['organization'] }}</td>
								    	<td>{{ $certificate['organization_unit'] }}</td>
								    	<td>{{ $certificate['common_name'] }}</td>
								    	<td>{{ $certificate['expiration'] }}</td>
								    </tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection