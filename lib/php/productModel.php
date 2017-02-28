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
	public function __destruct(){
		$this->db->close();
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

	public function updateDetailCategoryList($data){
		if ($data['dcid']==-1){
			$this->db->query('INSERT INTO `detail_cat`(`dcname`) VALUES ("'.$this->db->real_escape_string($data['dcname']).'")');
			return $this->db->insert_id;
		}
		else{
			$this->db->query( 'UPDATE `detail_cat` SET `dcname`="'.$this->db->real_escape_string($data['dcname']).'" WHERE `dcid`='.intval($data['dcid']) );
			return 0;
		}
	}

	public function updateProductCategoryList($data){
		if ($data['gcid']==-1){
			$this->db->query('INSERT INTO `grid_cat`(`gcname`) VALUES ("'.$this->db->real_escape_string($data['gcname']).'")');
			return $this->db->insert_id;
		}
		else{
			$this->db->query( 'UPDATE `grid_cat` SET `gcname`="'.$this->db->real_escape_string($data['gcname']).'" WHERE `gcid`='.intval($data['gcid']) );
			return 0;
		}
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
			$res = $this->db->query($query);
			$this->recalculateAllProductParam();
			return $res;
		}
		else{
			return 0;
		} 
		//return $query;
	}

	//materials
	public function getAllMaterial($assoc = false){
		$result = $this->db->query('select * from material where mid > 0');

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
		$result = $this->db->query('select mid, mname, marticul from material where mid > 0');

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
		if ($data['mid']==-1){
			$this->db->query('INSERT INTO `material`(`mname`, `marticul`, `price`, `inkconsumption`) VALUES ("'.$this->db->real_escape_string($data['mname']).'", "'.$this->db->real_escape_string($data['marticul']).'", '.floatval($data['price']).', '.floatval($data['inkconsumption']).')');
			return $this->db->insert_id;
		}
		else{
			$this->db->query( 'UPDATE `material` SET `mname`="'.$this->db->real_escape_string($data['mname']).'",`marticul`="'.$this->db->real_escape_string($data['marticul']).'",`price`='.floatval($data['price']).',`inkconsumption`='.floatval($data['inkconsumption']).' WHERE `mid`='.intval($data['mid']) );
			$this->recalculateAllProductParam();
			return 0;
		}
	}

	//details
	public function getAllDetail($assoc = false){
		$result = $this->db->query('select * from detail where did > 0');

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
		$result = $this->db->query('select did, darticul, dname, dcatalog from detail where did > 0');

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
		if ($data['did']==-1){
			$this->db->query('INSERT INTO `detail`(`dlength`, `material`, `dtime`, `amortization`, `spending`, `darticul`, `dname`, `dcatalog`) VALUES ('.floatval($data['dlength']).','.intval($data['material']).','.intval($data['dtime']).','.floatval($data['amortization']).','.floatval($data['spending']).',"'.$this->db->real_escape_string($data['darticul']).'","'.$this->db->real_escape_string($data['dname']).'",'.intval($data['dcatalog']).')');
			return $this->db->insert_id;
		}
		else{
			$this->db->query( 'UPDATE `detail` SET `dlength`='.floatval($data['dlength']).',`material`='.intval($data['material']).',`dtime`='.intval($data['dtime']).',`amortization`='.floatval($data['amortization']).',`spending`='.floatval($data['spending']).',`darticul`="'.$this->db->real_escape_string($data['darticul']).'",`dname`="'.$this->db->real_escape_string($data['dname']).'",`dcatalog`='.intval($data['dcatalog']).' WHERE `did`='.intval($data['did']) );
			$this->recalculateAllProductParam();
			return 0;
		}
	}


	//production
	public function getAllProduct($assoc = false){
		$result = $this->db->query('select gid, details, gpoints, gamortization from grid where gid > 0');

		$gres = array();

		if ($assoc){
			while ($row = $result->fetch_assoc()) { $gres[$row['gid']] = $row; }
		}
		else{
			while ($row = $result->fetch_assoc()) { $gres[] = $row; }
		}
		return $gres;
	}

	public function getAllProductFull($assoc = false){
		$result = $this->db->query('select * from grid where gid > 0');

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
		$result = $this->db->query('select gid, width, height, garticul, gname, price, time, gcatalog from grid where gid > 0');

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
		if ($data['gid']==-1){
			$this->db->query('INSERT INTO `grid`(`details`, `width`, `height`, `garticul`, `gname`, `gpoints`, `gamortization`, `gcatalog`) VALUES ("'.$this->db->real_escape_string($data['details']).'",'.intval($data['width']).','.intval($data['height']).',"'.$this->db->real_escape_string($data['garticul']).'","'.$this->db->real_escape_string($data['gname']).'",'.intval($data['gpoints']).','.floatval($data['gamortization']).','.intval($data['gcatalog']).')');
			$this->calculateProductParam($this->db->insert_id);
			return $this->db->insert_id;
		}
		else{
			$this->db->query( 'UPDATE `grid` SET `details`="'.$this->db->real_escape_string($data['details']).'",`width`='.intval($data['width']).',`height`='.intval($data['height']).',`garticul`="'.$this->db->real_escape_string($data['garticul']).'",`gname`="'.$this->db->real_escape_string($data['gname']).'",`gpoints`='.intval($data['gpoints']).',`gamortization`='.floatval($data['gamortization']).',`gcatalog`='.intval($data['gcatalog']).' WHERE `gid`='.intval($data['gid']) );
			$this->calculateProductParam(intval($data['gid']));
			return 0;
		}
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