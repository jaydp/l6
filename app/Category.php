<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description'];
	
	public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
	
	public function childrenCategories()
	{
		return $this->hasMany(Category::class, 'parent_id')->with('categories');
	}
	
	public function transactions()
    {
        return $this->hasMany(Transaction::class,'category_id');
    }
	
	public static function get_name_by_id($id)
	{
		if(empty($id)) return;
		
		$category = Category::find($id);
		
		if(empty($category)) return;
		
		return $category->name;
	}

}
