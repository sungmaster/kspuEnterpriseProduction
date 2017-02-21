<?php

declare(strict_types = 1);

if (!isset($kspuEnterprise)){
	echo "controller";
	die();
}


class Controller {

	//put your code here
	private $viewHelper;
	private $model;

	public function handle() {
		//$this=new Program2_1_PageController();
		$this->model = new Model();
		$this->viewHelper = new ViewHelper();
		//alway set this data
		$this->viewHelper->assign("persons", $this->model->getAllPersons());
		if (isset($_SERVER['PATH_INFO'])) {
			//index.php/PageController/getPersonByName/Austin
			$pathinfo = explode("/", $_SERVER['PATH_INFO']);

			switch ($pathinfo[2]) {//$arr[2]=getPersonByName
				case "getPersonByName";
					//$arr[3]="Dustin"
					$this->getPersonByName(urldecode(trim($pathinfo[3])));
					break;
				case "getPersonsByCity":
					//$arr[3]="New York"
					$this->getPersonsByCity(urldecode(trim($pathinfo[3]))); //getPersonsByCity("New York");
					break;
				default:
					$this->viewHelper->display("./lib/php/pages/employees.php");
			}//end case
		}//end if
		else {
			
			$this->viewHelper->display("./lib/php/pages/employees.php");
		}
	}

//end handle

	public function getPersonByName($name) {

		$this->viewHelper->assign("person", $this->model->getPersonByName($name));
		$this->viewHelper->display("./lib/php/pages/employees.php");
	}

	public function getPersonsByCity($city) {

		$this->viewHelper->assign("personsInCities", $this->model->getPersonsByCity($city));
		$this->viewHelper->display("./lib/php/pages/employees.php");
	}

}
