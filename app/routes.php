<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('before' => 'auth', 'uses' => 'UserController@showHome'));
Route::get('login', function() {
	return View::make('user.login');
});
Route::post('login', 'UserController@doLogin');
Route::get('logout', function() {
	Session::flush();
	return Redirect::to('login');
});

Route::group(array('before' => 'auth'), function() {
	Route::get('link', 'UserController@showLink');
	Route::post('link', 'UserController@doLink');

	Route::group(array('before' => 'linked'), function() {
		Route::model('character', 'Character');
		Route::get('characters', 'CharacterController@showCharacters');
		Route::get('character/add', 'CharacterController@showAddForm');
		Route::post('character/add', 'CharacterController@doAddCharacter');
		Route::get('character/main/{character}', 'CharacterController@doSetMain');
		Route::get('character/delete/{character}', 'CharacterController@doDelete');

		Route::group(array('before' => 'goon'), function() {
			Route::get('sponsors', 'SponsorController@showSponsors');
			Route::get('sponsor/add', 'SponsorController@showAddForm');
			Route::post('sponsor/add', 'SponsorController@doAddSponsor');
		});
	});

	Route::group(array('before' => 'auth|admin', 'prefix' => 'admin'), function() {
		Route::model('user', 'User');
		Route::get('/', 'AdminController@showList');
		Route::post('/', 'AdminController@showList');
		Route::get('user/{user}', 'AdminController@showUser');
	});
	
});
