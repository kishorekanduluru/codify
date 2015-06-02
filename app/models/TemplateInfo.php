<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class TemplateInfo{
    
	
	public$no_Filers;
	public $no_Hosts;
	public $template_name;
	public $owner;
	public $time;
  public function __sleep()
    {
        return array('no_Filers','no_Hosts','template_name','owner','time');
    }
	public function getTemplate_name(){
		return $this->template_name;
	}

	public function setTemplate_name($template_name){
		$this->template_name = $template_name;
	}

	public function getNo_Hosts(){
		return $this->no_Hosts;
	}

	public function setNo_Hosts($no_Hosts){
		$this->no_Hosts = $no_Hosts;
	}
public function getNo_Filers(){
		return $this->no_Filers;
	}

	public function setNo_Filers($no_Filers){
		$this->no_Filers = $no_Filers;
	}

	public function getOwner(){
		return $this->owner;
	}

	public function setOwner($owner){
		$this->owner = $owner;
	}
	public function getTime(){
		return $this->time;
	}

	public function setTime($time){
		$this->time = $time;
	}


}