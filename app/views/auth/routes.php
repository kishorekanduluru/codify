<?php

use Illuminate\Support\Facades\Input;
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

 Route::any('/', function()
 {
 	return View::make('home');
});
 
 Route::get('/test/{squirrel}', function($squirrel){$data['squirrel'] = $squirrel;return View::make('simple', $data);});
 //Route::any("user/profile","HomeController@profile");
 
//  Route::post('/user/hosts/installation',function() {
//  	echo "hello iam in";
//   });
 
// Route::get('username={name}+password={pword}', function($name,$pword)
// {
// 	return View::make('show')->with('name',$name);
// });

 
Route::get('/login','HomeController@LoginAction');
Route::get('/logout','HomeController@LogoutAction');

Route::post('/user/taskSelection','UserController@taskBtnAction');
Route::get('/user/resourceReservation','ResourcesController@getResources');
Route::post('/user/confirmSelection','ResourcesController@getConfrmList');
 Route::any('/user/hostde/installation/','ResourcesController@getHostInfo');
