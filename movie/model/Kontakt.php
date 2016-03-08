<?php 

class Kontakt {

	public $id=0;
	public $email="";
	public $komentar="";
	

	private $connection;

	public function __construct($param) {
	    $this->connection = $param;
	}

	private function toObjectArray($result)
	{
		$korisnici = array();

		while($row = $result->fetch_assoc()) {

			$korisnik = new Kontakt;
			$korisnik->id = $row['id'];
			$korisnik->email = $row['email'];
			$korisnik->komentar= $row['komentar'];

			array_push($korisnici, $korisnik);
    	}

    	return $korisnici;
	}

	public function create()
	{
		$result = $this->connection->query("INSERT INTO kontakt (email, komentar) 
			VALUES ('$this->email', '$this->komentar')");
		
		if ($result > 0) return true; else return false;
	}




}
?>