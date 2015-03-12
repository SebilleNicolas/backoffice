<?php

/**
 * Page d'accueil du site lorsque l'utilisateur est connecté
**/
	
	/*Démarrage des sessions*/
	session_start();
	
	/*Inclusion du header*/
	include '../html/Header.html';
	
	/*Inclusion de la page de fonctions*/
	require_once('_function.php');
	
	/*Verification de l'authentification*/
	verificationAuthentification();
	
	include '../html/menuAdministrateur.html';
	

	
?>

<div class="contenu">
	
	<h1>Bienvenue sur l'application De backoffice pizza !</h1>
	
	<p>Ce site est optimisé pour Google chrome.</p>
	
</div>

<?php
	
	/*Inclusion du footer*/
	include '../html/Footer.html';
	
?>