<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['transaction_time', 'amount', 'description', 'balance'];
	
	public function categories()
    {
		/*print_r("Hello");
		exit;*/
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
