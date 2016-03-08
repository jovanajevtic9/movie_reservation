<?php

class Grad {

	public $id=0;
	public $naziv="";

	private $connection;

	public function __construct($param) {
	    $this->connection = $param;
	}

	public function getAll()
	{
		$result = $this->connection
			->query('SELECT * FROM grad');

		$gradovi = array();

		while($row = $result->fetch_assoc()) {

			$grad = new Grad;
			$grad->id = $row['id'];
			$grad->naziv = $row['naziv'];
			

			array_push($gradovi, $grad);
    	}

    	return $gradovi;
	}

	public static function findById($connection, $id)
	{
		$result = $connection->query(
			"SELECT * FROM grad WHERE id = $id");

		$tip = new Grad;

		if($row = $result->fetch_assoc()) {

			$tip->id = $row['id'];
			$tip->naziv = $row['naziv'];
			
		
    	}

    	return $tip;
	}





}


?>