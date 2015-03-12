<?php

/**
 * Page montrant les précédentes fiches du visiteur
 * Il ne peut que visionner ses fiches
**/
	
	//Démarrage des sessions
	session_start();
	
	//inclusion du header
	include '../html/Header.html';
	
	
	
	//inclusion de la page de fonction php
	include '_function.php';
	
	//Vérification de l'authentification
	verificationAuthentification();
	
	$date = DateTempFin();
// var_dump( $date);
	
?>
<?php 

for ($i = 0; $i < count($date); $i++) {
							

$a_date = explode(".", $date[$i]['DateFin']); //découpage de la date selon les .

// var_dump( $a_date);

//Construction de la date au format jour/mois/annee

$datefini = $a_date[2]."-".$a_date[1]."-".$a_date[0];


	
	
?>

<?php echo $datefini; ?> </br>
<?php } ?>

<?php include'../html/Footer.html'; ?>
