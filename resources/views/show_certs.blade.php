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
								<tr>
									<td>1</td>
									<td>Zupme</td>
									<td>BR</td>
									<td>Minas Gerais</td>
									<td>Uberlândia</td>
									<td>ZUP INTERNET SERVER LTDA</td>
									<td>Infra</td>
									<td>*.api.zup.me</td>
									<td>Oct 15 23:59:59 2017 GMT</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>	
@endsection