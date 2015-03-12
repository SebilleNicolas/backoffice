<?php
include '../_function.php';






	if(isset($_GET['ValeurTechni'])&& isset($_GET['valeursType'])&& isset($_GET['CommentaireRappelTechni']))
	{
		
	
	include '../_function.php';
	$IdAction = recupererDernierIdActions() +1;
	AjoutRappelTechni($IdAction,$_GET['ValeurTechni'],$_GET['valeursType'],$_GET['CommentaireRappelTechni']);
		
	}
	
	
	
	// if(isset($_GET['supp']))
	// {
	// if($_GET['supp'] == true)
	// {
		 // SupprimerAction($id);
	// }
	// }
	
?>