<?php



class Rezervacija {

	public $id=0;
	public $korisnik="";
	public $projekcija="";
	public $br_karata=0;
	
	

	private $connection;

	public function __construct($param) {
	    $this->connection = $param;
	}

	private function toObjectArray($result)
	{
		$artikli = array();

		while($row = $result->fetch_assoc()) {

			$artikl = new Rezervacija;
			$artikl->id = $row['id'];
			$artikl->korisnik = Korisnik::findById(
				$this->connection, $row['id_korisnik']);
			$artikl->projekcija = Projekcija::findById(
				$this->connection, $row['id_projekcija']);
			$artikl->br_karata = $row['br_karata'];

			array_push($artikli, $artikl);
    	}

    	return $artikli;
	}

	public function getAll()
	{
		$result = $this->connection
			->query('SELECT * FROM rezervacija ORDER BY id');

		return $this->toObjectArray($result);
	}


	public static function findById($connection, $id)
	{
		$result = $connection->query(
			"SELECT * FROM rezervacija WHERE id = $id");

		$tip = new Rezervacija;

		if($row = $result->fetch_assoc()) {

			$tip->id = $row['id'];
			$tip->korisnik = Korisnik::findById(
				$connection, $row['id_korisnik']);
			$tip->projekcija = Projekcija::findById(
				$connection, $row['id_projekcija']);
			$tip->id = $row['br_karata'];
			
		
    	}

    	return $tip;
	}

	public function findByKorisnik($idUser)
	{
		$result = $this->connection
			->query("SELECT r.id, r.id_korisnik, r.id_projekcija, SUM(r.br_karata) as br_karata FROM rezervacija r WHERE id_korisnik = $idUser GROUP BY id_projekcija");

		return $this->toObjectArray($result);
	}

	public function create()
	{
		$result = $this->connection->query("INSERT INTO rezervacija (id_projekcija, id_korisnik, br_karata) 
			VALUES ('$this->id_projekcija', '$this->id_korisnik', '$this->br_karata')");
		
		if ($result > 0) return true; else return false;
	}








}

?>