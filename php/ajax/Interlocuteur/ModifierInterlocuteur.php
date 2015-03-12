<?php
require_once( '../../_function.php');


	if(isset($_GET['IdInter']) && isset($_GET['IdFS']))
	{
		$pdo = connexion();
			$IdInter = $_GET['IdInter'];
			$IdFicheSociete = $_GET['IdFS'];
			$Nom = $_GET['Nom'];
			$Prenom = $_GET['Prenom'];
			if($_GET['TelM'] == "")
			{$TelM = null;	}
			else{	$TelM = $_GET['TelM']; }
			$email = $_GET['email'];
			
			$req= " update interlocuteur set NomI = '".$Nom."' ,
											PrenomI = '".$Prenom."',
											TelMobileI = '".$TelM."',
											emailI = '".$email."'
											where IdInterlocuteur = $IdInter";
			var_dump($req);
			$result = $pdo->exec($req);
		
			
		// var_dump($result);
		$ListeInterocuteur = ListeInterlocuteur($_GET['IdFS']);
					
					for ($i = 0; $i < count($ListeInterocuteur); $i++) {
							
										
				
				echo(' <option  id="OptionInter" value="'.$ListeInterocuteur[$i][0].'" '); 
				if(isset($_GET['IdInter'])):
				  if($_GET['IdInter'] != ""):
				  if($ListeInterocuteur[$i][0] == $_GET['IdInter']):
				  
				  echo('  selected ');
				  endif; endif; endif;
					echo('>');
					 echo ($ListeInterocuteur[$i]['NomI'].'    '.$ListeInterocuteur[$i]['PrenomI'].'</option>');
				  }
		
	}
	
	
?>