<?php
//inclusion de la page de fonction php
	require_once('../../_function.php');
	
	 if(isset($_GET['IdSujet']))
	{
		
				
			$pdo = connexion();
			
			$IdSujet = $_GET['IdSujet'];
			
			$req= " select LibelleSujet from sujetbaseconnaissance where IdSujet = $IdSujet";
			
			$result = $pdo->query($req)->fetch();
		
		$comm = $result['0'];
		
		
		
				
		echo($comm);
		


		
	}
	
	
	
	
?>