<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Certificate;

class CertificateController extends Controller
{
	public static function generateCertificate($data) {
		$configParams = array('config' => config('app.ssl'));

		$privkey = openssl_pkey_new($configParams);
		$csr = openssl_csr_new($data, $privkey, $configParams);

		$sslcert = openssl_csr_sign($csr, null, $privkey, 365, $configParams);

		openssl_csr_export($csr, $csrout);
		openssl_x509_export($sslcert, $certout);
		openssl_pkey_export($privkey, $pkout, null, $configParams);
		$expiration = openssl_x509_parse($certout);

		$output = array(
			"csr" => $csrout,
			"crt" => $certout,
			"key" => $pkout,
			"expiration" => date("Y-m-d H:i:s", $expiration["validTo_time_t"])
		);

		return $output;
	}

    public function newCertificate(Request $request) {
		/*
			TODO:
			Find a way to create the fucking certificate file... And load the location on the variable accordingly.
		*/

		$requestName = $request['name'] . '.csr';
		$certName = $request['name'] . '.cer';
		$keyName = $request['name'] . '.pem';

		$data = array(
			"countryName" => $request['country'],
			"stateOrProvinceName" => $request['state'],
			"localityName" => $request['city'],
			"organizationName" => $request['organization'],
			"organizationalUnitName" => $request['organization_unit'],
			"commonName" => $request['common_name'],
			"emailAddress" => "myemail@someserver.com"
		);

		$cert_file = CertificateController::generateCertificate($data);

		$certificate = new Certificate();

		$certificate->name = $request['name'];
		$certificate->email = $request['email'];
		$certificate->password = $request['password'] == '' ? null : $request['password'];
		$certificate->country = $request['country'];
		$certificate->state = $request['state'];
		$certificate->city = $request['city'];
		$certificate->organization = $request['organization'];
		$certificate->organization_unit = $request['organization_unit'];
		$certificate->common_name = $request['common_name'];
		$certificate->expiration = $cert_file['expiration'];
		$certificate->csr = $cert_file['csr'];
		$certificate->crt = $cert_file['crt'];
		$certificate->key = $cert_file['key'];

		$certificate->save();

		Storage::disk('certs')->put($requestName, $cert_file['csr']);
		Storage::disk('certs')->put($certName, $cert_file['crt']);
		Storage::disk('certs')->put($keyName, $cert_file['key']);

		return view('new_certificate', ['callback' => $cert_file]);
    }

    public function importCertificate(Request $request) {
    	/*
    		TODO:
    		Find a way to read the fucking certificate file, and grab the information we need to save it...
    	*/

    	$cert_file = $request['cert_file'];
    	$cert_name = $request['cert_name'];
    	$cert_pass = $request['cert_pass'];

    	$certificate = new Certificate();

    	$certificate->location = $cert_file;
    	$certificate->name = $cert_name;
    	$certificate->password = $cert_pass;

    	$certificate->save();

    	return redirect()->back();
    }
}
