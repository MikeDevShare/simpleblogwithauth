<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/', 'IndexController@index');
    Route::get('/blog', 'IndexController@blog');

});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('shop','ShopController@index');
    Route::get('dashboard','HomeController@dash');
    Route::get('dashboard/new-post','HomeController@create');
	// save new post
	Route::post('new-post','HomeController@store');
	Route::get('dashboard/edit/{slug}','HomeController@edit');
	 // update post
	Route::post('dashboard/update','HomeController@update');
	 // delete post
	Route::get('dashboard/delete/{id}','HomeController@destroy');

	Route::get('dashboard/categories','HomeController@categories');
	Route::post('dashboard/categories/add','HomeController@cat_add');
	Route::post('dashboard/get-cat','HomeController@get_cat');
	Route::post('dashboard/edit-cat','HomeController@edit_cat');
	Route::post('dashboard/delete-cat','HomeController@destroy_cat');
	

});
Route::group(['middleware' => ['web']], function () {
	Route::get('/blog/{slug}',['as' => 'post', 'uses' => 'IndexController@show'])->where('slug', '[A-Za-z0-9-_]+');
    
});

