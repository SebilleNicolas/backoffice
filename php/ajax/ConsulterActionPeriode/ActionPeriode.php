<?php
require_once( '../../_function.php');

if(isset($_GET['r']) )
{
$NouveauTableau = array();
$fp = fopen('../../file.csv', 'w');
		fputcsv($fp, $NouveauTableau, '*');
		fclose($fp);
}
if(isset($_GET['IdActions']) )
{
	
	$idAction = $_GET['IdActions'];
	

	$pdo = connexion();

	if($pdo != false)
	{
		$req="SELECT A.IdActions,A.Etat, A.NumAction, A.DateDeb, A.HeureDeb, A.MinuteDeb, A.HeureFin, A.MinuteFin,A.DureeAction, A.DescriptionAction, A.SolutionAction,
			I.NomI, I.PrenomI,I.TelMobileI ,I.IdInterlocuteur, F.id, F.NomSociete
			FROM actions A, interlocuteur I, fichesociete F
			WHERE I.IdInterlocuteur = A.IdInterlocuteur
			and I.IdFicheSociete = F.id
			and idActions = $idAction";
		// var_dump($req);
		$res = $pdo -> query($req)->fetchall(); 
			// var_dump($_GET['f']);
			
			
			$fp = fopen('../../file.csv', 'a');
			fputcsv($fp, $res[0], '*');
			fclose($fp);
			
	}


	
	
	
	

}


	


	

?>