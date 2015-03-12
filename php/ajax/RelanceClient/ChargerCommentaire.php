<?php
//inclusion de la page de fonction php
	require_once('../../_function.php');
	
	 if(isset($_GET['idRelanceClient']))
	{
		
				
			$pdo = connexion();
			
			$idRelanceClient = $_GET['idRelanceClient'];
			
			$req= " select CommentaireRelanceCli from relanceclient where IdRelanceClient = $idRelanceClient";
			
			$result = $pdo->query($req)->fetch();
		
		$comm = $result['0'];
		// var_dump($comm);exit;
		// $IdRelanceTechnicien = $res['IdRelance'];
		// $ListeTypeDemande = ListeTypeDemande();
		// $ListeTechnicien = ListeTechnicien();
		// $ListeRappelTechnicien = ListeRappelTechnicien($idaction);
		
		
				
		echo($comm);
		


		
	}
	
	
	
	 
	
	
	
	 
	 
	 
	 
	 
	 
	 
	 
?>
