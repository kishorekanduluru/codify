<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

 class HostInfo{
    
	
	public $osType;
	//protected $osVersion;
	public $model;
	public $IPAdress;
	public $conatainerTB;
	public $HBA;
	public $MAC;
	public $osVersion;
	public $architecture;
	public $protocol;
	public $hostId;
	public $os_id;
	public $version_id;
	
	
	  public function __sleep()
    {
        return array('osType', 'model', 'IPAdress','conatainerTB','HBA','MAC','osVersion','architecture','protocol','hostId','os_id','version_id');
    }
public function getHBA(){
		return $this->HBA;
	}

	public function setHBA($HBA){
		$this->HBA = $HBA;
	}
public function getMAC(){
		return $this->MAC;
	}

	public function setMAC($MAC){
		$this->MAC = $MAC;
	}
	
	
	public function getOsType(){
		return $this->osType;
	}

	public function setOsType($osType){
		$this->osType = $osType;
	}

	
	
	public function getModel(){
		return $this->model;
	}

	public function setModel($model){
		$this->model = $model;
	}
	
	public function getHostId(){
		return $this->hostId;
	}

	public function setHostId($hostId){
		$this->hostId = $hostId;
	}

	public function getIPAdress(){
		return $this->IPAdress;
	}

	public function setIPAdress($IPAdress){
		$this->IPAdress = $IPAdress;
	}

	public function setConatainerTB($conatainerTB){
		$this->conatainerTB = $conatainerTB;
	}
	public function getConatainerTB(){
		return $this->conatainerTB;
	}

	
	public function getOsVersion(){
		return $this->osVersion;
	}

	public function setOsVersion($osVersion){
		$this->osVersion = $osVersion;
	}

	public function getArchitecture(){
		return $this->architecture;
	}

	public function setArchitecture($architecture){
		$this->architecture = $architecture;
	}

	public function getProtocol(){
		return $this->protocol;
	}

	public function setProtocol($protocol){
		$this->protocol = $protocol;
	}
	public function getOs_id(){
		return $this->os_id;
	}

	public function setOs_id($os_id){
		$this->os_id = $os_id;
	}

	public function getVersion_id(){
		return $this->version_id;
	}

	public function setVersion_id($version_id){
		$this->version_id = $version_id;
	}
	
}