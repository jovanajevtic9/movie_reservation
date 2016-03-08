<?php



class Projekcija {

	public $id=0;
	public $datum="";
	public $film=0;
	public $grad=0;
	public $cena=0;
	public $ukupno_mesta=0;
	public $prodato_mesta=0;
	

	private $connection;

	public function __construct($param) {
	    $this->connection = $param;
	}

	private function toObjectArray($result)
	{
		$artikli = array();

		while($row = $result->fetch_assoc()) {

			$artikl = new Projekcija;
			$artikl->id = $row['id'];
			$artikl->datum = $row['datum'];
			$artikl->film = Film::findById(
				$this->connection, $row['id_film']);
			$artikl->grad = Grad::findById(
				$this->connection, $row['id_grad']);
			$artikl->cena = $row['cena'];
			$artikl->ukupno_mesta = $row['ukupno_mesta'];
			$artikl->prodato_mesta = $row['prodato_mesta'];

			array_push($artikli, $artikl);
    	}

    	return $artikli;
	}

	
	public static function findById($connection, $id){

		$result = $connection->query(
			"SELECT * FROM projekcija WHERE id = $id");

		$tip = new Projekcija;

		if($row = $result->fetch_assoc()) {
			$tip->id = $row['id'];
			$tip->datum = $row['datum'];
			$tip->film = Film::findById($connection, $row['id_film']);
			$tip->grad = Grad::findById($connection, $row['id_grad']);
			$tip->cena = $row['cena'];
			$tip->ukupno_mesta = $row['ukupno_mesta'];
			$tip->prodato_mesta = $row['prodato_mesta'];
		
    	}

    	return $tip;
	}


	public function getAll()
	{
		$result = $this->connection
			->query('SELECT * FROM projekcija ORDER BY id ASC LIMIT 8');

		return $this->toObjectArray($result);
	}

	public function getAllByFilm($id)
	{
		$result = $this->connection
			->query("SELECT * FROM projekcija WHERE id_film = $id");

		return $this->toObjectArray($result);
	}

	public function findGradoviByFilm($id)
	{
		$result = $this->connection
			->query("SELECT * FROM projekcija WHERE id_film = $id GROUP BY id_grad");

		return $this->toObjectArray($result);
	}

	public function findDatumiByFilmAndGrad($idFilm, $idGrad)
	{
		$result = $this->connection
			->query("SELECT * FROM projekcija WHERE id_film = $idFilm and id_grad=$idGrad GROUP BY datum");

		return $this->toObjectArray($result);
	}
	
	


	public function findByGrad($gradId)
	{
		$result = $this->connection->query(
			"SELECT * FROM projekcija WHERE id_grad = $gradId");

		return $this->toObjectArray($result);
	}

		public function updateProdatoMesta($prodato, $id)
	{
		$result = $this->connection->query("UPDATE projekcija SET prodato_mesta=prodato_mesta+$prodato WHERE id=$id");

		if ($result > 0) return true; else return false;
	}

	public function getTopTen()
	{
		$result = $this->connection->query(
			"SELECT p.id, p.datum, p.id_film, p.id_grad, p.cena, p.ukupno_mesta,SUM(p.prodato_mesta) as prodato_mesta FROM projekcija p GROUP BY id_film ORDER BY prodato_mesta DESC");

		return $this->toObjectArray($result);
	}

	




}


?>