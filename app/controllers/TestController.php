<?php
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
class TestController extends BaseController {
	
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
	public function focusSelAction() {
		$option=Input::get('test_focus');
		$resourceSelection=Input::get('ResourceSeln');
		
		
		if($option =="Host OS" ){
			echo "iam Host Os";
		}
		
		
		else if($option =="DOT"){
			if($resourceSelection=="Individual" ){
				return Redirect::to('/user/resourceReservation__individual');
			
			}
			else if($resourceSelection=="StaticTestBed" ) {
			$testbeds = DB::table('testbed')->get();
			//var_dump($testbeds);
			return \View::make('user.Test.DOT.StaticTestBeds.resourcesInfo')->with('testbeds',$testbeds);
			}
			
		}
		
		
		else if($option =="HBA"){
			echo "iam HBA";
		}
		
		
       else if($option =="Switch"){
			echo "code hasn't been included .. Iam Switch";
		}
		
		
		else if($option =="Interop"){
				echo "code hasn't been included .. Iam Interop";
		}
	
	}
	
		 
	public function getResources() {
		
		 $resources = DB::table('node_properties')->where('status','free')->get();
// 		 var_dump($resources);
         $number=DB::table('node_properties')->where('status','free')->count();
		 
         return \View::make('Practise.sample_Individual')->with('count',$number)->with('resources',$resources);
		//return View::make('user.Install.resourceReserve')->with('count',$number)->with('resources',$resources);
// 	foreach ($users as $user)
// 		{
// 		var_dump($user->ip);
// 		}
// 		$resources = DB::table('node_properties')->where('type', 'free')->get();
// 	    var_dump($resources);
	}
	
	public function getResourcesInfo(){
	
		$testbed_id=Input::get('testbed');
		Session::put('testbedId',$testbed_id);
        $resources = DB::table('testbed_properties')->where('testbed_id',$testbed_id)->get();
		$hostsIp=array(); 
		$filersIp=array(); 
		foreach ($resources as $resource){
 			if($resource->resource_type == "host")
 			{
 				$hosts[]=$resource->resource_id;
 				array_push($hostsIp,$resource->resource_id);
 			}
 			else if($resource->resource_type== "filer")
 			{
 				$filers[]=$resource->resource_id;
				 array_push($filersIp,$resource->resource_id);
 			}
 				
 		}
	
 		$hostInfo = DB::table('testbed_host')->whereIn('host_id',$hosts)->where('testbed_id',$testbed_id)->get();
		$TBHostDetails=new Collection;
		
		$TBFilerDetails=new Collection;
		foreach ($hostInfo as $host){
			
			$model=DB::table('host_properties')->where('id',$host->host_id)->pluck('model');
			$IPaddress=DB::table('node_properties')->where('id',$host->host_id)->pluck('ip');
			$MAC=DB::table('node_properties')->where('id',$host->host_id)->pluck('mac');
			$os_type=DB::table('OS')->where('id',$host->os_id)->pluck('software_name');
			//$version=DB::table('os_versions')->where('os_id',$host->os_id)->where('id',$host->version_id)->pluck('version');
			
			$hostInfo=new HostInfo();
			$hostInfo->setMAC($MAC);
			$hostInfo->setHBA("QLE2650");
			$hostInfo->setOsType($os_type);
			$hostInfo->setModel($model);
			$hostInfo->setIPAdress($IPaddress);
			
			$TBHostDetails->push($hostInfo);
			//array_push($TBHostDetails,$hostInfo);
			
			//Session::put('os'.$host->host_id,$os_type);
        	//Session::put('versions'.$host->host_id,$version);
			//Session::put('protocol'.$host->host_id,$host->architecture);
        	//Session::put('architecture'.$host->host_id,$host->protocol);
			
			//echo Session::get('os'.$host->host_id);
        	//echo Session::get('versions'.$host->host_id);
			//echo Session::get('protocol'.$host->host_id);
        	//echo Session::get('architecture'.$host->host_id);
			
			
			
		}
		
		$filers = DB::table('testbed_filer')->whereIn('filer_id',$filers)->where('testbed_id',$testbed_id)->get();
		
		foreach ($filers as $filer){
			 $filerInfo=new FilerInfo();
			 $IPaddress=DB::table('node_properties')->where('id',$filer->filer_id)->pluck('ip');
			 $filerInfo->setFilerId($filer->filer_id);
			 $filerInfo->setIPAddress($IPaddress);
			 $TBFilerDetails->push($filerInfo);
			
		}
		
		return \View::make('user.Test.DOT.StaticTestBeds.DotInstallOptions.dotInstallOptions')->with('TBHostDetails',$TBHostDetails)->with('TBFilerDetails',$TBFilerDetails)->with('hostsIp',serialize($hostsIp))->with('filersIp',serialize($filersIp));
	}
	
	
	
	public function getHostOSInstallInfo($filersIp,$hostsIp){
		$FilerDetails=new Collection;
		foreach (unserialize($filersIp) as $filerId){
		   $IPaddress=DB::table('node_properties')->where('id',$filerId)->pluck('ip');
		   $filerInfoObj=new FilerInfo();
			$filerInfoObj->setFilerId($filerId);
			$filerInfoObj->setIPAddress($IPaddress);
			$filerInfoObj->setMode(Input::get('mode'.$filerId));
			$FilerDetails->push($filerInfoObj);
		   Session::put('mode'.$filerId,Input::get('mode'.$filerId));
		//echo Session::get('mode'.$filerId);
		}
		Session::put('FilerDetails',serialize($FilerDetails));
		
		return \View::make('user.Test.DOT.templateChoice');
	}
	
	
	
	
	public function setTemplateChoice(){
		$template_choice=Input::get('template_choice');
		$Template_OSInfo=new Collection;
		if($template_choice=="YES"){
			
		$osList = DB::table('temp_host')->distinct()->select('os_id')->get();
	    
		foreach($osList as $os){
			$os_name=DB::table('os')->where('id',$os->os_id)->pluck('software_name');
			$osObj=new OS;
			$osObj->id=$os->os_id;
			$osObj->software_name=$os_name;
			$Template_OSInfo->push($osObj);
		}
		//var_dump($Template_OS);
		//echo Session::get('testbedId');
		return \View::make('user.Test.DOT.HostOSPlatform')->with('Template_OSInfo',$Template_OSInfo);
		}
		else if($template_choice=="NO"){
			$os=OS::all();
 		    $os_versions=OS_Versions::all();
		    $TB_hostsList= DB::table('testbed_properties')->where('testbed_id',Session::get('testbedId'))->where('resource_type','host')->select('resource_id')->get();
			$TB_hostsList_Arr = json_decode(json_encode($TB_hostsList), true);
			//var_dump($TB_hostsList_Arr);
			$TB_Hosts_Info = DB::table('node_properties')->whereIn('id',$TB_hostsList_Arr)->get();
		    
			Session::put('hosts', $TB_Hosts_Info);
			return \View::make('user.Test.DOT.StaticTestBeds.hostOptions')->with('os',$os)->with('os_versions',$os_versions);
		}
		
	}
	public function getByHostOSPlatform(){
		
		$testbed_hosts= DB::table('testbed_properties')->where('testbed_id',Session::get('testbedId'))->where('resource_type','host')->count();
		$testbed_filers= DB::table('testbed_properties')->where('testbed_id',Session::get('testbedId'))->where('resource_type','filer')->count();
	
		$HostOSPlatform=Input::get('HostOSPlatform');
		
		$jobsList= DB::table('temp_host')->where('os_id',$HostOSPlatform)->distinct()->select('job_id')->get();
		
		$jobs_matched=array(); 
	    //
		//echo "matcehd".$testbed_hosts;
		//echo "matcehd filers".$testbed_filers;
		foreach($jobsList as $job){
			$job_hosts=DB::table('temp_host')->where('job_id',$job->job_id)->count();
			$job_filers=DB::table('temp_filer')->where('job_id',$job->job_id)->count();
		
			if(($job_hosts==$testbed_hosts)&& ($job_filers==$testbed_filers) ){
				array_push($jobs_matched,$job->job_id);
			}
		}
		 $resources = DB::table('job')->whereIn('id',$jobs_matched)->get();
// 		 var_dump($resources);
         $number=DB::table('job')->whereIn('id',$jobs_matched)->count();
		
		 return \View::make('Practise.DOTTemplateSelection')->with('count',$number)->with('resources',$resources);
		 
	}
	
	public function getSelectedInfo(){
		$selected_Job=Input::get('selJob_id');
		//echo $selected_Job;
		$testbed_id=Session::get('testbedId');
		$resources = DB::table('testbed_properties')->where('testbed_id',$testbed_id)->get();
		
		
		foreach ($resources as $resource){
 			if($resource->resource_type == "host")
 			{
 				$hosts[]=$resource->resource_id;
 			}
 			else if($resource->resource_type== "filer")
 			{
 				$filers[]=$resource->resource_id;
 			}
 		}
		
		//var_dump($hosts);
		$hostsIp = DB::table('node_properties')->whereIn('id',$hosts)->select('ip','id')->get();
		$hostsInfo = DB::table('temp_host')->where('job_id',$selected_Job)->get();
		//var_dump($hostsInfo );
		$i=0;
		
		
		$HostDetails=new Collection;
		$FilerDetails=new Collection;
		
		
		foreach($hostsInfo as $host){
			$hostInfoObj=new HostInfo();
			
			$os_type = DB::table('OS')->where('id',$host->os_id)->pluck('software_name');
			$version = DB::table('OS_Versions')->where('id',$host->version_id)->pluck('version');
			$IPaddress=DB::table('node_properties')->where('id',$host->resource_id)->pluck('ip');
			
			$hostInfoObj->setHostId($hosts[$i]);
			$hostInfoObj->setOsType($os_type);
			$hostInfoObj->setOsVersion($version);
			$hostInfoObj->setIPAdress($IPaddress);
			$hostInfoObj->setArchitecture($host->architecture);
			$hostInfoObj->setProtocol($host->protocol);
			$hostInfoObj->setOs_id($host->os_id);
			$hostInfoObj->setVersion_id($host->version_id);
			
			$HostDetails->push($hostInfoObj);
			//echo $hostInfo->getHostId();
			Session::put('SANBOOT','NO');
			Session::put('DNMP','0.4.7-48.el5_8.2');
			Session::put('kernal','2.6.18-308.4.1.el5');
			
			//Session::put('os_id'.$hosts[$i],$host->os_id);
        	//Session::put('versions_id'.$hosts[$i],$host->version_id);
			//Session::put('os'.$hosts[$i],$os_type);
        	//Session::put('versions'.$hosts[$i],$version);
			
			//Session::put('protocol'.$hosts[$i],$host->protocol);
        	//Session::put('architecture'.$hosts[$i],$host->architecture);
			
			
			//echo Session::get('os_id'.$hosts[$i]);
			//echo Session::get('os'.$hosts[$i]);
			//echo Session::get('versions'.$hosts[$i]);
			//echo Session::get('protocol'.$hosts[$i]);
			//echo Session::get('architecture'.$hosts[$i]);
			
			
			//echo $hosts[$i];
			$i++;
		}
		
		
		$filersInfo = DB::table('temp_filer')->where('job_id',$selected_Job)->get();
		$j=0;
		foreach($filersInfo as $filer){
			$IPaddress=DB::table('node_properties')->where('id',$filer->resource_id)->pluck('ip');
			$filerInfoObj=new FilerInfo();
			$filerInfoObj->setFilerId($filers[$j]);
			$filerInfoObj->setIPAddress($IPaddress);
			$filerInfoObj->setMode(Session::get('mode'.$filer->resource_id));
			$FilerDetails->push($filerInfoObj);
			$j++;
			
		}
		//var_dump($FilerDetails);
		//var_dump($HostDetails);
		Session::put('HostDetails',serialize($HostDetails));
		Session::put('FilerDetails',serialize($FilerDetails));
		 return \View::make('user.Test.DOT.resourcesReview')->with('HostDetails',$HostDetails)->with('FilerDetails',$FilerDetails);
	}
	
	public function getTestcasesInfo(){
		$time = Carbon\Carbon::now();
		
		$job_id=DB::table('Job')->insertGetId(
		array('job_name' => Input::get('jobname'),'created_at'=>$time->toDateTimeString()));
		
		if(Input::get('temp_option')){
			
		$result=DB::table('Template')->insert(
		array('job_id' => $job_id,'created_at'=>$time->toDateTimeString()));
		}
		   
			
	    $HOSTsDetails=new Collection;
		$FilersDetails=new Collection;
		$HOSTsDetails=unserialize(Session::get('HostDetails'));
		$FilersDetails=unserialize(Session::get('FilerDetails'));
		//var_dump(Session::get('HostDetails'));
		//var_dump(Session::get('FilerDetails'));
		
		foreach($HOSTsDetails as $host){
			
			
			
			DB::table('Temp_Host')->insert(
			array('resource_id' => $host->hostId,'job_id'=>$job_id,'os_id'=>$host->os_id,'version_id'=>$host->version_id,
			'architecture'=>$host->architecture,'protocol'=>$host->protocol,'created_at'=>$time->toDateTimeString()));
			
			//echo Session::get('os_id'.$host->id);
			//echo Session::get('versions_id'.$host->id);
			//echo Session::get('protocol'.$host->id);
			//echo Session::get('architecture'.$host->id);
		}
		
		foreach($FilersDetails as $filer){
			
			DB::table('Temp_Filer')->insert(
		   array('resource_id' => $filer->filerId,'job_id'=>$job_id,'mode'=>$filer->mode,'created_at'=>$time->toDateTimeString()));
			
			//echo Session::get('mode'.$filer->id);
			
		}
		
			Mail::send('user.Test.mail', array('firstname'=>'kishore'), function($message) {
		$message->to('kishore5424@gmail.com', 'kishore kanduluru')->subject('[nLAB] Resources Links for Logs References and Updates!');
	
});
		return \View::make('user.Test.ConfirmationMessage');

		
		
	
	}
	public function setHostOptions(){
		//echo Session::get('testbedId');
		$hostsId = DB::table('testbed_properties')->where('testbed_id',Session::get('testbedId'))->where('resource_type','host')->select('resource_id')->get();
		$hostsIdArr=json_decode(json_encode($hostsId), true);
		//var_dump($hostsIdArr);
		$HostDetails=new Collection;
		foreach($hostsId as $hId){
			$hostInfoObj=new HostInfo();
			 $os_id=Input::get('os'.$hId->resource_id);
			 //echo Input::get('protocol'.$hId->resource_id);
			// echo Input::get('architecture'.$hId->resource_id);
			 $ver_id=Input::get('versions'.$hId->resource_id);
			 $os_type = DB::table('OS')->where('id',$os_id)->pluck('software_name');
			 $version = DB::table('OS_Versions')->where('id',$ver_id)->pluck('version');
			 $IPaddress=DB::table('node_properties')->where('id',$hId->resource_id)->pluck('ip');
			
			$hostInfoObj->setHostId($hId->resource_id);
			$hostInfoObj->setOsType($os_type);
			$hostInfoObj->setOsVersion($version);
			$hostInfoObj->setIPAdress($IPaddress);
			$hostInfoObj->setArchitecture(Input::get('architecture'.$hId->resource_id));
			$hostInfoObj->setProtocol(Input::get('protocol'.$hId->resource_id));
			$hostInfoObj->setOs_id(Input::get('os'.$hId->resource_id));
			$hostInfoObj->setVersion_id(Input::get('versions'.$hId->resource_id));
			
			$HostDetails->push($hostInfoObj);
			//echo $hostInfo->getHostId();
			Session::put('SANBOOT','NO');
			Session::put('DNMP','0.4.7-48.el5_8.2');
			Session::put('kernal','2.6.18-308.4.1.el5');
			
		}
		Session::put('HostDetails',serialize($HostDetails));
		$FilersDetails=unserialize(Session::get('FilerDetails'));
		return \View::make('user.Test.DOT.resourcesReview')->with('HostDetails',$HostDetails)->with('FilerDetails',$FilersDetails);
	}
	
}

