<?php
//inclusion de la page de fonction php
	require_once '../../_function.php';
	
	 if(isset($_GET['type'])  && isset($_GET['idAction']))
	{
		
				
			$pdo = connexion();
			$type = $_GET['type'];
			
			$Commentaire = $_GET['comm2'];
			$idAction = $_GET['idAction'];
			$Commentaire = str_replace("<p>","",$Commentaire);
			$Commentaire = str_replace("</p>","",$Commentaire);
			$date = date("Y-m-d");
			$heure=date("H");
			$minute = date("i");
			$req= " insert into relanceclient values(null,$idAction,'".$date."','".$heure."','".$minute."',$type,'".$Commentaire."')";
			
			$result = $pdo->exec($req);
		
		
	echo(include 'TableauRelanceClient.php');
		
	}
	
	
	
	 
?>
