<?php
	require_once('../../_function.php');
if(isset($_GET['Libelle']) && isset($_GET['idCateg']))
	{
	
				
				$pdo = connexion();
				
					
					
					$Lbl = $_GET['Libelle'];
					$idCateg = $_GET['idCateg'];
						$req= "update categorie set LibelleCategorie = '".$Lbl."' where IdCategorie= ".$idCateg;
					// var_dump($req);exit;
					$result = $pdo->exec($req);
				// var_dump($req);exit;
			
				
				

				
				
	 }
	 
?>