<?php
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
class UserController extends BaseController {
	
	/*
	 * |--------------------------------------------------------------------------
	 * | Default Home Controller
	 * |--------------------------------------------------------------------------
	 * |
	 * | You may wish to use controllers instead of, or in addition to, Closure
	 * | based routes. That's great! Here is an example controller method to
	 * | get you started. To route to this controller, just add the route:
	 * |
	 * |	Route::get('/', 'HomeController@showWelcome');
	 * |
	 */
	public function taskBtnAction() {
		$option = Input::get ( 'task_selection' );
		if ($option == "Install only") {
			return Redirect::to ( 'user/resourceReservation' );
			return View::make ( "user.Install.resourceReserve" );
		} else if ($option == "Install & Test") {
			return View::make ( "user.Test.testOptions" );
		}
// 		dd(Input::has('task_selection'));
		//return View::make ( 'home' );
	
	}
	
	
}

