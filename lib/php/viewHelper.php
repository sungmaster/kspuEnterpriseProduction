<?php

//declare(strict_types = 1);
header('Content-Type: text/html; charset= utf-8');

if (!isset($kspuEnterprise)){
	die();
}

class ViewHelper {
	private $data=array();
	public function assign($key,$value){
		$this->data[$key]=$value;
	}
	public function display($htmlPage){
		extract($this->data);        
		include_once ($htmlPage);
		
	}
}

