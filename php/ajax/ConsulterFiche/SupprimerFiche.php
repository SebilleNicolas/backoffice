<?php
session_start();
	require_once('../../_function.php');
if(isset($_GET['idFiche']))
	{
				$pdo = connexion();
				$idFiche = $_GET['idFiche'];
					$req= "delete from fichesociete where id =".$idFiche;
					// var_dump($req);
				$result = $pdo->exec($req);
				
		echo( include '../../TableauConsulterFiche.php');
	
				
	 }
	 
?>