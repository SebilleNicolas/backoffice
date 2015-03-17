<?php

/**
 * Page contenant toutes les fonctions utilisées sur l'application web
**/

/******************************************** FONCTIONS ********************************************/


function anus()
{
}
/************** Fonction de connexion à la base de données **************/
function connexion()
{

	$pdo = false ;
	
	try {

			$pdo = new PDO( 
			'mysql:host=127.0.0.1;dbname=spizza', 
			'root',
			'root'
			); 
			$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
		}
		
	catch (PDOException $err) {
	
			$messageErreur = $err->getMessage();
			error_log($messageErreur,0);
			
		}
	
	return $pdo ;

	
}
/************** Fonction de vérification de l'existance de l'utilisateur **************/
function verification($id, $mdp)
{

	$bool = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{
		echo"************************************************";
		$sql = "Select count(*) as nb from administrateur where login =:user and mdp =:mdp";
		
		
		$prep = $pdo -> prepare($sql);
		
		$prep -> bindParam(':user', $id, PDO::PARAM_STR);
		
		$prep -> bindParam(':mdp', $mdp, PDO::PARAM_STR);
		var_dump($sql); 
		$prep -> execute();
		
		$resultat = $prep -> fetch();
		
		if($resultat['nb'] == 1)
		{
		
			$bool = true;
		
		}
		
		$prep -> closeCursor();
	
	}
	
	return $bool;
	
}

/************** Fonction de vérification de l'authentification **************/
function verificationAuthentification()
{
	
	if(!($_SESSION["auth"] == "authentifie"))
	{
	
		header("Location: ../index.php");
	
	}
	
}



/************** Fonction d'obention de l'identifiant **************/
function id($login, $mdp)
{
	$stat = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{
	
		$sql = "Select id from administrateur where login =:user and mdp =:mdp";
		
		$prep = $pdo -> prepare($sql);
		
		$prep -> bindParam(':user', $login, PDO::PARAM_STR);
		
		$prep -> bindParam(':mdp', $mdp, PDO::PARAM_STR);
		
		$prep -> execute();
		
		$resultat = $prep -> fetch();
		
		$stat = $resultat["id"];
	
	}
	
	return $stat;
	
}

/************** Fonction d'obention de la liste des Pizza **************/
function listePizza()
{
	mb_internal_encoding('UTF-8');
	$result = false;
	
	$pdo = connexion();
	
	
	
	if($pdo != false)
	{
		
		$listePizza = "
						SELECT CodePizza, NomPizza, Prix, Image
						FROM pizza
						
						
					";
		//mysql_query("SET NAMES 'utf8'");
		$result = $pdo -> query($listePizza)->fetchall();
		
	}

	return $result;
		
}

/************** Fonction d'obention de fiche avec l'identifiant **************/
function listeFiche($id)
{

	$result = false;
	
	$pdo = connexion();
	
	
	
	if($pdo != false)
	{
		
		$listeFiche = "
						SELECT id, NomSociete, Adresse, CodePostal,Ville,Telephone
						FROM fichesociete
						
						
					";
				
		$result = $pdo -> query($listeFiche)->fetchall();
		
	}

	return $result;
		
}
/************** Fonction d'obention de fiche avec l'identifiant par ordre croissant**************/
function listeFicheparOC($id)
{

	$result = false;
	
	$pdo = connexion();
	
	
	
	if($pdo != false)
	{
		
		$listeFiche = "
						SELECT id, NomSociete, Adresse, CodePostal,Ville,Telephone
						FROM fichesociete
						order by NomSociete ASC
						
					";
					
		$result = $pdo -> query($listeFiche)->fetchall();
		
	}

	return $result;
		
}
/************** Fonction d'obention de fiche avec l'identifiant par nbr actions **************/
function listeFicheparNbrActions($id)
{

	$result = false;
	
	$pdo = connexion();
	
	
	
	if($pdo != false)
	{
		
		$listeFiche = "
						SELECT id, NomSociete, Adresse, CodePostal, Ville, Telephone, COUNT( idActions ) AS nbrACtion
						FROM  `actions` A, fichesociete F
						WHERE A.idFiche = F.id
						GROUP BY idFiche
						ORDER BY nbrACtion DESC 
						
					";
				
		$result = $pdo -> query($listeFiche)->fetchall();
		
	}

	return $result;
		
}

/************** Fonction d'obention de fiche avec l'identifiant **************/
function listeFicheVisiteur()
{

	$result = false;
	
	$pdo = connexion();
	
	
	
	if($pdo != false)
	{
		
		$listeFiche = "
						SELECT id, NomSociete, Adresse, CodePostal,Ville,Telephone
						FROM fichesociete
						
						
					";
					
		$result = $pdo -> query($listeFiche)->fetchall();
		
	}

	return $result;
		
}



/************** Fonction de création d'une fiche **************/
function creePizza($NomPizza, $Ingredient, $Prix )
{

	$reussi = false;
		
	$pdo = connexion();
	var_dump($pdo);
	if($pdo != false)
	{
		// var_dump($NomPizza);
// var_dump($Ingredient);
// var_dump($Prix);		exit;
		// $id = $pdo -> quote($id);
		
	
		
		$insert = "
					INSERT INTO Pizza
					VALUES ( null, '".$NomPizza."',$Prix,'')
					";
					
					
		// var_dump($insert); exit();
		$res = $pdo -> exec($insert);

		
		if($res == 1)
		{
		
			$reussi = true;
		
		}
	}
	
	return $reussi;
	
}
/************** Fonction de suppression d'une fiche **************/
function supprimerFiche($id)
{

	$reussi = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{
	
		$id = $pdo -> quote($id);

		
		$req = "
					DELETE FROM fichesociete
					WHERE id = $id
					
				";
		
		$res = $pdo -> exec($req);
		
		if($res == 1)
		{
		
			$reussi = true;
		
		}
		
	}

	return $reussi;

}
/************** Fonction Compter Nbr Fiche par rapport a id Utilisateur  **************/
function NombreFicheConsulter($id)
{
	
	$pdo = connexion();
	
	if($pdo != false)
	{
	$req = "
			Select count(*) as NbrFiches 
				from fichesociete
				
			
					";
					
			$result =  $pdo -> query($req)->fetch();
	}
	
	
	return $NbrFiche = $result['NbrFiches'];
}

/************** Fonction de modification d'une fiche **************/
function modifierFiche($id,$NomSociete,$Adresse,$CodePostal,$Ville,$idUtilisateurs,$Telephone)
{

	$modif = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{
	
		$id = $pdo -> quote($id);
		$NomSociete = $pdo -> quote($NomSociete);
		$Adresse = $pdo -> quote($Adresse);
		$CodePostal = $pdo -> quote($CodePostal);
		$Ville = $pdo -> quote($Ville);
		$idUtilisateurs = $pdo -> quote($idUtilisateurs);
		$Telephone = $pdo -> quote($Telephone);
		
		
		
		$req = "
					UPDATE fichesociete
					SET NomSociete = $NomSociete ,
					Adresse = $Adresse ,
					CodePostal = $CodePostal ,
					Ville = $Ville ,
					Telephone = $Telephone 
					WHERE id = $id
					
					
				";
		
		$res = $pdo -> exec($req);
	
		if($res == 1)
		{
		
			$modif = true;
		
		}
		
	}

	return $modif;
}
/************** Fonction de Recuperation de tous les relance clients **************/
function RecupererRelanceClient()
{

	$pdo = connexion();
	
	if($pdo != false)
	{
	$req = "
			Select * 
				from relanceclient
					";
			$result =  $pdo -> query($req)->fetchall();
	}
	return $result;

}
/************** Fonction de Recuperation de tous les relance technicien **************/
function RecupererRelanceTechni()
{

	$pdo = connexion();
	
	if($pdo != false)
	{
	$req = "
			Select * 
				from relancetechnicien
					";
			$result =  $pdo -> query($req)->fetchall();
	}
	return $result;

}
//************** Fonction de Recuperation l'ID de la fiche en fonction de l'ID actions **************/
function RecupererIdFicheEnFonctionIdAction($idActions)
{

	$pdo = connexion();
	
	if($pdo != false)
	{
	$req = "
			Select idFiche 
				from actions
				where idActions = $idActions
					";
			$result =  $pdo -> query($req)->fetchall();
	}
	return $result['0'];

}
/************** Fonction de Recuperation du Nom de la societe avec ID d'une fiche **************/
function RecupererNomSociete($id)
{

	$pdo = connexion();
	
	if($pdo != false)
	{
	$req = "
			Select NomSociete 
				from fichesociete
				where id = '".$id."'
			
					";
			$result =  $pdo -> query($req)->fetch();
	}
	return $NbrFiche = $result['0'];

}
/************** Fonction de Recuperation du Nom de la societe avec ID d'une fiche **************/
function NombreActionAvecIdFIche($id)
{

	$pdo = connexion();
	
	if($pdo != false)
	{
	$req = "
			Select count(IdActions)
				FROM actions 
						WHERE  IdFiche = '".$id."'
			
					";
					
			$result =  $pdo -> query($req)->fetch();
	}
	return $NbrFiche = $result['0'];

}
/************** Fonction de recuperation du 1er IdType **************/
function recupererPremierIdType()
{
$pdo = connexion();
	
	if($pdo != false)
	{
	$req = "
			SELECT MIN( IdType ) 
			FROM  `type` 
			";
			$result =  $pdo -> query($req)->fetch();
	}
	return $result['0'];

}

/************** Fonction de recuperation du 1er IdCAtegorie *************/
function recupererPremierIdCategorie()
{
$pdo = connexion();
	
	if($pdo != false)
	{
	$req = "
			SELECT MIN( IdCategorie ) 
			FROM  `categorie` 
			";
			$result =  $pdo -> query($req)->fetch();
	}
	return $result['0'];

}

/************** Fonction de recuperation de la derniere action **************/
function recupererDernierIdActions()
{
$pdo = connexion();
	
	if($pdo != false)
	{
	$req = "
			SELECT max( IdActions ) 
			FROM  `actions` 
			";
			$result =  $pdo -> query($req)->fetch();
	}
	return $result['0'];

}



/************** Fonction de création d'une action **************/
function creeActions($NumAction,$IdFiche,$IdUtilisateurs,$PremierIdType,$PremierIdCategorie)
{

	$reussi = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{
		
		$IdFiche = $pdo -> quote($IdFiche);
		$IdUtilisateurs = $pdo -> quote($IdUtilisateurs);
		$PremierIdType = $pdo -> quote($PremierIdType);
		$PremierIdCategorie = $pdo -> quote($PremierIdCategorie);
		
		 
	$date = date("Y-m-d");	
	$heure =date("H");
	$minute = date("i");
		
		$insert = "
					INSERT INTO actions
					VALUES (null,'".$NumAction."',$IdFiche,$IdUtilisateurs,$IdUtilisateurs,null,null,null,
					'".$date."',$heure,$minute,'EC',null,null,null,$PremierIdType,null,$PremierIdCategorie,null,null,null,null,0)
					";
					
					
		
		$res = $pdo -> exec($insert);

		if($res == 1)
		{
		
			$reussi = true;
		
		}
	}
	
	return $reussi;
	
	
}
/************** Fonction de création d'une action **************/
function enregistrerActions($IdAction,$idFiche,$IdUtilisateurs,$NouveauNumero,$DateDeb,$HeureDeb,$MinuteDeb,$DureeEnJour,$TempsAction,$DateFin,$HeureFin,
	$MinuteFin,$SelectTechnicien,$SelectType,$SelectCategorie,$SelectInterocuteur,$ListeEPAOngletDescription,$ContenuTextDescription,$ContenuTextSolution,$ListeMotifs,$ListeSujet)
{

	
	
	
	
	$reussi = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{
		
	
	$etat = "EC";
		if($DateFin != "")
		{
		$etat = "CL";
		}
	$ContenuTextDescription = str_replace("<p>","",$ContenuTextDescription);
	$ContenuTextDescription = str_replace("</p>","",$ContenuTextDescription);
	$ContenuTextSolution = str_replace("<p>","",$ContenuTextSolution);
	$ContenuTextSolution = str_replace("</p>","",$ContenuTextSolution);
		$ContenuTextDescription = str_replace("'","\'",$ContenuTextDescription);
	$ContenuTextDescription = str_replace('"','\"',$ContenuTextDescription);
	$ContenuTextSolution = str_replace('"','\"',$ContenuTextSolution);
	$ContenuTextSolution = str_replace("'","\'",$ContenuTextSolution);
		
		$IdUtilisateurs = $pdo -> quote($IdUtilisateurs);
		
		
		$DF ="'$DateFin'";
	
	if($DF == "''")
	{
	$DF ="null";

	
	}
	if($HeureFin == "")
	{
	$HeureFin =" null";

	}
	if($MinuteFin == "")
	{
	$MinuteFin = "null";

	}
	if($ListeMotifs == null)
	{
	$ListeMotifs = "null";
	}
	if($SelectCategorie == "")
	{
	$SelectCategorie = "null";
	}
	if($ListeEPAOngletDescription == "")
	{
	$ListeEPAOngletDescription = "null";
	}
	if($ListeSujet == "")
	{
	$ListeSujet = "null";
	}

			
	
						$insert = "UPDATE `actions` SET `NumAction` = '".$NouveauNumero."',
	`IdTechnicien`=$SelectTechnicien,
	`IdEtatPA`=$ListeEPAOngletDescription,
	`DureeActionJour`=$DureeEnJour,
	`DureeAction`='".$TempsAction."',
	`DateDeb`='".$DateDeb."',
	`HeureDeb`=$HeureDeb,
	`MinuteDeb`=$MinuteDeb,
	`Etat`='".$etat."',
	`DateFin`=$DF,
	`HeureFin`=$HeureFin,
	`MinuteFin`=$MinuteFin,
	`IdType`=$SelectType,
	`IdCategorie`=$SelectCategorie,`IdInterlocuteur`=$SelectInterocuteur,`IdMotifs`=$ListeMotifs,`DescriptionAction`='".$ContenuTextDescription."',`SolutionAction`='".$ContenuTextSolution."',`EtatValide` = '1' WHERE IdFiche = $idFiche and idActions = $IdAction";
			
			
				
					
		
		$res = $pdo -> exec($insert);

		if($res == 1)
		{
		
			$reussi = true;
		
		}
	}

	return $reussi;
	
	
}

/************** Fonction Compter Nbr Action par rapport a id Utilisateur  **************/
function NombreActionConsulter($id)
{
	
	$pdo = connexion();
	
	if($pdo != false)
	{
	$req = "
			Select count(*) as NbrFiches 
				from fichesociete
				
			
					";
			$result =  $pdo -> query($req)->fetch();
	}
	
	
	return $NbrAction = $result['NbrFiches'];
}

/************** Fonction Compter Nbr Action de interlocuteur  **************/
function NombreActionInter($id)
{
	
	$pdo = connexion();
	
	if($pdo != false)
	{
	$req = "
			Select count(idActions) as NbrAction 
				from actions
				where IdInterlocuteur = $id
			
					";
					
			$result =  $pdo -> query($req)->fetch();
		
	}
	
	
	return $NbrAction = $result['NbrAction'];
}


/************** Fonction de Changement de l'etat d'une action **************/
function ChangerEtatAction($idAction)
{
$reussi = false;
	$pdo = connexion();
	
	if($pdo != false)
	{
	$req = "
			Select Etat 
				from Actions
				where idActions = '".$idAction."'
			
					";
			$result =  $pdo -> query($req)->fetch();
	}
	 $Etat = $result['0'];
	 
	 if($Etat == 'CL')
	 {
	 $req = "Update Actions set Etat = 'EC' where idActions = '".$idAction."' ";
	 $result = $pdo ->exec($req);
	 $reussi = true;
	 }
	 else if($Etat == 'EC')
	 {
	 $req = "Update Actions set Etat = 'CL' where idActions = '".$idAction."' ";
	 $result = $pdo ->exec($req);
	 $reussi = true;
	 }
	 
	 return $Etat;

}
/************** Fonction d'obention de la liste d'action par rapport a l'ID d'une fiche **************/
function listeActionParIdFiche($id)
{
	$result = false;
	
	$pdo = connexion();
	
	
	
	if($pdo != false)
	{
		
		$listeFiche = "
						SELECT A.IdActions, A.NumAction, A.DateDeb, A.HeureDeb, A.MinuteDeb, A.HeureFin, A.MinuteFin, I.NomI, I.PrenomI
						FROM actions A, interlocuteur I
						WHERE I.IdInterlocuteur = A.IdInterlocuteur
						AND idFiche =".$id;
		// var_dump($listeFiche);
		$result = $pdo -> query($listeFiche)->fetchall();
		
	}
	
	if(count($result) != 0)
	{	
	foreach($result as $r):
			if($r['HeureDeb'] > 10)
			{
			$r['HeureDeb'] = "0".$r['HeureDeb'];
			}
			if($r['MinuteDeb'] > 10)
			{
			$r['MinuteDeb'] = "0".$r['MinuteDeb'];
			}
			if($r['HeureFin'] > 10)
			{
			$r['HeureFin'] ="0".$r['HeureFin'];
			}
			if($r['MinuteFin'] > 10)
			{
			$r['MinuteFin'] = "0".$r['MinuteFin'];
			}
	endforeach;
	}
	return $result;
		
}

	
/************** Fonction de Recuperation de l'Etat d'une action avec IdAction **************/
function EtatAction($idAction)
{

	$pdo = connexion();
	
	if($pdo != false)
	{
	$req = "
			Select Etat 
				from Actions
				where idActions = '".$idAction."'
			
					";
					 
			$result =  $pdo -> query($req)->fetch();
			
	}
	 $Etat = $result['0'];
	 
	 return $Etat;

}




	/**************  Fcontion de liste des Type Demande **************/
function ListeTypeDemande()
{

	$pdo = connexion();
	
	if($pdo != false)
	{
	$req = "
			Select IdDemande, LibelleDemande
				from typedemande
				
			
					";
					
			$result =  $pdo->query($req)->fetchall();
	}
	 
	 
	
	 
	 return $result;

}
/************** Fonction de création d'un Type Demande**************/
function creeTypeDemande($LibelleTypeDemande)
{

	$reussi = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{
		
		$LibelleTypeDemande = $pdo -> quote($LibelleTypeDemande);
		
		 
	
		
		$insert = "
					INSERT INTO typedemande
					VALUES (null,$LibelleTypeDemande)
					";
					
					
		
		$res = $pdo -> exec($insert);

		if($res == 1)
		{
		
			$reussi = true;
		
		}
	}
	
	return $reussi;
	
	
}
/************** Fonction de suppression d'un type Demande **************/
function supprimerTypeDemande($idDemande)
{

	$reussi = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{
	
		$idDemande = $pdo -> quote($idDemande);
		
		
		
		$req = "
					DELETE FROM typedemande
					WHERE IdDemande = $idDemande
					
				";
		
		$res = $pdo -> exec($req);
		
		if($res == 1)
		{
		
			$reussi = true;
		
		}
		
	}

	return $reussi;

}
/************** Fonction Modification du type  demande **************/
function modifierTypeDemande($IdTypeDemande,$LibelleTypeDemande)
{
	
	$pdo = connexion();
	
	if($pdo != false)
	{
	$req = "
			UPDATE typedemande SET  LibelleDemande =  '".$LibelleTypeDemande."'
				where IdDemande= $IdTypeDemande
					";

			$result =  $pdo -> exec($req);
	}
	
	
	return $result;
}
/**************  Fcontion Nombre Type Demande **************/
function NombreTypeDemande()
{

	$pdo = connexion();
	
	if($pdo != false)
	{
	$req = "
			Select count(IdDemande)
				from typedemande

					";
					
			$result =  $pdo->query($req)->fetch();
	}
	 
	 
	
	 
	 return $result = $result['0'];

}

	/**************  Fcontion de liste des Types **************/
function ListeType()
{

	$pdo = connexion();
	
	if($pdo != false)
	{
	$req = "
			Select IdType,LibelleType
				from type
				
			
					";
					
			$result =  $pdo->query($req)->fetchall();
	}
	 
	 
	
	 
	 return $result;
	 

}




	/**************  Fcontion Nombre Type **************/
function NombreType()
{

	$pdo = connexion();
	
	if($pdo != false)
	{
	$req = "
			Select count(IdType)
				from type

					";
					
			$result =  $pdo->query($req)->fetch();
	}
	 
	 
	
	 
	 return $result = $result['0'];

}
/************** Fonction de création d'un Type **************/
function creeType($LibelleType)
{

	$reussi = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{
		
		$LibelleType = $pdo -> quote($LibelleType);
		
		 
	
		
		$insert = "
					INSERT INTO type
					VALUES (null,$LibelleType)
					";
					
					
		
		$res = $pdo -> exec($insert);

		if($res == 1)
		{
		
			$reussi = true;
		
		}
	}
	
	return $reussi;
	
	
}
/************** Fonction de suppression d'un type **************/
function supprimerType($id)
{

	$reussi = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{
	
		$id = $pdo -> quote($id);
		
		
		
		$req = "
					DELETE FROM type
					WHERE IdType = $id
					
				";
		
		$res = $pdo -> exec($req);
		
		if($res == 1)
		{
		
			$reussi = true;
		
		}
		
	}

	return $reussi;

}
/************** Fonction Modification du type  **************/
function modifierType($IdType,$LibelleType)
{
	
	$pdo = connexion();
	
	if($pdo != false)
	{
	$req = "
			UPDATE type SET  LibelleType =  '".$LibelleType."'
				where IdType= $IdType
					";
					
			$result =  $pdo -> exec($req);
	}
	
	
	return $result;
}



	/**************  Fcontion de liste des Categories **************/
function ListeCategorie()
{

	$pdo = connexion();
	
	if($pdo != false)
	{
	$req = "
			Select IdCategorie,LibelleCategorie
				from categorie
				
			
					";
					
			$result =  $pdo->query($req)->fetchall();
	}
	 
	 
	
	 
	 return $result;
	 

}
/************** Fonction de suppression d'une Categorie **************/
function supprimerCategorie($id)
{

	$reussi = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{
	
		$id = $pdo -> quote($id);
		
		
		
		$req = "
					DELETE FROM categorie
					WHERE IdCategorie = $id
					
				";
		
		$res = $pdo -> exec($req);
		
		if($res == 1)
		{
		
			$reussi = true;
		
		}
		
	}

	return $reussi;

}
/************** Fonction de création d'une Categorie **************/
function creeCategorie($LibelleCategorie)
{

	$reussi = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{
		
		$LibelleCategorie = $pdo -> quote($LibelleCategorie);
		
		 
	
		
		$insert = "
					INSERT INTO categorie
					VALUES (null,$LibelleCategorie)
					";
					
					
		
		$res = $pdo -> exec($insert);

		if($res == 1)
		{
		
			$reussi = true;
		
		}
	}
	
	return $reussi;
	
	
}

/************** Fonction Modification de la Categorie **************/
function modifierCategorie($IdCategorie,$LibelleCategorie)
{
	
	$pdo = connexion();
	
	if($pdo != false)
	{
	$req = "
			UPDATE categorie SET  LibelleCategorie =  '".$LibelleCategorie."'
				where IdCategorie= $IdCategorie
					";
					
			$result =  $pdo -> exec($req);
	}
	
	
	return $result;
}
/**************  Fcontion Nombre Categorie **************/
function NombreCategorie()
{

	$pdo = connexion();
	
	if($pdo != false)
	{
	$req = "
			Select count(IdCategorie)
				from categorie

					";
					
			$result =  $pdo->query($req)->fetch();
	}
	 
	 
	
	 
	 return $result = $result['0'];

}



	// /**************  Fcontion de liste des Motifs  **************/
function ListeMotifs()
{

	$pdo = connexion();
	
	if($pdo != false)
	{
	$req = "
			Select IdMotifs,LibelleMotifs
				from motifs
				
			
					";
					
			$result =  $pdo->query($req)->fetchall();
	}
	 	 
	 return $result;

}
	/**************  Fcontion de liste des Techniciens **************/
function ListeTechnicien()
{

	$pdo = connexion();
	
	if($pdo != false)
	{
	$req = "
			Select *
				from utilisateurs
				
			
					";
					
			$result =  $pdo->query($req)->fetchall();
	}
	 
	 
	
	 
	 return $result;
	 

}
/************** Fonction de suppression d'un Technicien **************/
function supprimerTechnicien($id)
{

	$reussi = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{
	
		$id = $pdo -> quote($id);
		
		
		
		$req = "
					DELETE FROM utilisateurs
					WHERE id = $id
					
				";
		
		$res = $pdo -> exec($req);
		
		if($res == 1)
		{
		
			$reussi = true;
		
		}
		
	}

	return $reussi;

}
/************** Fonction de création d'un Technicien **************/
function creeTechnicien($NomTechnicien,$PrenomT,$login,$mdp,$adresse,$CP,$Ville,$Statut)
{

	$reussi = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{
		
		$NomTechnicien = $pdo -> quote($NomTechnicien);
		$PrenomT = $pdo -> quote($PrenomT);
		$login = $pdo -> quote($login);
		$mdp = $pdo -> quote($mdp);
		$adresse = $pdo -> quote($adresse);
		$CP = $pdo -> quote($CP);
		$Ville = $pdo -> quote($Ville);

		 
	
		
		$insert = "INSERT INTO utilisateurs
					VALUES (null,$NomTechnicien,$PrenomT,$login,$mdp,$adresse,$CP,$Ville,'".$Statut."')
					";
					
				
		
		$res = $pdo -> exec($insert);

		if($res == 1)
		{
		
			$reussi = true;
		
		}
	}
	
	return $reussi;
	
	
}

/**************** Fonction Nombre Utilisateur (Technicien) **************/
function NbrTechnicien()
{

	$pdo = connexion();
	
	if($pdo != false)
	{
	$req = "
			Select count(id)
				from utilisateurs
				
			
					";
					
			$result =  $pdo->query($req)->fetch();
	}
	 
	 
	
	 
	 return $result = $result['0'];
	 

}

/************** Fonction Modification de la Categorie **************/
function modifierTechnicien($id,$Nom,$Prenom,$login,$mdp,$adresse,$cp,$ville,$statut)
{
	
	$pdo = connexion();
	
	if($pdo != false)
	{
	
	
	
	$req = "
			UPDATE utilisateurs SET		nom =  '".$Nom."' ,
									prenom =  '".$Prenom."' ,
									login =  '".$login."' ,
									mdp =  '".$mdp."' ,
									adresse =  '".$adresse."' ,
									cp =  '".$cp."' ,
									
									ville =  '".$ville."' ,
									statut =  '".$statut."' 
				where id= $id
					";
					
			$result =  $pdo -> exec($req);
	}
	
	
	return $result;
}

/************** Fonction Ajout Rappel Technicien **************/
function AjoutRappelTechni($IdActions,$idTechni,$idType,$commentaire)
{

	$reussi = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{
		
		$idTechni = $pdo -> quote($idTechni);
		$idType = $pdo -> quote($idType);
		 $commentaire = $pdo -> quote($commentaire);
	$date = date("Y-m-d");	
	$heure =date("H");
	$minute = date("i");
		
		$insert = "
					INSERT INTO relancetechnicien
					VALUES (null,$IdActions,'".$date."' ,'".$heure."' ,'".$minute."' ,$idTechni,$idType,$commentaire) 
					";
					
					
		
		$res = $pdo -> exec($insert);

		if($res == 1)
		{
		
			$reussi = true;
		
		}
	}
	
	return $reussi;
}
/************** Fonction de suppression d'un Rappel Technicien **************/
function supprimerRelanceTechnicien($id)
{

	$reussi = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{
	
		$id = $pdo -> quote($id);
		
		
		
		$req = "
					DELETE FROM relancetechnicien
					WHERE IdRelanceTechni = $id
					
				";
		
		$res = $pdo -> exec($req);
		
		if($res == 1)
		{
		
			$reussi = true;
		
		}
		
	}

	return $reussi;

}

	/**************  Fcontion de liste des RappelsTechniciens **************/
function ListeRappelTechnicien($id)
{
// var_dump($id);

	$pdo = connexion();
	
	if($pdo != false)
	{
	$req = "
			Select *
				from relancetechnicien
				where IdActions = $id
				";

			$result =  $pdo->query($req)->fetchAll();
	
	}
	 return $result;
	 

}
/**************  Fcontion de liste des Relance Client **************/
function ListeRelanceClient($id)
{

	$pdo = connexion();
	
	if($pdo != false)
	{
	$req = "
			Select *
				from relanceclient
				 where IdActions = $id
				";
							
					
					
			$result =  $pdo->query($req)->fetchAll();
	}
	 
	 
	
	 
	 return $result;
	 

}
/************** Fonction Ajout Rappel Client **************/
function AjoutRappelClient($IdActions,$idType,$commentaire)
{

	$reussi = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{
		
		$idTechni = $pdo -> quote($idTechni);
		$idType = $pdo -> quote($idType);
		 $commentaire = $pdo -> quote($commentaire);
	$date = date("Y-m-d");	
	$heure =date("H");
	$minute = date("i");
		
		$insert = "
					INSERT INTO relanceclient
					VALUES (null,$IdActions,'".$date."' ,'".$heure."' ,'".$minute."' ,$idType,$commentaire) 
					";
					
					
		
		$res = $pdo -> exec($insert);

		if($res == 1)
		{
		
			$reussi = true;
		
		}
	}
	
	return $reussi;
}
/************** Fonction de suppression d'un Rappel Client **************/
function supprimerRelanceClient($id)
{

	$reussi = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{
	
		$id = $pdo -> quote($id);
		
		
		
		$req = "
					DELETE FROM relanceclient
					WHERE IdRelanceTechni = $id
					
				";
		
		$res = $pdo -> exec($req);
		
		if($res == 1)
		{
		
			$reussi = true;
		
		}
		
	}

	return $reussi;

}
/************** Fonction de liste de etat prochaine action **************/
function ListeEtatProchaineAction()
{
	$result = false;
	
	$pdo = connexion();
	
	
	
	if($pdo != false)
	{
		
		$listeEPA = "
						SELECT *
						FROM etatprochaineaction
						
						
					";
		
		$result = $pdo -> query($listeEPA)->fetchall();
		
	}

	return $result;
		
}

/************** Fonction Modification de Etat Prochaine Action **************/
function modifierEPA($id,$CodeEPA,$LibelleEPA)
{
	
	$pdo = connexion();
	
	if($pdo != false)
	{
	
	$NewLibelleEPA = str_replace("'","\'",$LibelleEPA);
	$NewCodeEPA = str_replace("'","\'",$CodeEPA);
	$req = "
			UPDATE etatprochaineaction SET CodeEPA =  '".$NewCodeEPA."' , LibelleEPA =  '".$NewLibelleEPA."' where IdEtatProchaineAction = 	 $id";
					
			$result =  $pdo -> exec($req);
	}
	
	
	return $result;
}

/************** Fonction Ajout Etat Prochaine Action **************/
function creeEPA($CodeEPA,$LibelleEPA)
{

	$reussi = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{
		
		$CodeEPA = $pdo -> quote($CodeEPA);
		$LibelleEPA = $pdo -> quote($LibelleEPA);
		 
	
		
		$insert = "
					INSERT INTO etatprochaineaction
					VALUES (null,$CodeEPA,$LibelleEPA)
					";
					
					
		
		$res = $pdo -> exec($insert);

		if($res == 1)
		{
		
			$reussi = true;
		
		}
	}
}
/************** Fonction de suppression d'un EPA **************/
function supprimerEPA($id)
{

	$reussi = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{
	
		$id = $pdo -> quote($id);
		
		
		
		$req = "
					DELETE FROM etatprochaineaction
					WHERE IdEtatProchaineAction = $id
					
				";
		
		$res = $pdo -> exec($req);
		
		if($res == 1)
		{
		
			$reussi = true;
		
		}
		
	}

	return $reussi;

}

/************** Fonction de Recherche Adresse **************/
function rechercheNomSociete($rechercher)
{

	$modif = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{
			
		$req = "	select id,NomSociete,Adresse,CodePostal,Ville,idUtilisateurs,Telephone from fichesociete where NomSociete like '%$rechercher%'
					
					
				";
		
		$res = $pdo -> query($req)->fetchall();
		
		
		
	}

	return $res;
}
/************** Fonction de Recherche par EPA **************/
function rechercheparEPA($rechercher)
{
	$modif = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{

		$req = "	select * from actions where IdEtatPA = $rechercher";
		
		$res = $pdo -> query($req)->fetchall();
	}

	return $res;
}

/************** Fonction de Recherche Telephone **************/
function rechercheTelephone($rechercher)
{

	$modif = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{
	

		
		$req = "	SELECT id, NomSociete, Adresse, Telephone, TelMobileI, NomI, PrenomI,IdInterlocuteur
					FROM interlocuteur
					INNER JOIN fichesociete ON interlocuteur.IdFicheSociete = fichesociete.id
					
					WHERE Telephone LIKE  '%$rechercher%'
					OR TelMobileI LIKE  '%$rechercher%'
					order by NomSociete
					
					
				";
	
		$res = $pdo -> query($req)->fetchall();
		
	}

	return $res;
}
/************** Fonction de Recherche Motifs **************/
function rechercheMotifs($rechercher,$IdFicheSociete)
{

	$modif = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{
	

		
		$req = " SELECT IdNumSerie, NumeroSerie, IdActions, M.IdMotifs
				FROM numeroserie N, Motifs M
				WHERE N.IdMotifs = $rechercher
				AND N.IdMotifs = M.IdMotifs
				";
		
		$res = $pdo -> query($req)->fetchall();
		
		
		
	}

	return $res;
}
/************** Fonction de Recherche NumSerie **************/
function rechercheNumS($rechercher)
{

	$modif = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{
	

		
		$req = " SELECT *
				FROM numeroserie
				WHERE NumeroSerie like '%$rechercher%'				
				";
	
		$res = $pdo -> query($req)->fetchall();
	
		
		
	}

	return $res;
}

/************** Fonction d'obention de liste interlocuteur **************/
function ListeInterlocuteur($id)
{

	$result = false;
	
	$pdo = connexion();
	
	
	
	if($pdo != false)
	{
		
		$listeFiche = "
						SELECT *
						FROM interlocuteur
						where IdFicheSociete = '".$id."'
						
					";
					

		$result = $pdo -> query($listeFiche)->fetchall();
		
	}

	return $result;
		
}
function ListeTotalDesInterlocuteur()
{

	$result = false;
	
	$pdo = connexion();
	
	
	
	if($pdo != false)
	{
		
		$listeFiche = "
						SELECT *
						FROM interlocuteur
						order by NomI ASC
					";
					
		$result = $pdo -> query($listeFiche)->fetchall();
		
	}

	return $result;
		
}
function ListeTotalDesInterlocuteurparSociete()
{

	$result = false;
	
	$pdo = connexion();
	
	
	
	if($pdo != false)
	{
		
		$listeFiche = "
						SELECT IdInterlocuteur,IdFicheSociete,NomI,PrenomI,TelMobileI,emailI,NomSociete
						FROM interlocuteur I,fichesociete F
						where I.IdFicheSociete = F.id
						order by NomSociete ASC,IdFicheSociete ASC
					";
					 

		$result = $pdo -> query($listeFiche)->fetchall();
		
	}

	return $result;
		
}

/**************** Fonction Nombre Interlocuteur **************/
function NbrInter($id)
{

	$pdo = connexion();
	
	if($pdo != false)
	{
	$req = "
			Select count(IdInterlocuteur)
				from interlocuteur
				where IdFicheSociete = $id
				
			
					";
					
			$result =  $pdo->query($req)->fetch();
	}
	 
	 return $result = $result['0'];
}

/************** Fonction de suppression d'un Interlocuteur **************/
function supprimerI($id)
{

	$reussi = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{
	
		$id = $pdo -> quote($id);
		
		
		
		$req = "
					DELETE FROM interlocuteur
					WHERE IdInterlocuteur = $id
					
				";

		$res = $pdo -> exec($req);
		
		if($res == 1)
		{
		
			$reussi = true;
		
		}
		
	}

	return $reussi;

}

/************** Fonction de création d'un Type **************/
function creeInterlocuteur($Societe,$Nom,$Prenom,$tel,$email)
{

	$reussi = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{

		$insert = "
					INSERT INTO interlocuteur
					VALUES (null,$Societe,'".$Nom."','".$Prenom."','".$tel."','".$email."')
					";
			
		$res = $pdo -> exec($insert);

		if($res == 1)
		{
		
			$reussi = true;
		
		}
	}
	
	return $reussi;


}
/************** Fonction Modification d'un interlocuteur **************/
function modifierInterlocuteur($id,$Societe,$Nom,$Prenom,$tel,$email)
{
	
	$pdo = connexion();
	
	if($pdo != false)
	{
	
	
	$req = "
			UPDATE interlocuteur SET		NomI =  '".$Nom."' ,
									PrenomI =  '".$Prenom."' ,
									TelMobileI =  '".$tel."' ,
									emailI =  '".$email."',
									IdFicheSociete = $Societe
									where IdInterlocuteur= $id
									";
					
			$result =  $pdo -> exec($req);
	}
	
	
	return $result;
}

/************** Fonction de création d'une Prochaine Action **************/
function creePA($idAction,$date,$IdTechni,$IdEPA,$IdTypeDemande,$NumPA,$DebHPA,$DebMPA,$FinHPA,$FinMPA,$ObjetPA,$DescriptionPA,$SolutionPA)
{

	$reussi = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{
if($IdEPA == null)
{
 $IdEPA = "null";
}

		$insert = "
					INSERT INTO prochaineactions
					VALUES (null,$idAction,'".$date."',$IdTechni,$IdEPA,$IdTypeDemande,'".$NumPA."','".$DebHPA."','".$DebMPA."','".$FinHPA."','".$FinMPA."','".$ObjetPA."','".$DescriptionPA."','".$SolutionPA."')
					
					";
			
		$res = $pdo -> exec($insert);

		if($res == 1)
		{
		
			$reussi = true;
		
		}
	}
	
	return $reussi;


}

/************** Fonction Modification de l'action **************/
function modifierAction($id,$NouveauNumero,$DateDeb,$HeureDeb ,$MinuteDeb ,$DureeEnJour,$TempsAction ,$DateFin ,$HeureFin,$MinuteFin,
$SelectTechnicien ,$SelectType ,$SelectCategorie,$SelectInterocuteur,$ContenuTextDescription,$ContenuTextSolution,$ListeMotifs,$ListeEPAOngletDescription)
{
	
	$pdo = connexion();
	
	if($pdo != false)
	{
	
	
	if(!($ListeEPAOngletDescription != ''))
	{
		$ListeEPAOngletDescription = null;
	}
	
	
$etat = "EC";
		if($DateFin != "")
		{
		$etat = "CL";
		}
	$ContenuTextDescription = str_replace("<p>","",$ContenuTextDescription);
	$ContenuTextDescription = str_replace("</p>","",$ContenuTextDescription);
	$ContenuTextSolution = str_replace("<p>","",$ContenuTextSolution);
	$ContenuTextSolution = str_replace("</p>","",$ContenuTextSolution);
		$ContenuTextDescription = str_replace("'","\'",$ContenuTextDescription);
	$ContenuTextDescription = str_replace('"','\"',$ContenuTextDescription);
	$ContenuTextSolution = str_replace('"','\"',$ContenuTextSolution);
	$ContenuTextSolution = str_replace("'","\'",$ContenuTextSolution);
		
	
		
		
		$DF ="'$DateFin'";
		
	if($DF == "''")
	{
	$DF ="null";
	
	
	}
	if($HeureFin == "")
	{
	$HeureFin =" null";

	}
	if($MinuteFin == "")
	{
	$MinuteFin = "null";

	}
	if($ListeMotifs == null)
	{
	$ListeMotifs = "null";
	}
	if($SelectCategorie == "")
	{
	$SelectCategorie = "null";
	}
	if($ListeEPAOngletDescription == "")
	{
	$ListeEPAOngletDescription = "null";
	}
	
	
$req = "UPDATE actions SET	NumAction ='".$NouveauNumero."',
DateDeb='".$DateDeb."',
HeureDeb= '".$HeureDeb."',
MinuteDeb='".$MinuteDeb."',
DureeActionJour='".$DureeEnJour."',
DureeAction='".$TempsAction."',
DateFin='".$DateFin."',
HeureFin='".$HeureFin."',
MinuteFin='".$MinuteFin."',
Etat = '".$etat."',
IdTechnicien='".$SelectTechnicien."',
IdType='".$SelectType."',

IdCategorie=$SelectCategorie,
IdInterlocuteur=$SelectInterocuteur,
IdMotifs=$ListeMotifs,
IdEtatPA=$ListeEPAOngletDescription,
DescriptionAction='".$ContenuTextDescription."',
SolutionAction='".$ContenuTextSolution."'
where idActions=$id
					";
					
			$result =  $pdo -> exec($req);
	}
	
	
	return $result;
}

/************** Fonction Contenu de l'action **************/
function ContenuAction($id)
{

	$pdo = connexion();
	
	if($pdo != false)
	{
	$req = "
			Select *
				from actions
				where IdActions = $id";
					
			$result =  $pdo->query($req)->fetchall();
	}
	 
	 return $result;
	

}
/************** Fonction de suppression d'une Action **************/
function supprimerAction($id)
{

	$reussi = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{
	
		$id = $pdo -> quote($id);
		
		
		
		$req = "
					DELETE FROM actions
					WHERE idActions = $id
					
				";
		
		$res = $pdo -> exec($req);
		
		if($res == 1)
		{
		
			$reussi = true;
		
		}
		
	}

	return $reussi;

}


/************** Fonction de suppression d'un Motifs **************/
function supprimerMotifs($id)
{

	$reussi = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{
	
		$id = $pdo -> quote($id);
		
		
		
		$req = "
					DELETE FROM motifs
					WHERE IdMotifs = $id
					
				";
		
		$res = $pdo -> exec($req);
		
		if($res == 1)
		{
		
			$reussi = true;
		
		}
		
	}

	return $reussi;

}

/************** Fonction de ajout d'un Motifs **************/
function creeMotifs($LibelleMotifs)
{

	$reussi = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{
	
		
		
		
		
		$req = "
					insert into motifs values (null,'".$LibelleMotifs."')
					
					
				";
		
		$res = $pdo -> exec($req);
		
		if($res == 1)
		{
		
			$reussi = true;
		
		}
		
	}

	return $reussi;

}



function modifierMotifs($IdMotifs,$Lbl)
{

	$reussi = false;
	
	$pdo = connexion();
	
	if($pdo != false)
	{
	
		
		
		
		
		$req = "
					update motifs set LibelleMotifs = '".$Lbl."' where IdMotifs = $IdMotifs
					
					
				";
		
		$res = $pdo -> exec($req);
		
		if($res == 1)
		{
		
			$reussi = true;
		
		}
		
	}

	return $reussi;

}

/************** Fonction d'obention de liste Numero de serie Logiciel **************/
function ListeNumeroSerie($id)
{

	$result = false;
	
	$pdo = connexion();
	
	
	
	if($pdo != false)
	{
		
		$listeFiche = "
						SELECT *
						FROM numeroserie
						where IdActions = $id
						and TypeNumSerie = 0";
					 

		$result = $pdo -> query($listeFiche)->fetchall();
		
	}

	return $result;
		
}
/************** Fonction d'obention de liste Numero de serie Materiel **************/
function ListeNumeroSerieMateriel($id)
{

	$result = false;
	
	$pdo = connexion();
	
	
	
	if($pdo != false)
	{
		
		$listeFiche = "
						SELECT *
						FROM numeroserie
						where IdActions = $id
						and TypeNumSerie = 1";
					

		$result = $pdo -> query($listeFiche)->fetchall();
		
	}

	return $result;
		
}

/************** Fonction d'obention de liste Numero de serie Materiel **************/
function DateTemp()
{

	$result = false;
	
	$pdo = connexion();
	
	
	
	if($pdo != false)
	{
		
		$listeFiche = "
						SELECT DateDeb
						FROM tempdate
						LIMIT 0 , 347
						";
				

		$result = $pdo -> query($listeFiche)->fetchall();
		
	}

	return $result;
		
}
/************** Fonction d'obention de liste Numero de serie Materiel **************/
function DateTempFin()
{

	$result = false;
	
	$pdo = connexion();
	
	
	
	if($pdo != false)
	{
		
		$listeFiche = "
						SELECT DateFin
						FROM tempdate
						LIMIT 347 , 694
						";
				

		$result = $pdo -> query($listeFiche)->fetchall();
		
	}

	return $result;
		
}

	/**************  Fcontion de liste des Types **************/
function ListeSujet()
{

	$pdo = connexion();
	
	if($pdo != false)
	{
	$req = "
			Select *
				from sujetbaseconnaissance";
					
			$result =  $pdo->query($req)->fetchall();
	}

	 return $result;

}

/************** Fonction de recuperation consulter les actions selon une période **************/
function recupererActionsPeriodeDefaultCL()
{
$pdo = connexion();
	
	if($pdo != false)
	{
	$dateJourTest = date("N");
	$cpt = 0;
	for($i = $dateJourTest; $i != 1; $i--)
	{
		$cpt++;
	}	
	$dateFin = $cpt;
	$dateFin += 2;
	$dateFin = date("d") - $dateFin;
	
	$cpt= $cpt + 7;
	
		$date= date_create(date("Y-m-d"));
		date_sub($date,date_interval_create_from_date_string($cpt." days"));
	
	
	$req = "
			SELECT A.idFiche, A.IdActions,A.Etat, A.NumAction, A.DateDeb, A.HeureDeb, A.MinuteDeb, A.HeureFin, A.MinuteFin, I.NomI, I.PrenomI
			FROM actions A, interlocuteur I
			WHERE I.IdInterlocuteur = A.IdInterlocuteur
			and  A.DateDeb BETWEEN '".date_format($date,"Y-m-d")."' and '".date("Y-m-").$dateFin."'
			
			order by A.Etat asc,A.DateDeb asc, A.HeureDeb asc,A.MinuteDeb asc
			";
			
			$result =  $pdo -> query($req)->fetchall();
	}
	return $result;

}
/************** Fonction de recuperation consulter les actions selon une période **************/
function recupererActionsPeriodeDefaultEC()
{
$pdo = connexion();
	
	if($pdo != false)
	{

	$req = "
			SELECT A.IdActions,A.Etat, A.NumAction, A.DateDeb, A.HeureDeb, A.MinuteDeb, A.HeureFin, A.MinuteFin, I.NomI, I.PrenomI, I.IdFicheSociete
			FROM actions A, interlocuteur I
			WHERE I.IdInterlocuteur = A.IdInterlocuteur
			and A.Etat = 'EC'
			order by A.Etat asc,A.DateDeb asc, A.HeureDeb asc,A.MinuteDeb asc
			";
			
			$result =  $pdo -> query($req)->fetchall();
	}
	return $result;

}

/************** Fonction de recuperation consulter les actions selon une période **************/
function recupererActionsPeriode($debut,$fin)
{
$pdo = connexion();
	
	if($pdo != false)
	{
		
		
	$req = "
			SELECT A.IdActions,A.Etat, A.NumAction, A.DateDeb, A.HeureDeb, A.MinuteDeb, A.HeureFin, A.MinuteFin, I.NomI, I.PrenomI
			FROM actions A, interlocuteur I
			WHERE I.IdInterlocuteur = A.IdInterlocuteur
			and  A.DateDeb BETWEEN '".$debut."' and '".$fin."'
			order by A.Etat asc,A.DateDeb, A.IdActions asc
			";
			
			$result =  $pdo -> query($req)->fetchall();
	}
	return $result;

}

/************** Fonction de recuperation consulter les actions selon une période **************/
function recupererActionsPeriodeTableau($DateDeb,$DateFin)
{
$pdo = connexion();
	
	if($pdo != false)
	{
 $dateJourTest = date("N");
	$cpt = 0;
	for($i = $dateJourTest; $i != 1; $i--)
	{
		$cpt++;
	}	
	$dateFin = $cpt;
	$dateFin += 2;
	$dateFin = date("d") - $dateFin;
	
	$cpt= $cpt + 7;
	
		$date= date_create(date("Y-m-d"));
		date_sub($date,date_interval_create_from_date_string($cpt." days"));

	$req = "
			SELECT A.IdActions,A.Etat, A.NumAction, A.DateDeb, A.HeureDeb, A.MinuteDeb, A.HeureFin, A.MinuteFin,A.DureeAction, A.DescriptionAction, A.SolutionAction,
			I.NomI, I.PrenomI,I.TelMobileI ,I.IdInterlocuteur, F.id, F.NomSociete
			FROM actions A, interlocuteur I, fichesociete F
			WHERE I.IdInterlocuteur = A.IdInterlocuteur
			and I.IdFicheSociete = F.id
			and  A.DateDeb BETWEEN '".$DateDeb."' and '".$DateFin."'
			order by A.Etat asc,A.DateDeb asc, A.HeureDeb asc,A.MinuteDeb asc
			";
		
			$result =  $pdo -> query($req)->fetchall();
	}
	return $result;

}
/************** Fonction de recuperation consulter les actions selon une période **************/
function recupererNbrActionsPeriodeTableau($DateDeb,$DateFin)
{
$pdo = connexion();
	
	if($pdo != false)
	{
		 $dateJourTest = date("N");
	$cpt = 0;
	for($i = $dateJourTest; $i != 1; $i--)
	{
		$cpt++;
	}	
	$dateFin = $cpt;
	$dateFin += 2;
	$dateFin = date("d") - $dateFin;
	
	$cpt= $cpt + 7;
	
		$date= date_create(date("Y-m-d"));
		date_sub($date,date_interval_create_from_date_string($cpt." days"));
		
	$req = "
			SELECT count(A.IdActions),A.DateDeb
			FROM actions A, interlocuteur I, fichesociete F
			WHERE I.IdInterlocuteur = A.IdInterlocuteur
			and I.IdFicheSociete = F.id
			and  A.DateDeb BETWEEN '".$DateDeb."' and '".$DateFin."'
			order by A.Etat asc,A.DateDeb asc, A.HeureDeb asc,A.MinuteDeb asc
			";
			
			$result =  $pdo -> query($req)->fetch();
			}
		
				return $result;

}


/************** Fonction d'ajout du contenu de l'action dans le fichier "file.csv" **************/
function ajouterdansCSV($idAction)
{
$pdo = connexion();

	if($pdo != false)
	{
		$req="SELECT A.IdActions,A.Etat, A.NumAction, A.DateDeb, A.HeureDeb, A.MinuteDeb, A.HeureFin, A.MinuteFin,A.DureeAction, A.DescriptionAction, A.SolutionAction,
			I.NomI, I.PrenomI,I.TelMobileI ,I.IdInterlocuteur, F.id, F.NomSociete
			FROM actions A, interlocuteur I, fichesociete F
			WHERE I.IdInterlocuteur = A.IdInterlocuteur
			and I.IdFicheSociete = F.id
			and idActions = $idAction";
		
		$res = $pdo -> query($req)->fetchall(); 
			//var_dump($res);
			$list = $res;
			
			$fp = fopen('file.csv', 'a');
			
				for($h = 0; $h < count($list) ; $h++){
				$NouveauTableau = array();
				$max = count($list[$h])/2;
				
				for($CompteurLigne = 0; $CompteurLigne < $max; $CompteurLigne++ )
					$NouveauTableau[$CompteurLigne] = $list[$h][$CompteurLigne];
			
					fputcsv($fp, $NouveauTableau, '*');
				
			}

			
			
			fclose($fp);
			
	}

}
