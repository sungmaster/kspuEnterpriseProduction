<?php
class Model {
	private $persons;

	public function __construct() {
		$this->persons[] = array("name" => "Kate Austin", "adress" => "1234 Walnut street", "city" => "New York");
		$this->persons[] = array("name" => "Lisa Stans", "adress" => "1234 Cracker street", "city" => "Boston");
		$this->persons[] = array("name" => "Dustin Bust", "adress" => "2232 Mullberry street", "city" => "New York");
		$this->persons[] = array("name" => "Nelson Amber", "adress" => "1234 Cracker street", "city" => "Boston");
		$this->persons[] = array("name" => "Par Eriksson", "adress" => "Vagen 1A", "city" => "Borlange");
	}

	public function getAllPersons() {
		return $this->persons;
	}

	public function getPersonByName($personName) {
		$key = array_search($personName, array_column($this->persons, 'name'));
		return $this->persons[$key];
	}

	public function getPersonsByCity($cityName) {
		$keys = array_keys(array_column($this->persons, 'city'), $cityName);
		$cityarray = array();
		foreach ($keys as $value) {
			$cityarray[] = $this->persons[$value];
		}
		return $cityarray;
	}

	public function addPerson($name, $adress, $city) {
		$this->persons[] = array("name" => $name, "adress" => $adress, "city" => $city);
	}
}
?>