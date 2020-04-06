<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\TransactionsImport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use App\Contact;

class DataUploadController extends Controller
{
    
	public function upload_statement_form()
	{
		return view('data_upload/statement');
	}
	
	public function upload_statement_action(Request $request)
	{
		/*echo "<pre>";
		print_r($request->file('file'));
		print_r("'".$request->file('file')->getMimeType()."'");
		
		exit;*/
		$validatedData = $request->validate([
            'file' => 'required|mimes:csv,txt,text/plain|max:2048',
        ]);
		
		/*print_r($validatedData);
		
		exit;*/

       /* $fileName = time().'.'.$request->file->extension();  

        $request->file->move(public_path('uploads'), $fileName);

        return back()
            ->with('success','You have successfully upload file.')
            ->with('file',$fileName);
			
			
		$request->validate([
            'import_file' => 'required'
        ]);*/
        Excel::import(new TransactionsImport, request()->file('file'));
        return back()->with('success', 'Contacts imported successfully.');	
		
			
	}
	
}
