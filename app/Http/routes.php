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

    Route::get('/', 'HomeController@index');
    Route::get('/blog', 'HomeController@blog');
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
    Route::get('new-post','HomeController@create');
	// save new post
	Route::post('new-post','HomeController@store');
	Route::get('edit/{slug}','HomeController@edit');
	 // update post
	Route::post('update','HomeController@update');
	 // delete post
	Route::get('delete/{id}','HomeController@destroy');

});
