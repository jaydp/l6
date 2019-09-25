<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('countries', 'CountryController');
Route::resource('states', 'StateController');
Route::get('categories/back', 'CategoryController@back')->name('categories.back');
Route::get('categories/custom', 'CategoryController@my_custom_function')->name('categories.my_custom_function');
Route::resource('categories', 'CategoryController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
