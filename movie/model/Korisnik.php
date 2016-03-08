<?php 

class Korisnik {

	public $id=0;
	public $ime="";
	public $prezime="";
	public $email="";
	public $password="";
	

	private $connection;

	public function __construct($param) {
	    $this->connection = $param;
	}

	private function toObjectArray($result)
	{
		$korisnici = array();

		while($row = $result->fetch_assoc()) {

			$korisnik = new Korisnik;
			$korisnik->id = $row['id'];
			$korisnik->ime = $row['ime'];
			$korisnik->prezime = $row['prezime'];
			$korisnik->email = $row['email'];
			$korisnik->password= $row['password'];

			array_push($korisnici, $korisnik);
    	}

    	return $korisnici;
	}

	public static function findById($connection, $id)
	{
		$result = $connection->query(
			"SELECT * FROM korisnik WHERE id = $id");

		$korisnik = new Korisnik;

		if($row = $result->fetch_assoc()) {

			
			$korisnik->id = $row['id'];
			$korisnik->ime = $row['ime'];
			$korisnik->prezime = $row['prezime'];
			$korisnik->email = $row['email'];
			$korisnik->password= $row['password'];
		
    	}

    	return $korisnik;
	}


	public function getAll()
	{
		$result = $this->connection
			->query('SELECT * FROM korisnik');

		$gradovi = array();

		while($row = $result->fetch_assoc()) {

			$grad = new Korisnik;
			$grad->id = $row['id'];
			$grad->ime = $row['ime'];
			$grad->prezime = $row['prezime'];
			$grad->email = $row['email'];
			$grad->password= $row['password'];
			

			array_push($gradovi, $grad);
    	}

    	return $gradovi;
	}



	public function create()
	{
		$result = $this->connection->query("INSERT INTO korisnik (ime, prezime, email, password) 
			VALUES ('$this->ime', '$this->prezime', '$this->email', '$this->password')");
		
		if ($result > 0) return true; else return false;
	}

	public function findByEmail($value)
	{
		$result = $this->connection->query(
			"SELECT * FROM korisnik WHERE email = '$value'");

		$artikl = new Korisnik;

		if($row = $result->fetch_assoc()) {

			$artikl = new Korisnik;
			$artikl->id = $row['id'];
			$artikl->ime = $row['ime'];
			$artikl->prezime = $row['prezime'];
			$artikl->email = $row['email'];
			$artikl->password = $row['password'];
    	}

    	return $artikl;
		
	}



}
?>