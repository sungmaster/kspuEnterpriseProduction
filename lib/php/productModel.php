<?php

if (!isset($kspuEnterprise)){
	die();
}


class ProductModel
{
	
	private $db;

	public function __construct()
	{
		$this->db = new mysqli('localhost', 'phpuser', 'QDDWlc9m9B4XTJMS', 'production');
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

	public function calculateProductParam($pid){

	}


	//misc
	public function getMisc(){
		$result = $this->db->query('select * from misc');

		$gres = array();

		while ($row = $result->fetch_assoc()) {
			$gres[$row['name']] = $row['value'];
			//array_push($gres, $row);
		}
		return $gres;
	}

	public function updateMisc($data){
		$allowedKey = array('weldorSalary', 'operatorSalary', 'painterSalary', 'electrodeCost', 'electrodeSpending', 'inkCost', 'coloringDuration');
		$content = ""; $query = "";

		foreach ($data as $key => $value) {
			if (in_array($key, $allowedKey) && is_numeric($value)){
				$content.=" when name = '".$key."' then ".$value."\n";
			}
		}

		if ($content != ""){
			$query = "UPDATE misc SET value = (case".$content." end) WHERE 1";
		}
		return $this->db->query($query);
		//return $query;
	}
}