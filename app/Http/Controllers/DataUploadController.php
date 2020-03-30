<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataUploadController extends Controller
{
    
	public function upload_statement_form()
	{
		return view('data_upload/statement');
	}
	
	public function upload_statement_action()
	{
		
	}
	
}
