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
		$this->db->set_charset("utf8");
	}

	//category
	public function getDetailCategoryList($assoc = false){
		$result = $this->db->query('select * from detail_cat');

		$gres = array();

		if ($assoc){
			while ($row = $result->fetch_assoc()) { $gres[$row['dcid']] = $row; }
		}
		else{
			while ($row = $result->fetch_assoc()) { $gres[] = $row; }
		}
		return $gres;
	}

	public function getProductCategoryList($assoc = false){
		$result = $this->db->query('select * from grid_cat');

		$gres = array();

		if ($assoc){
			while ($row = $result->fetch_assoc()) { $gres[$row['gcid']] = $row; }
		}
		else{
			while ($row = $result->fetch_assoc()) { $gres[] = $row; }
		}
		return $gres;
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
		$allowedKey = array('weldorSalary', 'operatorSalary', 'painterSalary', 'electrodeCost', 'electrodeSpending', 'inkCost', 'coloringDuration', 'weldTime');
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

	//materials
	public function getAllMaterial($assoc = false){
		$result = $this->db->query('select * from material');

		$gres = array();

		if ($assoc){
			while ($row = $result->fetch_assoc()) { $gres[$row['mid']] = $row; }
		}
		else{
			while ($row = $result->fetch_assoc()) { $gres[] = $row; }
		}
		return $gres;
	}

	public function getMaterialList($assoc = false){
		$result = $this->db->query('select mid, mname, marticul from material');

		$gres = array();

		if ($assoc){
			while ($row = $result->fetch_assoc()) { $gres[$row['mid']] = $row; }
		}
		else{
			while ($row = $result->fetch_assoc()) { $gres[] = $row; }
		}
		return $gres;
	}

	public function getMaterial($mid){
		$result = $this->db->query('select * from material where mid = '.intval($mid));
		return $result->fetch_assoc();
	}

	public function updateMaterial($data){

	}

	//details
	public function getAllDetail($assoc = false){
		$result = $this->db->query('select * from detail');

		$gres = array();

		if ($assoc){
			while ($row = $result->fetch_assoc()) { $gres[$row['did']] = $row; }
		}
		else{
			while ($row = $result->fetch_assoc()) { $gres[] = $row; }
		}
		return $gres;
	}

	public function getDetailList($assoc = false){
		$result = $this->db->query('select did, darticul, dname, dcatalog from detail');

		$gres = array();

		if ($assoc){
			while ($row = $result->fetch_assoc()) { $gres[$row['did']] = $row; }
		}
		else{
			while ($row = $result->fetch_assoc()) { $gres[] = $row; }
		}
		return $gres;
	}

	public function getDetail($did){
		$result = $this->db->query('select * from detail where did = '.intval($did));
		return $result->fetch_assoc();
	}

	public function updateDetail($data){
		
	}


	//production
	public function getAllProduct($assoc = false){
		$result = $this->db->query('select gid, details, gpoints, gamortization from grid where 1');

		$gres = array();

		if ($assoc){
			while ($row = $result->fetch_assoc()) { $gres[$row['gid']] = $row; }
		}
		else{
			while ($row = $result->fetch_assoc()) { $gres[] = $row; }
		}
		return $gres;
	}

	public function getProductList($assoc = false){
		$result = $this->db->query('select gid, garticul, gname, price, time, gcatalog from grid');

		$gres = array();

		if ($assoc){
			while ($row = $result->fetch_assoc()) { $gres[$row['gid']] = $row; }
		}
		else{
			while ($row = $result->fetch_assoc()) { $gres[] = $row; }
		}
		return $gres;
	}

	public function getProduct($pid){
		$result = $this->db->query('select * from grid where gid = '.intval($pid));
		return $result->fetch_assoc();
	}

	public function updateProduct($data){
		
	}

	public function calculateProductParam($pid){
		$productParam = array('time' => 0, 'price' => 0 );

		$misc = $this->getMisc();
		$dList = $this->getAllDetail(true);
		$mList = $this->getAllMaterial(true);

		$productInfo = $this->getProduct($pid);
		$details = explode(',', $productInfo['details']);

		$detailInfo = array();

		foreach ($details as $value) {
			if (!array_key_exists($value, $detailInfo)){
				$time = $dList[$value]['dtime'] + $dList[$value]['dlength']*$misc['coloringDuration'];
				$cost = $dList[$value]['dtime']*$misc['operatorSalary']/60 + $dList[$value]['dlength']*($misc['inkCost']*$mList[$dList[$value]['material']]['inkconsumption'] + $mList[$dList[$value]['material']]['price'] + $misc['coloringDuration']*$misc['painterSalary']/60) + $dList[$value]['amortization'] + $dList[$value]['spending']; 
				$detailInfo[$value] = array('time' => $time, 'cost' => $cost);
			}
			$productParam['time'] += $detailInfo[$value]['time'];
			$productParam['price'] += $detailInfo[$value]['cost'];
		}

		$productParam['time'] += $productInfo['gpoints']*$misc['weldTime'];
		$productParam['price'] += $productInfo['gpoints']*($misc['weldTime']*$misc['weldorSalary']/60 + $misc['electrodeCost']/$misc['electrodeSpending']) + $productInfo['gamortization'];

		$this->db->query('update grid set price = '.$productParam['price'].', time = '.$productParam['time'].' where gid = '.$pid);

		return $productParam;
	}

	public function recalculateAllProductParam(){
		$productParam = array('time' => 0, 'price' => 0 );

		$misc = $this->getMisc();
		$dList = $this->getAllDetail(true);
		$mList = $this->getAllMaterial(true);
		$pList = $this->getAllProduct(true);

		$detailInfo = array();

		foreach ($pList as $pid => $productInfo) {
			$productParam['time'] = 0; $productParam['price'] = 0;

			$details = explode(',', $productInfo['details']);

			foreach ($details as $value) {
				if (!array_key_exists($value, $detailInfo)){
					$time = $dList[$value]['dtime'] + $dList[$value]['dlength']*$misc['coloringDuration'];
					$cost = $dList[$value]['dtime']*$misc['operatorSalary']/60 + $dList[$value]['dlength']*($misc['inkCost']*$mList[$dList[$value]['material']]['inkconsumption'] + $mList[$dList[$value]['material']]['price'] + $misc['coloringDuration']*$misc['painterSalary']/60) + $dList[$value]['amortization'] + $dList[$value]['spending']; 
					$detailInfo[$value] = array('time' => $time, 'cost' => $cost);
				}
				$productParam['time'] += $detailInfo[$value]['time'];
				$productParam['price'] += $detailInfo[$value]['cost'];
			}

			$productParam['time'] += $productInfo['gpoints']*$misc['weldTime'];
			$productParam['price'] += $productInfo['gpoints']*($misc['weldTime']*$misc['weldorSalary']/60 + $misc['electrodeCost']/$misc['electrodeSpending']) + $productInfo['gamortization'];

			$this->db->query('update grid set price = '.$productParam['price'].', time = '.$productParam['time'].' where gid = '.$pid);
			
		}
	}

}