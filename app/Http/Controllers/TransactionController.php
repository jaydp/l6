<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Transaction;
use App\Category;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
		$search = $request->input('search');
		
        $transactions = Transaction::when($search, function($query, $search){
							return $query->where('description', 'like', '%'.$search.'%');
						})->orderBy('category_id','ASC')->get();//->whereNull('category_id')
						
						//print_r($transactions);
		
		/*$category = Transaction::with('categories')->find(1159);
		print_r("Hello");
		print_r($category);
		print_r("========");
		exit;*/
		$categories = Category::where('parent_id','=',0)
						->with('childrenCategories')
						->get();
						
		return view('transactions/index', compact('transactions','categories','search'));
    }
	
	
	public function assgin_category(Request $request)
	{
		$input = $request->all();
		
		if(!empty($input['cat'])&&!empty($input['transactions']))
		{			
			Transaction::whereIn('id',$input['transactions'])->update(['category_id' => $input['cat']]);
		}
		
		return response()->json(['success'=>'Got Simple Ajax Request.']);
	}
	
}
