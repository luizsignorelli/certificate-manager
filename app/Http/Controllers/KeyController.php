<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class KeyController extends Controller
{
    public function newKey(Request $request) {
    	$key_name = $request['key_name'];
    	$key_pass = $request['key_pass'];
    }

    public function importKey(Request $request) {
    	$key_file = $request['key_file'];
    	$key_name = $request['key_name'];
    	$key_pass = $request['key_pass'];
    }
}
