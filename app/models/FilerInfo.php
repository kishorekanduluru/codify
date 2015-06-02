<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class FilerInfo{
    
	
	public $IPAddress;
	public $mode;
	public $MAC;
	public $conatainerTB;
	public $filerId;
	
	
  public function __sleep()
    {
        return array('mode','IPAddress','MAC','conatainerTB','filerId');
    }
	public function getFilerId(){
		return $this->filerId;
	}

	public function setFilerId($filerId){
		$this->filerId = $filerId;
	}
	
	public function getMAC(){
		return $this->MAC;
	}

	public function setMAC($MAC){
		$this->MAC = $MAC;
	}
	
	public function getIPAddress(){
		return $this->IPAddress;
	}

	public function setIPAddress($IPAddress){
		$this->IPAddress = $IPAddress;
	}

	
	
	public function getMode(){
		return $this->mode;
	}

	public function setMode($mode){
		$this->mode = $mode;
	}

	public function setConatainerTB($conatainerTB){
		$this->conatainerTB = $conatainerTB;
	}
	public function getConatainerTB(){
		return $this->conatainerTB;
	}


}