<?php
//inclusion de la page de fonction php
	require_once('../../_function.php');
	
	 if(isset($_GET['idRelanceClient']) )
	{
		$pdo=connexion();
		
			$idRelanceClient = $_GET['idRelanceClient'];
		
			$req= " delete from relanceclient where idRelanceClient = $idRelanceClient";
			
			$result = $pdo->exec($req);
			
			
		echo(include 'TableauRelanceClient.php');
				


		
	}
	
	
	
	 
	
	
	
	 
	 
	 
	 
	 
	 
	 
	 
?>
