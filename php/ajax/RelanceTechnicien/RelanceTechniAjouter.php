<?php
//inclusion de la page de fonction php
	require_once('../../_function.php');
	
	 if(isset($_GET['type']) && isset($_GET['techni']) && isset($_GET['idRelanceTechni']))
	{
		
				
			$pdo = connexion();
			$type = $_GET['type'];
			$techni = $_GET['techni'];
			$Commentaire = $_GET['comm2'];
			$idRelanceTechni = $_GET['idRelanceTechni'];
			$Commentaire = str_replace("<p>","",$Commentaire);
			$Commentaire = str_replace("</p>","",$Commentaire);
			$date = date("Y-m-d");
			$heure=date("H");
			$minute = date("i");
			$req= " insert into relancetechnicien values(null,$idRelanceTechni,'".$date."','".$heure."','".$minute."', $techni,$type,'".$Commentaire."')";
			// var_dump($req);exit;
			$result = $pdo->exec($req);
		
		$req="Select max(IdRelanceTechni) as IdRelance from relancetechnicien";
		$res = $pdo->query($req)->fetch(); 
		// var_dump($res);exit;
		$IdRelanceTechnicien = $res['IdRelance'];
	

	echo(include 'tableauRT.php');
		
	}
	
	
	
	 
?>
