<?php
	require_once('../../_function.php');
if(isset($_GET['idCateg']))
	{
				$pdo = connexion();
				$idCateg = $_GET['idCateg'];
					$req= "delete from categorie where IdCategorie =".$idCateg;
				$result = $pdo->exec($req);
				
				include 'tableau.php';
				
	 }
	 
?>