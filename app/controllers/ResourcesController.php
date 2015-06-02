<?php
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Doctrine\DBAL\Types\Type;
use Illuminate\Redis\Database;
use Illuminate\Support\Contracts\ArrayableInterface;
class ResourcesController extends BaseController {
	
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
	public function getResources() {
		$resources = DB::table ( 'node_properties' )->where ( 'status', 'free' )->get ();
		// var_dump($resources);
		$number = DB::table ( 'node_properties' )->where ( 'status', 'free' )->count ();
		
		return \View::make ( 'Practise.sample' )->with ( 'count', $number )->with ( 'resources', $resources );
		// return View::make('user.Install.resourceReserve')->with('count',$number)->with('resources',$resources);
		// foreach ($users as $user)
		// {
		// var_dump($user->ip);
		// }
		// $resources = DB::table('node_properties')->where('type', 'free')->get();
		// var_dump($resources);
	}
	public function getConfrmList() {
		echo "iam in conrfirm list";
		$request = Input::get ( 'resource' );
		var_dump ( $request );
		// $hosts=array();
		// $filers=array();
		// $selected_List=array();
		// $resources_checked = Input::get('resource');
		// $resources = DB::table('node_properties')
		// ->whereIn('id', $resources_checked)->get();
		// foreach ($resources as $res){
		// if($res->type == "host")
		// {
		// $hosts[]=$res;
		// $selected_List[]=$res->id;
		// }
		// else if($res->type == "filer")
		// {
		// $filers[]=$res;
		// $selected_List[]=$res->id;
		// }
		
		// }
		
		// // foreach ($hosts as $host){
		// // var_dump(" host ".$host->ip);
		// // }
		// // foreach ($filers as $filer){
		// // var_dump("filer ".$filer->ip);
		// // }
		// //$selectedList_str=implode(",",$selected_List);
		// //echo $selectedList_str;
		// //Session::flash('selected_List',$selected_List);
		// // $hosts_json=Response::json($hosts);
		// // var_dump($hosts_json);
		// return View::make('Practise.resourceConfirmation')->with('hosts',$hosts)->with('filers',$filers)->with('data',serialize($selected_List));
	}
	public function getHostInfo() {
		$request = Input::get ( 'list' );
		$selected_List = array ();
		$selected_List = explode ( ",", reset ( $request ) );
		// $selected_List=$request;
		
		$resources = DB::table ( 'node_properties' )->whereIn ( 'id', $selected_List )->get ();
		foreach ( $resources as $res ) {
			if ($res->type == "host") {
				$hosts [] = $res;
			} else if ($res->type == "filer") {
				$filers [] = $res;
			}
		}
		
		$os = OS::all ();
		$os_versions = OS_Versions::all ();
		
		// Session::flush();
		Session::put ( 'hosts', $hosts );
		Session::put ( 'filers', $filers );
		return \View::make ( 'user.Install.hostOptions' )->with ( 'os', $os )->with ( 'os_versions', $os_versions )->with ( 'resources', serialize ( $resources ) );
		
		// foreach ($hosts as $host){
		// var_dump(" host ".$host->ip);
		// }
		// foreach ($filers as $filer){
		// var_dump("filer ".$filer->ip);
		// }
		// echo "iam in";
		
		// foreach ($hosts as $host){
		// $data['hosts'] = $hosts;
		// }
	}
	public function setHostOSInfo($resources) {
		$resources = unserialize ( $resources );
		
		foreach ( $resources as $res ) {
			if ($res->type == "host") {
				$hosts [] = $res;
			} 

			else if ($res->type == "filer") {
				$filers [] = $res;
			}
		}
		foreach ( $hosts as $host ) {
			$os_type = DB::table ( 'OS' )->where ( 'id', Input::get ( 'os' . $host->id ) )->pluck ( 'software_name' );
			$version = DB::table ( 'OS_Versions' )->where ( 'id', Input::get ( 'versions' . $host->id ) )->pluck ( 'version' );
			// echo $os_name;
			// Session::forget('os'.$host->id);
			// Session::forget('versions'.$host->id);
			// Session::forget('protocol'.$host->id);
			// Session::forget('architecture'.$host->id);
			Session::put ( 'SANBOOT', 'NO' );
			Session::put ( 'DNMP', '0.4.7-48.el5_8.2' );
			Session::put ( 'kernal', '2.6.18-308.4.1.el5' );
			
			Session::put ( 'os_id' . $host->id, Input::get ( 'os' . $host->id ) );
			Session::put ( 'versions_id' . $host->id, Input::get ( 'versions' . $host->id ) );
			Session::put ( 'os' . $host->id, $os_type );
			Session::put ( 'versions' . $host->id, $version );
			
			Session::put ( 'protocol' . $host->id, Input::get ( 'protocol' . $host->id ) );
			Session::put ( 'architecture' . $host->id, Input::get ( 'architecture' . $host->id ) );
		}
		// var_dump(Session::all());
		
		return \View::make ( 'user.Install.filerOptions' )->with ( 'filers', $filers )->with ( 'resources', serialize ( $resources ) );
	}
	public function getResourcesInstallInfo($resources) {
		$resources = unserialize ( $resources );
		
		foreach ( $resources as $resource ) {
			if ($resource->type == "host") {
				$hosts [] = $resource;
			} 

			else if ($resource->type == "filer") {
				$filers [] = $resource;
			}
		}
		
		foreach ( $filers as $filer ) {
			
			Session::put ( 'mode' . $filer->id, Input::get ( 'mode' . $filer->id ) );
			// var_dump($filer->id);
			// Input::get('mode'.$filer->id);
			// var_dump(Session::get('mode'.$filer->id));
		}
		return \View::make ( 'user.Install.resourcesReview' )->with ( 'resources', serialize ( $resources ) );
	}
	public function setJobDetails($resources) {
		$user_id = Session::get ( 'user' )->id;
		$time = Carbon\Carbon::now ();
		$job_id = DB::table ( 'Job' )->insertGetId ( array (
				'job_name' => Input::get ( 'jobname' ),
				'status' => 'queued',
				'created_at' => $time->toDateTimeString (),
				'user_id' => $user_id 
		) );
		
		if (Input::get ( 'temp_option' )) {
			
			$result = DB::table ( 'Template' )->insert ( array (
					'job_id' => $job_id,
					'created_at' => $time->toDateTimeString (),
					'user_id' => $user_id 
			) );
		}
		
		$resources = unserialize ( $resources );
		
		foreach ( $resources as $resource ) {
			if ($resource->type == "host") {
				$hosts [] = $resource;
			} 

			else if ($resource->type == "filer") {
				$filers [] = $resource;
			}
		}
		
		foreach ( $hosts as $host ) {
			
			DB::table ( 'Temp_Host' )->insert ( array (
					'resource_id' => $host->id,
					'job_id' => $job_id,
					'os_id' => Session::get ( 'os_id' . $host->id ),
					'version_id' => Session::get ( 'versions_id' . $host->id ),
					'architecture' => Session::get ( 'architecture' . $host->id ),
					'protocol' => Session::get ( 'protocol' . $host->id ),
					'created_at' => $time->toDateTimeString () 
			) );
			
			// echo Session::get('os_id'.$host->id);
			// echo Session::get('versions_id'.$host->id);
			// echo Session::get('protocol'.$host->id);
			// echo Session::get('architecture'.$host->id);
		}
		
		foreach ( $filers as $filer ) {
			
			DB::table ( 'Temp_Filer' )->insert ( array (
					'resource_id' => $filer->id,
					'job_id' => $job_id,
					'mode' => Session::get ( 'mode' . $filer->id ),
					'created_at' => $time->toDateTimeString () 
			) );
			
			// echo Session::get('mode'.$filer->id);
		}
		
		Mail::send ( 'mail', array (
				'firstname' => 'kishore' 
		), function ($message) {
			$message->to ( 'kishore5424@gmail.com', 'kishore kanduluru')->subject('[nLAB] Resources Links for Logs References and Updates!');
	
});
		
         
	    return \View::make('user.Install.ConfirmationMessage')->with('resources',serialize($resources));

		
		
	
}
}

