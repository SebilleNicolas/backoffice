<?php
	
/**
 * Page interm�diaire de d�connexion
**/
	
	/*Chargement des sessions*/
	session_start();
	
	/*R�initialisation des sessions*/
	$_SESSION = array(); 

	/*Destruction des sessions*/
	session_destroy();
	
	/*Redirection*/
	header('Location: ../index.php');

?>