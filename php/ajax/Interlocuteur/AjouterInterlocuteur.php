<?php
require_once( '../../_function.php');

		// var_dump($_GET);
	if(isset($_GET['idFS']) && isset($_GET['NomI']))
	{
		if($_GET['idFS'] != "" && $_GET['NomI'] != "" )
		{
			$pdo = connexion();
				$idFS = $_GET['idFS'];
				$NomI = $_GET['NomI'];
				$PrenomI = $_GET['PrenomI'];
				$idAction = $_GET['idAction'];
				if( $_GET['TelMobile'] != "")
				{
				$TelMobile = $_GET['TelMobile'];
				}
				else
				{
				$TelMobile =null;
				}
					if($_GET['Email'] != "")
					{
						$Email = $_GET['Email'];
						$req= "  insert into interlocuteur values(null,$idFS,'".$NomI."','".$PrenomI."','".$TelMobile."','".$Email."')"; 
					}
					else
					{
					$req= "  insert into interlocuteur values(null,$idFS,'".$NomI."','".$PrenomI."','".$TelMobile."',null)"; 
					}
				
				// var_dump($req);exit;
			
				$result = $pdo->exec($req);
				
				$req= " select max(IdInterlocuteur) from interlocuteur";
				$result = $pdo->query($req)->fetch();
			$Id = $result['0'];	
					
		echo('   <option id="OptionInter" value="'.$Id.'" >'.$NomI.' '.$PrenomI.'</option>');
			
		}
	}
	
?>