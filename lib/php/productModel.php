<?php

if (!isset($kspuEnterprise)){
	die();
}


class ProductModel
{
	
	private $mysqli;

	public function __construct()
	{
		$this->$mysqli = new mysqli('localhost', 'phpuser', 'QDDWlc9m9B4XTJMS', 'production');
	}

	//materials
	public function getMaterialList(){

	}

	public function getMaterial($mid){

	}

	public function updateMaterial($data){

	}

	//details
	public function getDetailList(){

	}

	public function getDetail($did){

	}

	public function updateDetail($data){
		
	}


	//production
	public function getProductList(){

	}

	public function getProduct($pid){

	}

	public function updateProduct($data){
		
	}

	public function calculateProductPrice($pid){

	}

	public function calculateProductTime($pid){

	}

	//misc
	public function getMisc(){

	}

	public function updateMisc($data){
		
	}
}