<?php
require_once( '../../_function.php');

		// var_dump($_GET);
	if(isset($_GET['NouveauNomSujet']) && isset($_GET['commSujet']))
	{
		if($_GET['NouveauNomSujet'] != "" && $_GET['commSujet'] != "" )
		{
			$pdo = connexion();
				$NouveauNomSujet = $_GET['NouveauNomSujet'];
				$commSujet = $_GET['commSujet'];
				// $commSujet = str_replace("<p>","",$commSujet);
			// $commSujet = str_replace("</p>","",$commSujet);
			$commSujet = str_replace("'","\'",$commSujet);
			$NouveauNomSujet = str_replace("'","\'",$NouveauNomSujet);
				
				
						$req= "  insert into sujetbaseconnaissance values(null,'".$NouveauNomSujet."','".$commSujet."')"; 
					
				var_dump($req);
			// exit;
				$result = $pdo->exec($req);
				
				$req= " select max(IdSujet) from sujetbaseconnaissance";
				$result = $pdo->query($req)->fetch();
			$Id = $result['0'];	
					
		echo('   <option value="'.$Id.'" >'.$NouveauNomSujet.'</option>');
			
		}
		else{ echo('-1');}
	}
	
?>