<?php
//inclusion de la page de fonction php
	require_once('../../_function.php');
	
	 if(isset($_GET['idRelanceTechni']))
	{
		
				
			$pdo = connexion();
			
			$idRelanceTechni = $_GET['idRelanceTechni'];
			
			$req= " select CommentaireRelanceTechni from relancetechnicien where IdRelanceTechni = $idRelanceTechni";
			// var_dump($req);exit;
			$result = $pdo->query($req)->fetch();
		
		$comm = $result['0'];
		// var_dump($res);exit;
		// $IdRelanceTechnicien = $res['IdRelance'];
		// $ListeTypeDemande = ListeTypeDemande();
		// $ListeTechnicien = ListeTechnicien();
		// $ListeRappelTechnicien = ListeRappelTechnicien($idaction);
		
		
				
		
		echo($comm);
		
			 
		
		
	}
	
?>
