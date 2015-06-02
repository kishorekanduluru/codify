<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

 class TaskInfo{
    
	
	public $id;
	public $job_name;
	public $createdAt;
	public $status;
	public $template_Info;
	public $hosts_num;
	public $filers_num;
	public $logs_id;
	
	
	
	
	  public function __sleep()
    {
        return array('id', 'job_name', 'createdAt','conatainerTB','status','template_Info','hosts_num','filers_num','logs_id');
    }
	
	
		public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getJob_name(){
		return $this->job_name;
	}

	public function setJob_name($job_name){
		$this->job_name = $job_name;
	}

	public function getCreatedAt(){
		return $this->createdAt;
	}

	public function setCreatedAt($createdAt){
		$this->createdAt = $createdAt;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	public function getTemplate_Info(){
		return $this->template_Info;
	}

	public function setTemplate_Info($template_Info){
		$this->template_Info = $template_Info;
	}

	public function getHosts_num(){
		return $this->hosts_num;
	}

	public function setHosts_num($hosts_num){
		$this->hosts_num = $hosts_num;
	}

	public function getFilers_num(){
		return $this->filers_num;
	}

	public function setFilers_num($filers_num){
		$this->filers_num = $filers_num;
	}

	public function getLogs_id(){
		return $this->logs_id;
	}

	public function setLogs_id($logs_id){
		$this->logs_id = $logs_id;
	}

	
}