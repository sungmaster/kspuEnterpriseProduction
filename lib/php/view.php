<?php
// 02-MVC 20150925 (C) 2015 Mark Constable <markc@renta.net> (AGPL-3.0)

declare(strict_types = 1);

class ViewHelper {
	private $data=array();
	public function assign($key,$value){
		$this->data[$key]=$value;
	}
	public function display($htmlPage){
		extract($this->data);        
		include_once $htmlPage;
		
	}
}
?>
