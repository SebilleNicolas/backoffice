<?php
require_once( '../../_function.php');


	if(isset($_GET['IdInter']) && isset($_GET['IdFS']))
	{
		$pdo = connexion();
			$IdInter = $_GET['IdInter'];
			$IdFicheSociete = $_GET['IdFS'];
			
			$req= " delete from interlocuteur where IdInterlocuteur = $IdInter";
			// var_dump($req);
			$result = $pdo->exec($req);
		
			
		
			$ListeInterocuteur = ListeInterlocuteur($_GET['IdFS']);
					
					for ($i = 0; $i < count($ListeInterocuteur); $i++) {
							
										
				
				echo(' <option id="OptionInter" value="'.$ListeInterocuteur[$i][0].'" '); 
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