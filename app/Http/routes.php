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

// ROUTE LOGIN & REGISTER
Route::group(['middleware' => 'user.gest'], function () {
	Route::get('/', function(){
		return view('home');
	});
	Route::get('login', ['uses' => 'UserController@authenticate']);
	Route::post('login', ['as' => 'sentinel.login.user', 'uses' => 'UserController@authenticate']);
	Route::get('register', ['uses' => 'UserController@register']);
	Route::post('register', ['as' => 'sentinel.register.user', 'uses' => 'UserController@register']);
});

// ROUTE USER
Route::group(['middleware' => 'user.auth'], function(){
	Route::get('dashboard', ['uses' => 'UserController@profil']);
	Route::get('editProfil', ['uses' => 'UserController@editProfil']);
	Route::post('editProfil', ['as' => 'post.edit', 'uses' => 'UserController@editProfil']);
	Route::get('logout', ['as' => 'user.logout', 'uses' => 'UserController@logout']);
	Route::get('abonnement', ['uses' => 'UserController@abonnement']);
});

// ROUTE ADMIN
Route::group(['prefix' => 'admin', 'middleware' => ['user.auth', 'user.admin']], function () {
	Route::get('/', ['uses' => 'AdminController@index']);
	Route::get('users', ['uses' => 'AdminController@users']);
	Route::get('stations', ['uses' => 'AdminController@stations']);

	Route::get('stations/create', ['uses' => 'AdminController@createStation']);
	Route::post('stations/create', ['uses' => 'AdminController@createStation']);

	Route::get('stations/update', ['uses' => 'AdminController@updateStation']);
	Route::post('stations/update', ['uses' => 'AdminController@updateStation']);

	Route::get('stations/delete', ['uses' => 'AdminController@deleteStation']);
	Route::post('stations/delete', ['uses' => 'AdminController@deleteStation']);
});