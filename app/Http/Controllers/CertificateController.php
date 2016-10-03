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

	public static function showCertificates() {
		$data = Certificate::all();

		$certificates = [];

		foreach ($data as $k => $certificate) {
			$certificates[$k]['id'] = $certificate->id;
			$certificates[$k]['name'] = $certificate->name;
			$certificates[$k]['country'] = $certificate->country;
			$certificates[$k]['state'] = $certificate->state;
			$certificates[$k]['city'] = $certificate->city;
			$certificates[$k]['organization'] = $certificate->organization;
			$certificates[$k]['organization_unit'] = $certificate->organization_unit;
			$certificates[$k]['common_name'] = $certificate->common_name;
			$certificates[$k]['expiration'] = $certificate->expiration;
		}

		return $certificates;
    }

	public function newCertificate(Request $request) {
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

		Storage::disk('certs')->put($requestName, $cert_file['csr']);
		Storage::disk('certs')->put($certName, $cert_file['crt']);
		Storage::disk('certs')->put($keyName, $cert_file['key']);

		$certificate = new Certificate();

		$certificate->name = $request['name'];
		$certificate->email = $request['email'];
		$certificate->password = $request['password'] == '' ? null : $request['password'];
		$certificate->location = storage_path('app/certificates/' . $certName);
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
		
		return view('new_certificate', ['callback' => $cert_file]);
    }

    public function importCertificate(Request $request) {
    	$this->validate($request,[
    		'cert_file' => 'required|file',
    		'key_file' => 'required|file',
    		'name' => 'required|unique:certificates'
    	]);
    	
    	$certName = $request['name'] . '.cer';
		$keyName = $request['name'] . '.pem';

		$cert_file = file_get_contents(request()->file('cert_file'));
		$key_file = file_get_contents(request()->file('key_file'));

		if (openssl_x509_check_private_key($cert_file, $key_file)) {

			Storage::disk('certs')->put($certName, $cert_file);
			Storage::disk('certs')->put($keyName, $key_file);

			$certProperties = openssl_x509_parse($cert_file);

			$certificate = new Certificate();

			$certificate->name = $request['name'];
			$certificate->password = $request['password'] == '' ? null : $request['password'];
			$certificate->location = storage_path('app/certificates/' . $certName);
			$certificate->country = array_key_exists("C", $certProperties['subject']) == false ? 'BR' : $certProperties['subject']['C'];
			$certificate->state = array_key_exists("ST", $certProperties['subject']) == false ? 'preencher' : $certProperties['subject']['ST'];
			$certificate->city = array_key_exists("L", $certProperties['subject']) == false ? 'preencher' : $certProperties['subject']['L'];
			$certificate->organization = array_key_exists("O", $certProperties['subject']) == false ? 'preencher' : $certProperties['subject']['O'];
			$certificate->organization_unit = array_key_exists("OU", $certProperties['subject']) == false ? 'preencher' : $certProperties['subject']['OU'];
			$certificate->common_name = $certProperties['subject']['CN'];
			$certificate->expiration = date("Y-m-d H:i:s", $certProperties['validTo_time_t']);
			$certificate->csr = null;
			$certificate->crt = $cert_file;
			$certificate->key = $key_file;

			$certificate->save();

			return view('import_certificate', ['callback' => ['ok' => 'Certificado importado com sucesso!']]);
		}
		else {
			return view('import_certificate', ['callback' => ['error' => 'O certificado e a chave não batem']]);
		}
    }

    public function exportCertificate(Request $request) {

    	$certificates = Certificate::where('id', $request->certificate)->get();

    	foreach ($certificates as $certificate) {
    		$certFileLocation = storage_path('app/certificates/' . $certificate->name . '.cer');
    		$certFileName = $certificate->name . '.crt';
    		$keyFileLocation = storage_path('app/certificates/' . $certificate->name . '.pem');
    		$keyFileName = $certificate->name . '.key';

    		$connection = ssh2_connect($request->host, 22);
    		ssh2_auth_password($connection, $request->username, $request->password);
    		ssh2_scp_send($connection, $certFileLocation, $request->destination . $certFileName, 0644);
    		ssh2_scp_send($connection, $keyFileLocation, $request->destination . $keyFileName, 0644);
    	}

    	return view('export_certificate', ['callback' => ['ok' => 'Certificado exportado com sucesso!']]);
    }
}
