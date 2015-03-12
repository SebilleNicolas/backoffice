<?php



//Démarrage des sessions
	session_start();
	
	
require_once( '../../_function.php');

	
	//inclusion du header
	// include '../../../html/Header.html';

	
	// Vérification de l'authentification
	// verificationAuthentification();
// var_dump($_SESSION);

// var_dump($_SESSION);&& $_SESSION["id"] != ""

	if(isset($_GET['DatePA'])&& isset($_GET['ListeTechniongletRappelAction'])&& isset($_GET['NumProchaineAction']) && $_GET['idInterlocuteur'] != "" )  
	{
		$pdo = connexion();
	
			if($pdo != false)
						{
				$idInterlocuteur = $_GET['idInterlocuteur'];
				$DatePA = $_GET['DatePA'];
				$ListeTechniongletRappelAction = $_GET['ListeTechniongletRappelAction'];
				$ListeEPAongletRappelAction = $_GET['ListeEPAongletRappelAction'];
				$ListeTypeDemandeongletRappelAction = $_GET['ListeTypeDemandeongletRappelAction'];
				$NumProchaineAction = $_GET['NumProchaineAction'];
				$DebutHeurePA = $_GET['DebutHeurePA'];
				$DebutMinutePA = $_GET['DebutMinutePA'];
				$FinHeurePA =$_GET['FinHeurePA'];
				$FinMinutePA = $_GET['FinMinutePA'];
				$ObjetPA = $_GET['ObjetPA'];
				 $CommDescription = $_GET['CommDescription'];
				 $CommSolution = $_GET['CommSolution'];
				  $idFicheS = $_GET['idFicheS'];
					$id = $_SESSION['id'];
			
			if($ListeEPAongletRappelAction == "")
			{ $ListeEPAongletRappelAction = 'null';}
			
			if($CommDescription == "")
			{ $CommDescription = ' ';}
			
			if($CommSolution == "")
			{ $CommSolution = ' ';}
			
				$CommSolution = str_replace("<p>","",$CommSolution);
				$CommSolution = str_replace("</p>","",$CommSolution);
				$CommDescription = str_replace("<p>","",$CommDescription);
				$CommDescription = str_replace("</p>","",$CommDescription);
				$CommSolution = str_replace("'","\'",$CommSolution);
				$CommSolution = str_replace("'","\'",$CommSolution);
				$CommDescription = str_replace("'","\'",$CommDescription);
				$CommDescription = str_replace("'","\'",$CommDescription);
		
			
			
			$insert = "
					INSERT INTO actions 
					VALUES (null,'".$NumProchaineAction."',$idFicheS,$id,$ListeTechniongletRappelAction,$ListeEPAongletRappelAction,null,null,'".$DatePA."',$DebutHeurePA,$DebutMinutePA,
					'EC','".$DatePA."',$FinHeurePA,$FinMinutePA,null,$ListeTypeDemandeongletRappelAction,null,$idInterlocuteur,null,'".$CommDescription."','".$CommSolution."',1)
					";
				
			
			// var_dump($insert);
			$res = $pdo -> exec($insert); 
			
			}
			if($res > 0){ echo("1"); }
			else{ echo("-1"); }
			
	}
	else{ echo("-1"); }
	
	
?>