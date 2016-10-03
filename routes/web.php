<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('main');
});

Route::get('/import-cert', function () {
    return view('import_certificate');
});

Route::get('/export-cert', function () {
    return view('export_certificate');
});

Route::get('/new-cert', function () {
    return view('new_certificate');
});

Route::get('/show-certs', function(){
    return view('show_certs');
});

Route::post('/create-certificate', [
	'uses' => 'CertificateController@newCertificate',
	'as' => 'create_certificate'
]);

Route::post('/import-certificate', [
	'uses' => 'CertificateController@importCertificate',
	'as' => 'import_certificate'
]);

Route::post('/export-certificate', [
    'uses' => 'CertificateController@exportCertificate',
    'as' => 'export_certificate'
]);