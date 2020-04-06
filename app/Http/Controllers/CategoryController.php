<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
        $categories = Category::where('parent_id','=',0)
						->with('childrenCategories')
						->get();
		/*echo "<pre>";
		print_r($categories);
		echo "</pre>";*/
		
		/*$category = Category::with('transactions')->find(7);
		print_r("Hello");
		print_r($category);
		print_r("========");*/
		return view('categories/index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$category = Category::find(1);		
        return view('categories/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
			'name' => 'required|max:255',
			//'description' => 'required|max:255'
		]);
		$category = Category::create($validatedData);

		return redirect('/categories')->with('success', 'Category is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);		
		return view('categories/edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
			'name' => 'required|max:255',
			'description' => 'required|max:255'
		]);
        Category::whereId($id)->update($validatedData);

        return redirect('/categories')->with('success', 'Category is successfully updated');
    }

	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect('/categories')->with('success', 'Category is successfully deleted');
    }
	
	public function back()
	{
		echo "<pre>";
			print_r("BACK");
		echo "</pre>";
		exit();
		return true;
	}
	public function my_customfunction()
	{
		echo "my_custom_function";
		exit;
		return true;
	}
	
}
