<?php
	require_once('../../_function.php');
if(isset($_GET['idNumeroSerie']))
	{	$IdAction = $_GET['IdAction'];
				$pdo = connexion();
				$idNumeroSerie = $_GET['idNumeroSerie'];
					$req= "delete from numeroserie where IdNumSerie =".$idNumeroSerie;
					// var_dump($req);exit;
				$result = $pdo->exec($req);
				
				include '../../TableauNumeroSerieLogi.php';
				
	 }
	 
?>