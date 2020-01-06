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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/denied', 'HomeController@permission_denied')->name('denied');

Route::group(['middleware' => ['auth','ability']], function () {
	
	Route::resource('countries', 'CountryController');
	
	Route::resource('states', 'StateController');
	
	Route::get('categories/back', 'CategoryController@back')->name('categories.back');
	Route::get('categories/custom', 'CategoryController@my_customfunction')->name('categories.my_custom_function');
	Route::resource('categories', 'CategoryController');
	
	Route::get('roles/refresh_permissions', 'RoleController@refresh_permissions')->name('roles.refresh_permissions');
	Route::get('roles/{role}/permissions', 'RoleController@permissions')->name('roles.permissions')->where('role', '[0-9]+');
	Route::post('roles/{role}/permissions', 'RoleController@permissions_update')->name('roles.permissions')->where('role', '[0-9]+');
	Route::resource('roles', 'RoleController');
	
	Route::get('permissions', 'PermissionController@index')->name('permissions.index');
	Route::post('permissions', 'PermissionController@update')->name('permissions.update');
	
});
