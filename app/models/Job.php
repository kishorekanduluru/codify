<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Job extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = "job";
	protected $no_Filers;
	protected $no_Hosts;
	protected $no_Switches;

	protected $fillable=['jobname'];
	
	
	 public function __sleep()
    {
        return array('no_Filers','no_Hosts','no_Switches');
    }
	public function getNo_Filers(){
		return $this->no_Filers;
	}

	public function setNo_Filers($no_Filers){
		$this->no_Filers = $no_Filers;
	}

	public function getNo_Hosts(){
		return $this->no_Hosts;
	}

	public function setNo_Hosts($no_Hosts){
		$this->no_Hosts = $no_Hosts;
	}

	public function getNo_Switches(){
		return $this->no_Switches;
	}

	public function setNo_Switches($no_Switches){
		$this->no_Switches = $no_Switches;
	}

}