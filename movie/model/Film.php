<?php

class Film {

	public $id=0;
	public $naziv="";
	public $trajanje=0;
	public $reditelj="";
	public $glumci="";
	public $zanr="";
	public $opis="";

	private $connection;

	public function __construct($param) {
	    $this->connection = $param;
	}

	private function toObjectArray($result)
	{
		$artikli = array();

		while($row = $result->fetch_assoc()) {

			$artikl = new Film;
			$artikl->id = $row['id'];
			$artikl->naziv= $row['naziv'];
			$artikl->trajanje = $row['trajanje'];
			$artikl->reditelj = $row['reditelj'];
			$artikl->glumci = $row['glumci'];
			$artikl->zanr = $row['zanr'];
			$artikl->opis = $row['opis'];

			array_push($artikli, $artikl);
    	}

    	return $artikli;
	}

	public function getAll()
	{
		$result = $this->connection
			->query('SELECT * FROM film');

		$gradovi = array();

		while($row = $result->fetch_assoc()) {

			$grad = new Film;
			$grad->id = $row['id'];
			$grad->naziv = $row['naziv'];
			$grad->trajanje = $row['trajanje'];
			$grad->reditelj = $row['reditelj'];
			$grad->glumci = $row['glumci'];
			$grad->zanr = $row['zanr'];
			$grad->zanr = $row['opis'];

			array_push($gradovi, $grad);
    	}

    	return $gradovi;
	}
	public static function findById($connection, $id)
	{
		$result = $connection->query(
			"SELECT * FROM film WHERE id = $id");

		$tip = new Film;

		if($row = $result->fetch_assoc()) {

			$tip->id = $row['id'];
			$tip->naziv = $row['naziv'];
			$tip->trajanje = $row['trajanje'];
			$tip->reditelj = $row['reditelj'];
			$tip->glumci = $row['glumci'];
			$tip->zanr = $row['zanr'];
			$tip->opis = $row['opis'];
		
    	}

    	return $tip;
	}

	public function find($naziv)
	{
		$result = $this->connection->query(
			"SELECT * FROM film WHERE naziv LIKE '%$naziv%'");

		return $this->toObjectArray($result);
	}

	public function create()
	{
		$result = $this->connection->query("INSERT INTO film (naziv, trajanje, reditelj, glumci, zanr, opis) 
			VALUES ('$this->naziv', '$this->trajanje', '$this->reditelj', '$this->glumci','$this->zanr', '$this->opis')");
		
		if ($result > 0) return true; else return false;
	}







}


?>