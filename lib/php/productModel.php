<?php

if (!isset($kspuEnterprise)){
	die();
}


class ProductModel
{
	
	private $db;

	public function __construct()
	{
		if (strpos(__DIR__, "alamote"))
			$this->db = new mysqli('localhost', 'root', '', 'production');
		else
			$this->db = new mysqli('localhost', 'phpuser', 'QDDWlc9m9B4XTJMS', 'production');
		$this->db->set_charset("utf8");
	}
	public function __destruct(){
		$this->db->close();
	}

	//category
	public function getDetailCategoryList($assoc = false){
		$result = $this->db->query('select * from detail_cat') or die($this->db->error);

		$gres = array();

		if ($assoc){
			while ($row = $result->fetch_assoc()) { $gres[$row['dcid']] = $row; }
		}
		else{
			while ($row = $result->fetch_assoc()) { $gres[] = $row; }
		}
		return $gres;
	}
	public function getDetailModelList($assoc = false){
		$result = $this->db->query('select * from detail_mod') or die($this->db->error);

		$gres = array();

		if ($assoc){
			while ($row = $result->fetch_assoc()) { $gres[$row['dmid']] = $row; }
		}
		else{
			while ($row = $result->fetch_assoc()) { $gres[] = $row; }
		}
		return $gres;
	}
    public function getSimpleDetails($assoc = false){
        $result = $this->db->query('select * from grid where details_count = 1') or die($this->db->error);

        $gres = array();

        if ($assoc){
            while ($row = $result->fetch_assoc()) { $gres[$row['gid']] = $row; }
        }
        else{
            while ($row = $result->fetch_assoc()) { $gres[] = $row; }
        }
        return $gres;
    }
    public function getComplexProducts($assoc = false){
        $result = $this->db->query('select * from grid where details_count > 1') or die($this->db->error);

        $gres = array();

        if ($assoc){
            while ($row = $result->fetch_assoc()) { $gres[$row['gid']] = $row; }
        }
        else{
            while ($row = $result->fetch_assoc()) { $gres[] = $row; }
        }
        return $gres;
    }
    public function getModel($cat, $assoc = false){

        $result = $this->db->query('select dmid, dmname from detail_mod where dcatalog = '.$cat) or die($this->db->error);

        $gres = array();

        if ($assoc){
            while ($row = $result->fetch_assoc()) { $gres[$row['dmid']] = $row; }
        }
        else{
            while ($row = $result->fetch_assoc()) { $gres[] = $row; }
        }
        return $gres;
    }
	public function getProductCategoryList($assoc = false){
		$result = $this->db->query('select * from grid_cat') or die($this->db->error);

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
			$this->db->query('INSERT INTO `detail_cat`(`dcname`) VALUES ("'.$this->db->real_escape_string($data['dcname']).
                '")') or die($this->db->error);
			return $this->db->insert_id;
		}
		else{
			$this->db->query( 'UPDATE `detail_cat` SET `dcname`="'.$this->db->real_escape_string($data['dcname']).
                '" WHERE `dcid`='.intval($data['dcid']) ) or die($this->db->error);
			return 0;
		}
	}
	public function updateDetailModelList($data){
		if ($data['dmid']==-1){
			$this->db->query('INSERT INTO `detail_mod`(`time2m`, `btime`, `amortization2m`, `spending`, `dmarticul`, 
                `dmname`, `dcatalog`, `base64img`) VALUES ('.floatval($data['time2m']).', '.floatval($data['btime']).', '.
                floatval($data['amortization2m']).', '.floatval($data['spending']).', "'.
                $this->db->real_escape_string($data['dmarticul']).'", "'.$this->db->real_escape_string($data['dmname']).
                '", '.intval($data['dcatalog']).', "' . $data["base64img"] . '")') or die($this->db->error);
			return $this->db->insert_id;
		}
		else{
			$this->db->query('UPDATE `detail_mod` SET `time2m`='.floatval($data['time2m']).',`btime`='.floatval($data['btime']).
                ',`amortization2m`='.floatval($data['amortization2m']).',`spending`='.floatval($data['spending']).
                ',`dmarticul`="'.$this->db->real_escape_string($data['dmarticul']).'",`dmname`="'.
                $this->db->real_escape_string($data['dmname']).'",`dcatalog`='.intval($data['dcatalog']).', base64img = "'
                . $data["base64img"] . '" WHERE `dmid` ='.intval($data['dmid']) ) or die($this->db->error);

			return 0;
		}
	}
	public function updateProductCategoryList($data){
		if ($data['gcid']==-1){
			$this->db->query('INSERT INTO `grid_cat`(`gcname`) VALUES ("'.$this->db->real_escape_string($data['gcname']).
                '")') or die($this->db->error);
			return $this->db->insert_id;
		}
		else{
			$this->db->query( 'UPDATE `grid_cat` SET `gcname`="'.$this->db->real_escape_string($data['gcname']).
                '" WHERE `gcid`='.intval($data['gcid']) ) or die($this->db->error);
			return 0;
		}
	}

	//misc
	public function getMisc($assoc = false){
		$result = $this->db->query('select * from misc') or die($this->db->error);

		$gres = array();

		while ($row = $result->fetch_assoc()) {
		    if ($assoc)
			    $gres[$row['name']] = $row['value'];
		    else
			    array_push($gres, $row);
		}
		return $gres;
	}
	public function updateMisc($data){
		$allowedKey = array('weldorSalary', 'operatorSalary', 'painterSalary', 'electrodeCost',
            'electrodeSpending', 'inkCost', 'primerCost', 'coloringDuration', 'weldTime');
		$content = ""; $query = "";

		foreach ($data as $key => $value) {
			if (in_array($key, $allowedKey) && is_numeric($value)){
				$content.=" when name = '".$key."' then ".$value."\n";
			}
		}

		if ($content != ""){
			$query = "UPDATE misc SET value = (case".$content." end) WHERE 1";
			$res = $this->db->query($query) or die($this->db->error);
			//$this->recalculateAllProductParam();
			return $res;
		}
		else{
			return 0;
		} 
		//return $query;
	}

	//materials
	public function getAllMaterial($assoc = false){
		$result = $this->db->query('select * from material') or die($this->db->error);

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
		$result = $this->db->query('select mid, mname, marticul from material') or die($this->db->error);

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
		    $query = 'INSERT INTO `material`(`mname`, `marticul`, `price`, `inkconsumption`, `base64img`) VALUES ("'.
                $this->db->real_escape_string($data['mname']).'", "'.$this->db->real_escape_string($data['marticul']).
                '", '.floatval($data['price']).', '.floatval($data['inkconsumption']).', "' . $data["base64img"] . '")';
			echo $query."<br>";
		    $this->db->query($query) or die($this->db->error);
			return $this->db->insert_id;
		}
		else{
            $query = 'UPDATE `material` SET `mname`="'.$this->db->real_escape_string($data['mname']).
                '",`marticul`="'.$this->db->real_escape_string($data['marticul']).'",`price`='.
                floatval($data['price']).',`inkconsumption`='.floatval($data['inkconsumption']).
                ', base64img = "' . $data["base64img"] . '" WHERE `mid`='.intval($data['mid']);
			$this->db->query($query) or die($this->db->error);
			return 0;
		}
	}

	//details
	public function getAllDetail($assoc = false){
		$result = $this->db->query('select detail.*, mname, dmname from detail 
            INNER JOIN material ON material.mid = detail.material INNER JOIN detail_mod ON dmid = dmodel') or die($this->db->error);

		$gres = array();

		if ($assoc){
			while ($row = $result->fetch_assoc()) { $gres[$row['did']] = $row; }
		}
		else{
			while ($row = $result->fetch_assoc()) { $gres[] = $row; }
		}
		return $gres;
	}
	public function getDetailList($model, $assoc = false){
		$result = $this->db->query('select material.mname, detail.dlength, detail.count from detail, material 
                      WHERE detail.material = material.mid and dmodel = '.intval($model)) or die($this->db->error);

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
		$result = $this->db->query('select * from detail where did = '.intval($did)) or die($this->db->error);
		return array($result->fetch_assoc());
	}
	public function updateDetail($data){
		if ($data['did']==-1){
			$this->db->query('INSERT INTO `detail`(`dlength`, `material`, `darticul`, `dmodel`, `count`) VALUES ('.
                floatval($data['dlength']).','.intval($data['material']).',"'.
                $this->db->real_escape_string($data['darticul']).'",'.intval($data['dmodel']).','.
                intval($data['count']).')') or die($this->db->error);
			return $this->db->insert_id;
		}
		else{
			$this->db->query( 'UPDATE `detail` SET `dlength`='.floatval($data['dlength']).
                ',`material`='.intval($data['material']).',`darticul`="'.$this->db->real_escape_string($data['darticul']).
                '",`dmodel`='.intval($data['dmodel']).',`count`='.intval($data['count']).' WHERE `did`='.
                intval($data['did']) ) or die($this->db->error);
			
			return 0;
		}
	}
	public function updateDetailCount($data){
		$this->db->query('UPDATE `detail` SET `count`='.intval($data['count']).
            ' WHERE `did`='.intval($data['did'])) or die($this->db->error);
	}


	//production
	public function getAllProduct($assoc = false){
		$result = $this->db->query('select gid, details, gpoints, gamortization from grid')
            or die($this->db->error);

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
		$result = $this->db->query('select * from grid where gid > 0') or die($this->db->error);

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
		$result = $this->db->query('select gid, width, height, garticul, gname, price, time, gcatalog from grid where gid > 0')
            or die($this->db->error);

		$gres = array();

		if ($assoc){
			while ($row = $result->fetch_assoc()) { $gres[$row['gid']] = $row; }
		}
		else{
			while ($row = $result->fetch_assoc()) { $gres[] = $row; }
		}
		return $gres;
	}
	public function getProduct($pid, $type = ""){
	    if ($type == "simple")
            $result = $this->db->query('select * from detail_mod where dmid = '.intval($pid)) or die($this->db->error);
        else
	        $result = $this->db->query('select * from grid where gid = '.intval($pid)) or die($this->db->error);
		return $result->fetch_assoc();
	}
	public function updateProduct($data){
		if ($data['gid']==-1){
		    $query = "INSERT INTO `grid`(details_count, details, width, height, garticul, gname, gpoints,
            gamortization, gcatalog, base64img) VALUES (".$data["details_count"].", '".
                $this->db->real_escape_string($data['details']).
                '\','.intval($data['width']).','.intval($data['height']).',"'.
                $this->db->real_escape_string($data['garticul']).'","'.$this->db->real_escape_string($data['gname']).
                '",'.intval($data['gpoints']).','.floatval($data['gamortization']).','.intval($data['gcatalog']).', "'.
                $data["base64img"].'")';
		    echo $query;
			$this->db->query($query) or die($this->db->error);
			//$this->calculateProductParam($this->db->insert_id);
			return $this->db->insert_id;
		}
		else{
			$this->db->query( 'UPDATE `grid` SET `details`="'.$this->db->real_escape_string($data['details']).
                '",`width`='.intval($data['width']).',`height`='.intval($data['height']).',`garticul`="'.
                $this->db->real_escape_string($data['garticul']).'",`gname`="'.
                $this->db->real_escape_string($data['gname']).'",`gpoints`='.intval($data['gpoints']).
                ',`gamortization`='.floatval($data['gamortization']).',`gcatalog`='.intval($data['gcatalog']).
                ' WHERE `gid`='.intval($data['gid']) ) or die($this->db->error);
			//$this->calculateProductParam(intval($data['gid']));
			return 0;
		}
	}
	public function calculateProductParam($pid, $mid, $coloring = false, $count = 1){
		$productParam = array('time' => 0, 'price' => 0);

		$misc = $this->getMisc(true);
		$dList = $this->getAllDetail(true);
		$modelList = $this->getDetailModelList(true);
		$material = $this->getMaterial($mid);

		$productInfo = $this->getProduct($pid);
		$details = json_decode($productInfo['details']);

		$detailInfo = array();

		$totalInk = 0;

		foreach ($details as $value) {
			$dModel = $value[0];
			$dLenght = $value[1];
			$dCount = $value[2] * $count;
			$readyCount = 0;

			$rtime = $modelList[$dModel]['btime'] + ($modelList[$dModel]['time2m'] + $misc['coloringDuration'])*$dLenght;
			foreach ($dList as $key => $det) {
			    /*print_r($det);*/
				if ($det['dmodel'] == $mid && $det['dlength'] == $dLenght){
					$readyCount = $det['count'];
					break;
				}
			}
			if ($readyCount >= $dCount){$time = 0;}
			else{
				$time = $rtime * ($dCount - $readyCount);
			}

			$cost = ($modelList[$dModel]['btime'] + $modelList[$dModel]['time2m']*$dLenght)*$misc['operatorSalary']/60 + $dLenght*($misc['primerCost']*$material['inkconsumption'] + $material['price']  + $modelList[$dModel]['amortization2m'] + $misc['coloringDuration']*$misc['painterSalary']/60 ) + $modelList[$dModel]['spending'];
			$cost *= $dCount;
			if ($coloring){$totalInk += $dLenght * $dCount;}

			$productParam['time'] += $time;
			$productParam['price'] += $cost;
		}

		$productParam['time'] += $productInfo['gpoints']*$misc['weldTime']*$count;
		$productParam['price'] += $productInfo['gpoints']*$count*($misc['weldTime']*$misc['weldorSalary']/60 + $misc['electrodeCost']/$misc['electrodeSpending']) + $productInfo['gamortization']*$count;
		if ($coloring){
			$productParam['time'] += $totalInk*$misc['coloringDuration']*$count;
			$productParam['price'] += $totalInk*$count*($misc['inkCost']*$material['inkconsumption'] + $misc['coloringDuration']*$misc['painterSalary']/60 );
		}

		return $productParam;
	}


}
