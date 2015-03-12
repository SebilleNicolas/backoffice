<?php
	
/**
 * Page intermédiaire de déconnexion
**/
	
	/*Chargement des sessions*/
	session_start();
	
	/*Réinitialisation des sessions*/
	$_SESSION = array(); 

	/*Destruction des sessions*/
	session_destroy();
	
	/*Redirection*/
	header('Location: ../index.php');

?>