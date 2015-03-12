<?php
require_once( '../../_function.php');


	if(isset($_GET['IdSujet']) )
	{
		$pdo = connexion();
			$IdSujet = $_GET['IdSujet'];
			
			
			$req= " delete from sujetbaseconnaissance where IdSujet = $IdSujet";
			
			$result = $pdo->exec($req);
		
			
		// var_dump($result);exit;
			$ListeSujet = ListeSujet($IdSujet);
					
					for ($i = 0; $i < count($ListeSujet); $i++) {
							
										
				
				echo(' <option value="'.$ListeSujet[$i][0].'" >'); 
				
				 
					
					 echo ($ListeSujet[$i]['NomSujet'].'</option>');
				  }
	
	}
	
	
?>