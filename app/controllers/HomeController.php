<?php
use Illuminate\Support\Facades\Input;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
class HomeController extends BaseController {
	
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
	public function LoginAction() {
		
		// $users = DB::table('user')->get();
		
		// foreach ($users as $user)
		// {
		// var_dump($user->username);
		// }
		// // $newUser=User::create(['username' => Input::get('username') ,]);
		// $username=Input::get('username');
		// $password=Input::get('password');
		// echo "iam in controller".$username." ".$password;
		// echo "nennnnu"." ".$name." ".$password;
		// echo "mine is kishore".$newUser->username;
		if (Session::get ( 'user' ) != "") {
			$user = Session::get ( 'user' );
			if (! strcmp ( $user->type, "user" )) {
				return \View::make ( "user.userHome" );
			} else if (! strcmp ( $user->type, "admin" )) {
				return \View::make ( "admin.adminHome" );
			}
		}
		if ($_POST) {
			$validator = $this->getLoginValidator ();
			if (Session::get ( 'user' ) != "") {
				$user = Session::get ( 'user' );
			} else if ($validator->passes ()) {
				
				$credentials = $this->getLoginCredentials ();
				// echo "credentials".implode(" ",$credentials);
				// echo Auth::attempt($credentials);
				
				if (Auth::attempt ( $credentials )) {
					$user = User::where ( 'username', '=', $credentials ['username'] )->first ();
					Session::put ( 'user', $user );
				}
			}
			if (! strcmp ( $user->type, "user" )) {
				return \View::make ( "user.userHome" );
			} else if (! strcmp ( $user->type, "admin" )) {
				return \View::make ( "admin.adminHome" );
			}
			
			return \View::make ( 'home' );
		}
	}
	public function isValidUser($username, $password) {
		return true;
	}
	
	// protected function isPostRequest(){
	// echo "hkhfkjhdkjfhdkjg";
	// echo "hello iam post".Input::server("REQUEST_METHOD")=="POST";
	// return Input::server("REQUEST_METHOD")=="POST";
	// }
	protected function getLoginValidator() {
		return Validator::make ( Input::all (), [ 
				"username" => "required",
				"password" => "required|between:1,64" 
		] );
	}
	protected function getLoginCredentials() {
		return [ 
				"username" => Input::get ( "username" ),
				"password" => Input::get ( "password" ) 
		];
	}
	
// 	  public function profile(){
// 	  	return View::make("user/profile");
// 	  }
	  public function LogoutAction() {
	  	
	  	Auth::logout();
		Session::flush();
	  	return Redirect::to('/');
	  }
	  
	 
}

