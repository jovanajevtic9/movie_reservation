<?php

session_start();

require 'config.php';

include 'model/Grad.php';
include 'model/Film.php';
include 'model/Korisnik.php';
include 'model/Projekcija.php';
include 'model/Rezervacija.php';
include 'model/Kontakt.php';




$konekcija = new MySqli($mysql_server, $mysql_user, 
		$mysql_password, $mysql_db);

error_reporting(0); #micemo upozorenja

if (isset($_GET['podaci'])){

	switch ($_GET['podaci']) {

			case 'gradovi':

				$grad = new Grad($konekcija);
				echo json_encode($grad->getAll());
				break;

			case 'gradovibyfilm':
				$grad = new Projekcija($konekcija);
				echo json_encode($grad->findGradoviByFilm($_GET['film']));
				
				break;

			case 'gradbyid':
				$grad = new Grad($konekcija);
				echo json_encode($grad->findById($konekcija,$_GET['id']));
				
				break;

			case 'filmovi':

				$film = new Film($konekcija);
				echo json_encode($film->getAll());
				break;

			
			case 'projekcije':

				$film = new Projekcija($konekcija);
				echo json_encode($film->getAll());
				break;

			case 'datumi':

				$film = new Projekcija($konekcija);
				echo json_encode($film->findDatumiByFilmAndGrad($_GET['film'], $_GET['grad']));
				break;

			case 'pretraga':
				$film = new Film($konekcija);
				echo json_encode($film->find($_GET['naziv']));

				break;

			case 'korisnik':

				$korisnik = new Korisnik($konekcija);
				echo json_encode($korisnik->findById($konekcija, $_SESSION['idUser']));
				break;

			case 'rezervacija':

				$rez = new Rezervacija($konekcija);
				
				echo json_encode($rez->findByKorisnik($_SESSION['idUser']));
				break;
			case 'topten':

				$rez = new Projekcija($konekcija);
				
				echo json_encode($rez->getTopTen());
				break;



			default:
				echo '<h1>Error 404</h1><p>Action not found...</p>';
				break;
			}

}
if (isset($_GET['session'])){
		if($_GET['session']==0){
			session_destroy();
  			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}

	}

if (isset($_POST['podaci'])) {
		
		switch ($_POST['podaci']) {
			case 'korisnik':
				//da li postoji taj email
				$user = new Korisnik($konekcija);
				$user = $user->findByEmail($_POST['email']);
				if($user->ime!=''){
					$_SESSION['valid']="not";
					header('Location: index.php');
				}
				else{
						$_SESSION['valid']="";
						$tip = new Korisnik($konekcija);
						$tip->ime = $_POST['ime'];
						$tip->prezime = $_POST['prezime'];
						$tip->email = $_POST['email'];
						$tip->password = $_POST['password'];

						if ($tip->create()) {
							
							//$_SESSION["ime"] = $_POST['ime'];
							//$_SESSION["prezime"] = $_POST['prezime'];
							
							//echo "Favorite color is " . $_SESSION["favcolor"] . ".<br>";
							//echo "Favorite animal is " . $_SESSION["favanimal"] . ".";
							header('Location: ' . $_SERVER['HTTP_REFERER']);
						}

						else
							echo 'Greska pri upisu tipa u bazu! '.
								mysqli_error($konekcija);

					}
				break;


				case 'logovanje':

					$user = new Korisnik($konekcija);
					$user = $user->findByEmail($_POST['email1']);
					
					if($user->ime!=''){
						$_SESSION["ime"] = $user->ime;
						$_SESSION["prezime"] =$user->prezime;
						$_SESSION["idUser"] = $user->id;
						//echo "".$_SESSION["prezime"]."";
						header('Location: ' . $_SERVER['HTTP_REFERER']);
					}
					else {
						header('Location: ' . $_SERVER['HTTP_REFERER']);
					}

					
				break;

				case 'rezervacija':

					$rez = new Rezervacija($konekcija);
					$rez ->id_projekcija = $_POST['idProj'];
					$rez->id_korisnik = $_SESSION['idUser'];
					$rez->br_karata = $_POST['brKarata'];
					$p = new Projekcija($konekcija);

					
					

					if ($rez->create() && $p->updateProdatoMesta($_POST['brKarata'],$_POST['idProj'])) {
						header('Location: ' . $_SERVER['HTTP_REFERER']);
					}
					else{echo "nije";}
					

					
				break;

				case 'slika':
				
				
				
				$input = 'http://zena.blic.rs/data/images/2015/06/01/15/92354_jovana-joksimovic01-ras-foto-emil-conkic_630x0.jpg?ver=1433165996';
				$output = "img/users/".$_SESSION['idUser'].".jpg";
				file_put_contents($output, file_get_contents($input));
				header('Location: ' . $_SERVER['HTTP_REFERER']);

				break;

				case 'poruka':
				$kon = new Kontakt($konekcija);
				
				$poruka = $_POST['poruka'];
				$mail = $_POST['email'];
				$kon->email = $mail;
				$kon->komentar= $poruka;
				if($kon->create()){
					header('Location: ' . $_SERVER['HTTP_REFERER']);
				}

				break;

				case 'film':
				$film = new Film($konekcija);
				$film->naziv = $_POST['naziv'];
				$film->trajanje = $_POST['trajanje'];
				$film->reditelj = $_POST['reditelj'];
				$film->zanr = $_POST['zanr'];
				$film->opis = $_POST['opis'];
				$film->glumci = $_POST['glumci'];
				
				if($film->create()){
					header('Location: ' . $_SERVER['HTTP_REFERER']);
				}

				break;



		default:
				echo '<h1>Error 404</h1><p>Action not found...</p>';
				break;
			}
}

?>