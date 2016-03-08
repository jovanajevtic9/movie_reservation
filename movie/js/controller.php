<?php
require 'config.php';

	include 'models/Projekcija.php';
	include 'models/Film.php';
	include 'models/Grad.php';
	

	$konekcija = new MySqli($mysql_server, $mysql_user, 
		$mysql_password, $mysql_db);

	error_reporting(0); 

	if (isset($_GET['podaci'])) {
		
		if($_GET['podaci']=='all_projekcije') {

			
				$projekcija = new Projekcija($konekcija);
				echo json_encode($projekcija->getAll());
			}



?>