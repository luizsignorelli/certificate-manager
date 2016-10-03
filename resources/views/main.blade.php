@extends('layouts.app')

@section('title')
    Gerenciador de certificados
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Sobre o aplicativo</h3>
                </div>
                <div class="panel-body">
                    <p>Aplicativo concebido com o propósito de gerenciar certificados. Isso é, importar certificados, criar certificados, exportar certficados para download ou copia-los direto para um host.</p>
                    <p>Além disso, o aplicativo deve de forma fácil exibir detalhes sobre os certificados e informar com antecedência quando os mesmos expiram.</p>
                    <p>Depêndencias:</p>
                    <ul>
                        <li>php-pecl-ssh2</li>
                        <li>openssl-devel</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection