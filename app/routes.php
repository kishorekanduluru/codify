<?php
use Illuminate\Support\Facades\Input;
use Illuminate\Support\ServiceProvider;
use Doctrine\DBAL\Schema\View;

/*
 * |--------------------------------------------------------------------------
 * | Application Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register all of the routes for an application.
 * | It's a breeze. Simply tell Laravel the URIs it should respond to
 * | and give it the Closure to execute when that URI is requested.
 * |
 */

Route::any ( '/', function () {
	return \View::make ( 'home' );
} );

Route::any ( '/hello', function () {
	return \View::make ( 'hello' );
} );

Route::any ( '/example1', function () {
	// $selected_List=array();
	// $selected_List=explode(",", $data);
	// var_dump("iam in selected list".$selected_List);
	$request = Input::all ();
	var_dump ( $request );
} );
Route::any ( '/mail', function () {
	Mail::send ( 'hello', array (
			'firstname' => 'kishore' 
	), function ($message) {
		$message->to ( 'kishore5424@gmail.com', 'kishore reddy' )->subject ( 'Welcome to the Laravel 4 Auth App!' );
	} );
	echo "done";
} );

Route::any ( 'user/logs', function () {
	$file = "app\storage\logs\log.txt";
	
	if (! file_exists ( $file ))
		die ( "I'm sorry, the file doesn't seem to exist." );
	
	$type = filetype ( $file );
	// Get a date and timestamp
	$today = date ( "F j, Y, g:i a" );
	$time = time ();
	// Send file headers
	header ( "Content-type: $type" );
	header ( "Content-Disposition: attachment;filename=log.txt" );
	header ( "Content-Transfer-Encoding: binary" );
	header ( 'Pragma: no-cache' );
	header ( 'Expires: 0' );
	// Send the file contents.
	set_time_limit ( 0 );
	readfile ( $file );
} );

// Route::any("user/profile","HomeController@profile");

Route::any ( '/example', function () {
	$os = OS::all ();
	$os_versions = OS_Versions::all ();
	return \View::make ( 'Practise/sample' )->with ( 'os', $os )->with ( 'os_versions', $os_versions );
} );

Route::any ( 'user/host/installation/ajax-osver', function () {
	$osId = Input::get ( 'id' );
	$versions = OS_Versions::where ( 'os_id', '=', $osId )->get ();
	return Response::json ( $versions );
} );

Route::any ( 'user/host/installation/hostOptions', function () {
	
	$request = Input::get ( 'jsondata' );
	if (Session::has ( 'hosts' )) {
		echo "iam in session";
		var_dump ( $hosts );
	}
	// var_dump(json_decode($request));
	
	// foreach(json_decode($request) as $product)
	// {
	// echo "hostID:".$product->hostId;
	// echo "osType ".$product->osType;
	// echo "version ".$product->version;
	// echo "architecture ".$product->architecture;
	// echo "protocol ".$product->protocol;
	// }
	//
	// echo "iam finally in";
	// return Response::json($request);
	return \View::make ( 'user.Install.filerOptions' );
} );

Route::any ( 'user/resourcesConfirmation', function () {
	$hosts = array ();
	$filers = array ();
	$request = Input::get ( 'jsondata' );
	
	// var_dump(json_decode($request));
	
	$resources = DB::table ( 'node_properties' )->whereIn ( 'id', json_decode ( $request ) )->get ();
	
	foreach ( $resources as $res ) {
		if ($res->type == "host") {
			$hosts [] = $res;
			// $res->type;
		} else if ($res->type == "filer") {
			$filers [] = $res;
			// echo $res->type;
		}
	}
	
	return Response::json ( array (
			'hosts' => $hosts,
			'filers' => $filers 
	) );
} );

Route::any ( '/getQueueInfo', function () {
	$TaskDetails = new Collection ();
	$tasks = DB::table ( 'job' )->where ( 'status', 'queued' )->get ();
	foreach ( $tasks as $task ) {
		$hosts_num = DB::table ( 'temp_host' )->where ( 'job_id', $task->id )->count ();
		$filers_num = DB::table ( 'temp_filer' )->where ( 'job_id', $task->id )->count ();
		
		$taskInfoObj = new TaskInfo ();
		$taskInfoObj->setId ( $task->id );
		$taskInfoObj->setJob_name ( $task->job_name );
		$taskInfoObj->setCreatedAt ( $task->created_at );
		$taskInfoObj->setStatus ( $task->status );
		// $taskInfoObj->setTemplate_Info($task->job_name);
		
		$taskInfoObj->setHosts_num ( $hosts_num );
		$taskInfoObj->setFilers_num ( $filers_num );
		$taskInfoObj->setLogs_id ( $task->id );
		
		$TaskDetails->push ( $taskInfoObj );
		// Session::put('mode'.$filerId,Input::get('mode'.$filerId));
		// echo Session::get('mode'.$filerId);
	}
	// Session::put('FilerDetails',serialize($FilerDetails));
	// var_dump($TaskDetails);
	return Response::json ( array (
			'QueuedJobs' => $TaskDetails 
	) );
} );
Route::any ( '/getRunning', function () {
	$TaskDetails = new Collection ();
	$tasks = DB::table ( 'job' )->where ( 'status', 'running' )->get ();
	foreach ( $tasks as $task ) {
		$hosts_num = DB::table ( 'temp_host' )->where ( 'job_id', $task->id )->count ();
		$filers_num = DB::table ( 'temp_filer' )->where ( 'job_id', $task->id )->count ();
		
		$taskInfoObj = new TaskInfo ();
		$taskInfoObj->setId ( $task->id );
		$taskInfoObj->setJob_name ( $task->job_name );
		$taskInfoObj->setCreatedAt ( $task->created_at );
		$taskInfoObj->setStatus ( $task->status );
		// $taskInfoObj->setTemplate_Info($task->job_name);
		
		$taskInfoObj->setHosts_num ( $hosts_num );
		$taskInfoObj->setFilers_num ( $filers_num );
		$taskInfoObj->setLogs_id ( $task->id );
		
		$TaskDetails->push ( $taskInfoObj );
		// Session::put('mode'.$filerId,Input::get('mode'.$filerId));
		// echo Session::get('mode'.$filerId);
	}
	// Session::put('FilerDetails',serialize($FilerDetails));
	// var_dump($TaskDetails);
	return Response::json ( array (
			'RunningJobs' => $TaskDetails 
	) );
} );

Route::any ( '/getFinished', function () {
	
	$TaskDetails = new Collection ();
	$tasks = DB::table ( 'job' )->where ( 'status', 'finished' )->get ();
	foreach ( $tasks as $task ) {
		$hosts_num = DB::table ( 'temp_host' )->where ( 'job_id', $task->id )->count ();
		$filers_num = DB::table ( 'temp_filer' )->where ( 'job_id', $task->id )->count ();
		
		$taskInfoObj = new TaskInfo ();
		$taskInfoObj->setId ( $task->id );
		$taskInfoObj->setJob_name ( $task->job_name );
		$taskInfoObj->setCreatedAt ( $task->created_at );
		$taskInfoObj->setStatus ( $task->status );
		// $taskInfoObj->setTemplate_Info($task->job_name);
		
		$taskInfoObj->setHosts_num ( $hosts_num );
		$taskInfoObj->setFilers_num ( $filers_num );
		$taskInfoObj->setLogs_id ( $task->id );
		
		$TaskDetails->push ( $taskInfoObj );
		// Session::put('mode'.$filerId,Input::get('mode'.$filerId));
		// echo Session::get('mode'.$filerId);
	}
	// Session::put('FilerDetails',serialize($FilerDetails));
	// var_dump($TaskDetails);
	return Response::json ( array (
			'FinishedJobs' => $TaskDetails 
	) );
} );

Route::any ( '/getTemplates', function () {
	$TemplateDetails = new Collection ();
	$templates = DB::table ( 'template' )->get ();
	
	foreach ( $templates as $template ) {
		$hosts_num = DB::table ( 'temp_host' )->where ( 'job_id', $template->job_id )->count ();
		$filers_num = DB::table ( 'temp_filer' )->where ( 'job_id', $template->job_id )->count ();
		
		$template_name = DB::table ( 'job' )->where ( 'id', $template->job_id )->pluck ( 'job_name' );
		$owner = DB::table ( 'user' )->where ( 'id', $template->user_id )->pluck ( 'username' );
		$templateInfoObj = new TemplateInfo ();
		$templateInfoObj->setOwner ( $owner );
		$templateInfoObj->setTemplate_name ( $template_name );
		$templateInfoObj->setTime ( $template->created_at );
		$templateInfoObj->setNo_Hosts ( $hosts_num );
		$templateInfoObj->setNo_Filers ( $filers_num );
		
		$TemplateDetails->push ( $templateInfoObj );
		
		// Session::put('mode'.$filerId,Input::get('mode'.$filerId));
		// echo Session::get('mode'.$filerId);
	}
	// Session::put('FilerDetails',serialize($FilerDetails));
	
	return Response::json ( array (
			'TemplateDetails' => $TemplateDetails 
	) );
} );

Route::any ( '/removeTaskFrmQueue', function () {
	$jobId = Input::get ( 'jobId' );
	DB::table ( 'job' )->where ( 'id', $jobId )->delete ();
	
	return Response::json ( "success" );
} );
Route::any ( '/setTerminatingFrmRunning', function () {
	$jobId = Input::get ( 'jobId' );
	DB::table ( 'job' )->where ( 'id', $jobId )->update ( array (
			'status' => 'terminating' 
	) );
	return Response::json ( "success" );
} );
Route::any ( '/restart', function () {
	$jobId = Input::get ( 'jobId' );
	
	$hosts = DB::table ( 'temp_host' )->where( 'job_id',$jobId )->select('resource_id')->get();
	$filers = DB::table ( 'temp_filer' )->where( 'job_id',$jobId )->select('resource_id')->get();
	//var_dump($hosts);
	$result="true";
	foreach($hosts as $host){
		 $status=DB::table ( 'node_properties' )->where( 'id',$host->resource_id )->pluck('status');
		 if($status == "busy"){
			 $result="false";
		 }
	}
	foreach($filers as $filer){
		 $status=DB::table ( 'node_properties' )->where( 'id',$filer->resource_id )->pluck('status');
		 if($status == "busy"){
			 $result="false";
		 }
	}
	if($result == "true"){
		DB::table ( 'job' )->where ( 'id', $jobId )->update ( array (
			'status' => 'queued' ) );
	}
	return Response::json ($result);
});
Route::any ( 'user/test/resourcesInfo', function () {
	$testbed_id = Input::get ( 'jsondata' );
	$conatainerTB = DB::table ( 'testbed' )->where ( 'id', $testbed_id )->pluck ( 'name' );
	$resources = DB::table ( 'testbed_properties' )->where ( 'testbed_id', $testbed_id )->get ();
	
	foreach ( $resources as $resource ) {
		if ($resource->resource_type == "host") {
			$hosts [] = $resource->resource_id;
		} else if ($resource->resource_type == "filer") {
			$filers [] = $resource->resource_id;
		}
	}
	
	$hostInfo = DB::table ( 'testbed_host' )->whereIn ( 'host_id', $hosts )->where ( 'testbed_id', $testbed_id )->get ();
	
	$TBHostDetails = new Collection ();
	$TBFilerDetails = new Collection ();
	foreach ( $hostInfo as $host ) {
		
		$model = DB::table ( 'host_properties' )->where ( 'id', $host->host_id )->pluck ( 'model' );
		$IPaddress = DB::table ( 'node_properties' )->where ( 'id', $host->host_id )->pluck ( 'ip' );
		$MAC = DB::table ( 'node_properties' )->where ( 'id', $host->host_id )->pluck ( 'mac' );
		$os_type = DB::table ( 'OS' )->where ( 'id', $host->os_id )->pluck ( 'software_name' );
		// $version=DB::table('os_versions')->where('os_id',$host->os_id)->where('id',$host->version_id)->pluck('version');
		
		$hostInfo = new HostInfo ();
		$hostInfo->setMAC ( $MAC );
		$hostInfo->setHBA ( "QLE2650" );
		$hostInfo->setOsType ( $os_type );
		$hostInfo->setModel ( $model );
		$hostInfo->setIPAdress ( $IPaddress );
		$hostInfo->setConatainerTB ( $conatainerTB );
		$TBHostDetails->push ( $hostInfo );
		// array_push($TBHostDetails,$hostInfo);
		
		// Session::put('os'.$host->host_id,$os_type);
		// Session::put('versions'.$host->host_id,$version);
		// Session::put('protocol'.$host->host_id,$host->architecture);
		// Session::put('architecture'.$host->host_id,$host->protocol);
		
		// echo Session::get('os'.$host->host_id);
		// echo Session::get('versions'.$host->host_id);
		// echo Session::get('protocol'.$host->host_id);
		// echo Session::get('architecture'.$host->host_id);
	}
	
	$filers = DB::table ( 'testbed_filer' )->whereIn ( 'filer_id', $filers )->where ( 'testbed_id', $testbed_id )->get ();
	
	foreach ( $filers as $filer ) {
		$filerInfo = new FilerInfo ();
		// echo $filer->filer_id;
		$MAC = DB::table ( 'node_properties' )->where ( 'id', $filer->filer_id )->pluck ( 'mac' );
		$IPaddress = DB::table ( 'node_properties' )->where ( 'id', $filer->filer_id )->pluck ( 'ip' );
		
		$filerInfo->setMAC ( $MAC );
		$filerInfo->setMode ( $filer->mode );
		$filerInfo->setIPAddress ( $IPaddress );
		$filerInfo->setConatainerTB ( $conatainerTB );
		// echo $filerInfo->getMode();
		// echo $IPaddress;
		
		$TBFilerDetails->push ( $filerInfo );
		// array_push($TBFilerDetails,$filerInfo);
	}
	// var_dump($TBHostDetails);
	// var_dump($TBFilerDetails);
	// $arey=array('1','2');
	// var_dump(serialize($arey));
	// var_dump($arey);
	// return Response::json();
	return Response::json ( array (
			'TBHostDetails' => $TBHostDetails,
			'TBFilerDetails' => $TBFilerDetails 
	) );
} );

Route::any ( 'user/test/getHostDetails', function () {
	$jobId = Input::get ( 'jsondata' );
	$HostDetails = new Collection ();
	$hostInfo = DB::table ( 'temp_host' )->where ( 'job_id', $jobId )->get ();
	foreach ( $hostInfo as $host ) {
		
		$IPaddress = DB::table ( 'node_properties' )->where ( 'id', $host->resource_id )->pluck ( 'ip' );
		$os_type = DB::table ( 'OS' )->where ( 'id', $host->os_id )->pluck ( 'software_name' );
		$version = DB::table ( 'os_versions' )->where ( 'os_id', $host->os_id )->where ( 'id', $host->version_id )->pluck ( 'version' );
		$architecture = DB::table ( 'temp_host' )->where ( 'job_id', $jobId )->where ( 'resource_id', $host->resource_id )->pluck ( 'architecture' );
		$protocol = DB::table ( 'temp_host' )->where ( 'job_id', $jobId )->where ( 'resource_id', $host->resource_id )->pluck ( 'protocol' );
		$hostInfo = new HostInfo ();
		
		$hostInfo->setOsType ( $os_type );
		$hostInfo->setIPAdress ( $IPaddress );
		$hostInfo->setOsVersion ( $version );
		$hostInfo->setArchitecture ( $architecture );
		$hostInfo->setProtocol ( $protocol );
		
		$HostDetails->push ( $hostInfo );
		// array_push($TBHostDetails,$hostInfo);
	}
	return Response::json ( array (
			'HostDetails' => $HostDetails 
	) );
} );

Route::any ( '/dualbox', function () {
	return \View::make ( 'Practise.Newfolder.dualbox' );
} );

Route::any ( '/login', 'HomeController@LoginAction' );
Route::get ( '/logout', 'HomeController@LogoutAction' );
// Route::get('/user/userHome','HomeController@userHomeAction');
Route::post ( '/user/taskSelection', 'UserController@taskBtnAction' );
Route::get ( '/user/resourceReservation', 'ResourcesController@getResources' );
Route::any ( '/user/confirmSelection', 'ResourcesController@getConfrmList' );
Route::any ( 'user/host/installation', [ 
		'as' => 'host.install',
		'uses' => 'ResourcesController@getHostInfo' 
] );
Route::any ( '/user/host/OSinstallation/{selected_Nodes}', [ 
		'as' => 'host.OSinstall',
		'uses' => 'ResourcesController@setHostOSInfo' 
] );

// Route::any('/user/host/installation/hostOptions','ResourcesController@setHostOptions');
Route::any ( '/user/host/installation', 'ResourcesController@getHostInfo' );

Route::any ( '//user/Install/filerOptions/{selected_Nodes}', [ 
		'as' => 'resources.OSinstall.confirm',
		'uses' => 'ResourcesController@getResourcesInstallInfo' 
] );

Route::any ( '//user/Install/submitDetails/{selected_Nodes}', [ 
		'as' => 'Job.Details.Submission',
		'uses' => 'ResourcesController@setJobDetails' 
] );

// Install and Test
Route::post ( '/user/test/testFocus', 'TestController@focusSelAction' );
Route::get ( '/user/resourceReservation__individual', 'TestController@getResources' );
// Route::any('/user/test/resourcesInfoFetch','TestController@getResourcesInfo');

Route::any ( '/user/test/DOT/hostOSPlatform', 'TestController@getByHostOSPlatform' );
Route::any ( '/user/test/DOT/template_choice', 'TestController@setTemplateChoice' );
Route::any ( '/user/test/dotInstallOptions', 'TestController@getResourcesInfo' );
Route::any ( '/user/test/filerOptions/{selected_Nodes}/{hostsIp}', [ 
		'as' => 'test.dotInstall.filerOptions',
		'uses' => 'TestController@getHostOSInstallInfo' 
] );

Route::any ( '/user/test/DOT/resourcesView', 'TestController@getSelectedInfo' );
Route::any ( '/user/test/resourcesSubmit', 'TestController@getTestcasesInfo' );
Route::any ( '/user/test/DOT/hostOptions', 'TestController@setHostOptions' );

Route::any ( '/user/test/DOT/Individual/resourcesSelection', 'Test_IndivController@getResourcesDetails' );
Route::any ( '/user/test/DOT/Individual/filerDetails', 'Test_IndivController@setFilerDetails' );
Route::any ( '/user/test/DOT/Individual/template_choice', 'Test_IndivController@getTemplateChoice' );
Route::any ( '/user/test/DOT/Individual/hostOSPlatform', 'Test_IndivController@getByHostOSPlatform' );
Route::any ( '/user/test/DOT/Individual/resourcesView', 'Test_IndivController@getSelectedInfo' );
Route::any ( '/user/test/DOT/Individual/hostOptions', 'Test_IndivController@setHostOptions' );

Route::any('/user/test/testcases','Test_IndivController@setTestCases');
