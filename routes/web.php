<?php

use App\Notifications\CertificateExpiring;
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

Route::get('/slack-notification', function(){
    /*
        Just testing the functionality
    */
    
    $certificates = App\Certificate::all();
    
    foreach ($certificates as $key => $certificate) {
        $expiration = date_create($certificate['expiration']);
        $today = date_create("2016-10-07 16:10:00");
        $diff = date_diff($today,$expiration);

        if ($diff->format("%a") < 374) {
           $certificate->notify(new CertificateExpiring($certificate));
        }
    }
});

Route::get('api/certificate/{certificate}', function (App\Certificate $certificate) {
    /*
        TODO:
        Use the this route within default middleware for apis!!
    */
        
    return $output = array(
        'id' => $certificate->id,
        'name' => $certificate->name,
        'location' => $certificate->location,
        'country' => $certificate->country,
        'state' => $certificate->state,
        'city' => $certificate->city,
        'organization' => $certificate->organization,
        'organization_unit' => $certificate->organization_unit,
        'state' => $certificate->state,
        'expiration' => $certificate->expiration
    );
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