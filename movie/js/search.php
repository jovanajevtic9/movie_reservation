<?
require 'config.php';

include 'model/Grad.php';
include 'model/Film.php';
include 'model/Korisnik.php';
include 'model/Projekcija.php';



$konekcija = new MySqli($mysql_server, $mysql_user, 
		$mysql_password, $mysql_db);

error_reporting(0); #micemo upozorenja

if (isset($_GET['podaci'])){

  echo '<h1>Error 404</h1><p>Action not found...</p>';

  $q = $_GET['podaci'];
  $projekcija = new Film($konekcija);
  echo json_encode($projekcija->find($q));
}
else {
echo '<h1>Error 404</h1>';

}


?>