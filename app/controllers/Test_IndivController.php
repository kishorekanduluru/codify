<?php
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
class Test_IndivController extends BaseController {
	
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
	public function getResourcesDetails() {
		$request = Input::get ( 'list' );
		$selected_List = array ();
		$selected_List = explode ( ",", reset ( $request ) );
		// $selected_List=$request;
		$filersInfo = DB::table ( 'node_properties' )->whereIn ( 'id', $selected_List )->where ( 'type', 'filer' )->get ();
		$filers_num = DB::table ( 'node_properties' )->whereIn ( 'id', $selected_List )->where ( 'type', 'filer' )->count ();
		
		$hostsInfo = DB::table ( 'node_properties' )->whereIn ( 'id', $selected_List )->where ( 'type', 'host' )->get ();
		
		$hosts_num = DB::table ( 'node_properties' )->whereIn ( 'id', $selected_List )->where ( 'type', 'host' )->count ();
		
		Session::flush ();
		Session::put ( 'hosts_num', $hosts_num );
		Session::put ( 'filers_num', $filers_num );
		Session::put ( 'hostsInfo', serialize ( $hostsInfo ) );
		Session::put ( 'filersInfo', serialize ( $filersInfo ) );
		// Session::put('hosts', $hosts);
		// Session::put('filers',$filers);
		return \View::make ( 'user.Test.DOT.Individual.dotInstallOptions' )->with ( 'filersInfo', $filersInfo );
	}
	public function setFilerDetails() {
		$FilerDetails = new Collection ();
		
		foreach ( unserialize ( Session::get ( 'filersInfo' ) ) as $filer ) {
			$IPaddress = DB::table ( 'node_properties' )->where ( 'id', $filer->id )->pluck ( 'ip' );
			$filerInfoObj = new FilerInfo ();
			$filerInfoObj->setFilerId ( $filer->id );
			$filerInfoObj->setIPAddress ( $IPaddress );
			$filerInfoObj->setMode ( Input::get ( 'mode' . $filer->id ) );
			$FilerDetails->push ( $filerInfoObj );
			// Session::put('mode'.$filerId,Input::get('mode'.$filerId));
			// echo Session::get('mode'.$filerId);
		}
		Session::put ( 'FilerDetails', serialize ( $FilerDetails ) );
		// var_dump($FilerDetails);
		return \View::make ( 'user.Test.DOT.Individual.templateChoice' );
	}
	public function getTemplateChoice() {
		$template_choice = Input::get ( 'template_choice' );
		$Template_OSInfo = new Collection ();
		if ($template_choice == "YES") {
			
			$osList = DB::table ( 'temp_host' )->distinct ()->select ( 'os_id' )->get ();
			
			foreach ( $osList as $os ) {
				$os_name = DB::table ( 'os' )->where ( 'id', $os->os_id )->pluck ( 'software_name' );
				$osObj = new OS ();
				$osObj->id = $os->os_id;
				$osObj->software_name = $os_name;
				$Template_OSInfo->push ( $osObj );
			}
			// var_dump($Template_OS);
			// echo Session::get('testbedId');
			return \View::make ( 'user.Test.DOT.Individual.HostOSPlatform' )->with ( 'Template_OSInfo', $Template_OSInfo );
		} else if ($template_choice == "NO") {
			$os = OS::all ();
			$os_versions = OS_Versions::all ();
			
			// $TB_hostsList= DB::table('testbed_properties')->where('testbed_id',Session::get('testbedId'))->where('resource_type','host')->select('resource_id')->get();
			// $TB_hostsList_Arr = json_decode(json_encode($TB_hostsList), true);
			// var_dump($TB_hostsList_Arr);
			echo "iam in";
			$hostInfo = unserialize ( Session::get ( 'hostsInfo' ) );
			Session::put ( 'hosts', $hostInfo );
			return \View::make ( 'user.Test.DOT.Individual.hostOptions' )->with ( 'os', $os )->with ( 'os_versions', $os_versions );
		}
	}
	public function getByHostOSPlatform() {
		
		// Session::put('filersInfo',serialize($filersInfo));
		$HostOSPlatform = Input::get ( 'HostOSPlatform');
		
		$jobsList = DB::table ( 'temp_host' )->where ( 'os_id', $HostOSPlatform )->distinct ()->select ( 'job_id' )->get ();
		
		$jobs_matched = array ();
		
		foreach ( $jobsList as $job ) {
			$job_hosts = DB::table ( 'temp_host' )->where ( 'job_id', $job->job_id )->count ();
			$job_filers = DB::table ( 'temp_filer' )->where ( 'job_id', $job->job_id )->count ();
			
			if (($job_hosts == Session::get ( 'hosts_num' )) && ($job_filers == Session::get ( 'filers_num' ))) {
				array_push ( $jobs_matched, $job->job_id );
			}
		}
		$resources = DB::table ( 'job' )->whereIn ( 'id', $jobs_matched )->get ();
		// var_dump($resources);
		$number = DB::table ( 'job' )->whereIn ( 'id', $jobs_matched )->count ();
		
		return \View::make ( 'Practise.Indiv_Tem_Selctn' )->with ( 'count', $number )->with ( 'resources', $resources );
	}
	public function getSelectedInfo() {
		$selected_Job = Input::get ( 'selJob_id' );
		foreach ( unserialize ( Session::get ( 'hostsInfo' ) ) as $host ) {
			
			$hosts [] = $host->id;
		}
		
		$hostsIp = DB::table ( 'node_properties' )->whereIn ( 'id', $hosts )->select ( 'ip', 'id' )->get ();
		$hostsInfo = DB::table ( 'temp_host' )->where ( 'job_id', $selected_Job )->get ();
		// var_dump($hostsInfo );
		$i = 0;
		
		$HostDetails = new Collection ();
		
		foreach ( $hostsInfo as $host ) {
			$hostInfoObj = new HostInfo ();
			
			$os_type = DB::table ( 'OS' )->where ( 'id', $host->os_id )->pluck ( 'software_name' );
			$version = DB::table ( 'OS_Versions' )->where ( 'id', $host->version_id )->pluck ( 'version' );
			$IPaddress = DB::table ( 'node_properties' )->where ( 'id', $host->resource_id )->pluck ( 'ip' );
			
			$hostInfoObj->setHostId ( $hosts [$i] );
			$hostInfoObj->setOsType ( $os_type );
			$hostInfoObj->setOsVersion ( $version );
			$hostInfoObj->setIPAdress ( $IPaddress );
			$hostInfoObj->setArchitecture ( $host->architecture );
			$hostInfoObj->setProtocol ( $host->protocol );
			$hostInfoObj->setOs_id ( $host->os_id );
			$hostInfoObj->setVersion_id ( $host->version_id );
			
			$HostDetails->push ( $hostInfoObj );
			// echo $hostInfo->getHostId();
			Session::put ( 'SANBOOT', 'NO' );
			Session::put ( 'DNMP', '0.4.7-48.el5_8.2' );
			Session::put ( 'kernal', '2.6.18-308.4.1.el5' );
			
			// Session::put('os_id'.$hosts[$i],$host->os_id);
			// Session::put('versions_id'.$hosts[$i],$host->version_id);
			// Session::put('os'.$hosts[$i],$os_type);
			// Session::put('versions'.$hosts[$i],$version);
			
			// Session::put('protocol'.$hosts[$i],$host->protocol);
			// Session::put('architecture'.$hosts[$i],$host->architecture);
			
			// echo Session::get('os_id'.$hosts[$i]);
			// echo Session::get('os'.$hosts[$i]);
			// echo Session::get('versions'.$hosts[$i]);
			// echo Session::get('protocol'.$hosts[$i]);
			// echo Session::get('architecture'.$hosts[$i]);
			
			// echo $hosts[$i];
			$i ++;
		}
		
		$FilersDetails = unserialize ( Session::get ( 'FilerDetails' ) );
		// var_dump($HostDetails);
		// var_dump($FilerDetails);
		// var_dump($HostDetails);
		Session::put ( 'HostDetails', serialize ( $HostDetails ) );
		// Session::put('FilerDetails',serialize($FilerDetails));
		return \View::make ( 'user.Test.DOT.resourcesReview' )->with ( 'HostDetails', $HostDetails )->with ( 'FilerDetails', $FilersDetails );
	}
	public function setHostOptions() {
		// echo Session::get('testbedId');
		foreach ( unserialize ( Session::get ( 'hostsInfo' ) ) as $host ) {
			
			$hosts [] = $host->id;
		}
		// var_dump($hostsIdArr);
		$HostDetails = new Collection ();
		foreach ( $hosts as $hId ) {
			$hostInfoObj = new HostInfo ();
			$os_id = Input::get ( 'os' . $hId );
			// echo Input::get('protocol'.$hId->resource_id);
			// echo Input::get('architecture'.$hId->resource_id);
			$ver_id = Input::get ( 'versions' . $hId );
			$os_type = DB::table ( 'OS' )->where ( 'id', $os_id )->pluck ( 'software_name' );
			$version = DB::table ( 'OS_Versions' )->where ( 'id', $ver_id )->pluck ( 'version' );
			$IPaddress = DB::table ( 'node_properties' )->where ( 'id', $hId )->pluck ( 'ip' );
			
			$hostInfoObj->setHostId ( $hId );
			$hostInfoObj->setOsType ( $os_type );
			$hostInfoObj->setOsVersion ( $version );
			$hostInfoObj->setIPAdress ( $IPaddress );
			$hostInfoObj->setArchitecture ( Input::get ( 'architecture' . $hId ) );
			$hostInfoObj->setProtocol ( Input::get ( 'protocol' . $hId ) );
			$hostInfoObj->setOs_id ( Input::get ( 'os' . $hId ) );
			$hostInfoObj->setVersion_id ( Input::get ( 'versions' . $hId ) );
			
			$HostDetails->push ( $hostInfoObj );
			// echo $hostInfo->getHostId();
			Session::put ( 'SANBOOT', 'NO' );
			Session::put ( 'DNMP', '0.4.7-48.el5_8.2' );
			Session::put ( 'kernal', '2.6.18-308.4.1.el5' );
		}
		Session::put ( 'HostDetails', serialize ( $HostDetails ) );
		$FilersDetails = unserialize ( Session::get ( 'FilerDetails' ) );
		return \View::make ( 'user.Test.DOT.resourcesReview' )->with ( 'HostDetails', $HostDetails )->with ( 'FilerDetails', $FilersDetails );
		echo "iam in";
	}
	public function setTestCases() {
		$items = Input::get ( 'selectedItems[]' );
		echo $items;
	}
}

