<?php



	//Démarrage des sessions
	session_start();
	
	//inclusion du header
	include '../html/Header.html';
	
	//inclusion de la page de fonction php
	require_once('_function.php');
	//Supprime les actions qui n'ont pas de Etat Valide
	$pdo=connexion();
	if($pdo != null)
	{
			$req="Delete from actions where EtatValide <> 1";
	$pdo->exec($req);		
	}
	//Recupere la liste des EtatProchaineAction
	$ListeEPA = ListeEtatProchaineAction();
	
	//Vérification de l'authentification
	verificationAuthentification();
	// var_dump(listeFiche($_SESSION['id']));exit;
	$rechercheTelephone = false;
	$adr="";
	//Détermination du menu pour l'utilisateur
	menu($_SESSION["statut"]);
	if($_SESSION["statut"] == "Administrateur")
	{
	
//Si on click sur le boutton supprimer
	if(isset($_POST['supprimerFiche']))
	{
	$id = $_REQUEST['supprimerFiche'];
	$reussi = supprimerFiche($id);
	
	}
	//Si on click sur le bouton ajouter
	if(isset($_POST['AjouterAction']))
	{

	$id = $_REQUEST['AjouterAction'];
	
	$PremierIdType = recupererPremierIdType();
	$PremierIdCategorie = recupererPremierIdCategorie();
	
	
	$NumAction = recupererDernierIdActions()+1;
	
		//création d'une action
	$res = creeActions($NumAction,$id,$_SESSION["id"],$PremierIdType,$PremierIdCategorie);
	
		

		if($res = false):
		$message='Erreur fiche non ajouter';

	echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
		endif;
		if($res = true):
		$message='Vous avez ajouter une action';

	echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
		endif;
	
	header("Location: AjouterAction.php?id=".$id."&IdInter=");
	}
	
	if(isset($_POST['ModifierFiche']))
	{
	$fiche = listeFiche($_SESSION['id']);
	
	if($fiche != false):
	foreach($fiche as $f):
	if( $f['id'] == $_POST['ModifierFiche']){
	$reussi = modifierFiche($f['id'],$_REQUEST['NomSociete'.$f['id']],$_REQUEST['Adresse'.$f['id']],$_REQUEST['CodePostal'.$f['id']],$_REQUEST['Ville'.$f['id']],$_SESSION['id'],$_REQUEST['Telephone'.$f['id']]);
	}
	endforeach;
	endif;	
	
	}
	if(isset($_POST['ConsulterAction']))
	{
	$id = $_REQUEST['ConsulterAction'];
	header("Location: ConsulterAction.php?id=$id");
	}
	
	
	if(isset($_POST['BoutonShearchAdresse']))
	{ $rechercher =htmlentities( $_POST['rechercheAdresse']);
	
	header("Location: RechercheFicheSociete.php?search=$rechercher");
	

	}	
	
	
	if(isset($_POST['BoutonRechercheNomSociete']))
	{
		
	$NomSociete = $_POST['SelectionSociete'];

	header("Location: ConsulterAction.php?id=$NomSociete");
	}
	
	if(isset($_POST['BoutonRechercheEPA']))
	{
		
	$rechercher =htmlentities( $_POST['SelectionEPA']);
	
	

	header("Location: RechercheFicheSociete.php?search=$rechercher&rechercherEPA=1");

	
	}
	
	if(isset($_POST['BoutonShearchTelephone']))
	{
		
	$rechercher =htmlentities( $_POST['rechercheTelephone']);
	
	
	
	header("Location: RechercheFicheSociete.php?search=$rechercher");
	}
	
	
	if(isset($_POST['RechercheReference']))
	{
		
	$idFiche = $_POST['RechercheReference'];
	
	

	header("Location: RechercherActionParReference.php?idFicheSociete=$idFiche");
	}
	
	$fiche = listeFicheparOC($_SESSION['id']);
	$TotalRelanceClient= RecupererRelanceClient();

	$TotalRelanceTechni = RecupererRelanceTechni();
	
	
	if(isset($_POST['BouttonRechercheTechni']))
	{
		
	$idRechercheTechni = $_POST['RelanceTechnicien'];
	$idFiche = RecupererIdFicheEnFonctionIdAction($idRechercheTechni);

	$idFiche = $idFiche[0];

	header("Location: 2.php?idaction=$idRechercheTechni&id=$idFiche");

	
	}
	
	
		if(isset($_POST['BouttonRechercheClient']))
	{
		
	$idRechercheClient = $_POST['RelanceClient'];
	
	$idFiche = RecupererIdFicheEnFonctionIdAction($idRechercheClient);
	$idFiche = $idFiche[0];
	header("Location: 2.php?idaction=$idRechercheClient&id=$idFiche");

	}
?>

<div class="contenu" >
	<!-- lien vers le haut de page -->
<!-- les liens vers les ancres sont toujours précédés du symbole # -->
<div id="hautpage"> </div>


	<h2>
	Login : <?php echo $_SESSION["user"];  //var_dump( $_SESSION);?>
		</br>
		<?php  ?>
		<h2 align="center">
		Consulter les fiches et les actions d'une société selectionnée
		</h2>
	</h2>
	</br>

	<form method="POST" action="">
	
	<table class="ficheCourante">
	<th style="width:250px;">   </th>
	<th>
	
		<div id="zone_recherche">
			<p> NomSociete  : </p>
			<input id="texte_recherche"  name="rechercheAdresse" type="text" value="<?php //echo $ValueAdr;?>" />
			<input  name="BoutonShearchAdresse" class="bouton_recherche" type="submit"  alt="Rechercher" value="1"/>
		</div>
	</th>
	<th>   </th>
	<th>   </th> 
	<th>
		<div id="zone_recherche" class="RechercheTele" margin-left="500">
			<p> Telephone : </p> 
			<input id="texte_recherche" name="rechercheTelephone" type="text" value="" />
			<input name="BoutonShearchTelephone" class="bouton_recherche" type="submit"  alt="Rechercher" value="2"/>
		
		</div>
	</th>
	</br></br></br></br>
	</table>
	<table class="ficheCourante">
	<tr>
						
					<th></th><th></th><th></th>
					
					
					</tr>
	</table>
</form>
</br></br></br>
<form method="POST">
	<table class="ficheCourante" >
	<tr >
	<td></td>
	<td >
	<?php if(count($TotalRelanceTechni) > 0): ?>
	<span style="margin-left: 45px;"> Rappel Technicien : </span>
	<?php endif;?>
	</td>
	
	<td>
		<?php if(count($TotalRelanceClient) > 0): ?>
		<span style="margin-left: -45px;"> Rappel Client : </span>
	
		<?php endif;?>
	</td>
	</tr>
	<tr>
	<td></td>
	<td>
	<?php if(count($TotalRelanceTechni) > 0): ?>
	<table class="ficheCourante" >
	
	
	<td>
		<select name="RelanceTechnicien" style="margin-left: 80px;" >
						<?php 
						
						for ($i = 0; $i < count($TotalRelanceTechni); $i++) {
								
											
					?>
					  <option value="<?php  echo $TotalRelanceTechni[$i]['IdActions'];?>"><?php  echo $TotalRelanceTechni[$i]['DateRelanceTechni'];
																										echo ("   ");
																										echo $TotalRelanceTechni[$i]['HeureRelanceTechni'];
																										echo (":");
																										echo $TotalRelanceTechni[$i]['MinuteRelanceTechni'];
																										?></option>
					  <?php } ?>
					</select>  </td> 
					<td> <input type="image" src="../images/img_submit.gif" name="BouttonRechercheTechni" style="align: right;" alt="Submit" width="32" height="32" value="1"> </td>
					</table>
					<?php endif; ?>
					</td>
	
	<td>
	<?php if(count($TotalRelanceClient) > 0): ?>
	<table class="ficheCourante">
	<td>
		<select name="RelanceClient" style="margin-left: 80px;" >
						<?php 
						
						for ($i = 0; $i < count($TotalRelanceClient); $i++) {
								
											
					?>
					  <option value="<?php  echo $TotalRelanceClient[$i]['IdActions'];?>"><?php  echo $TotalRelanceClient[$i]['DateRelanceCli']; 
																																			echo("   ");
																									  echo $TotalRelanceClient[$i]['HeureRelanceCli'];
																																		echo(":");
																																		
																									  echo $TotalRelanceClient[$i]['MinuteRelanceCli']; ?></option>
					  <?php } ?>
					</select>  </td> 
					<td> <input type="image" src="../images/img_submit.gif" name="BouttonRechercheClient" style="align: right;" alt="Submit" width="32" height="32" value="2"> </td>
					</table>
					<?php endif; ?>
	</td>
	</tr>
	
	
	<tr class='espace'></tr><tr class='espace'></tr>
	<tr>

		<tr>
		<td>
		<span style="margin-left: 80px;"> Trier les fiches par ordre Alphabétique : <input type="checkbox" id="CheckBoxTrierFicheOrdreCroissant" /></span>
		</td>
		<td >
		<table class="ficheCourante">
	<td style="width: 240px;">
	<span style="margin-left: 0px;"> Trier les fiches par Nombre d'actions : </span>
		 </td> 
					<td>  <input type="checkbox" id="CheckBoxTrierParNbrActions" /> </td>
					</table>
		
		</td>
		
		<!--<a href="#"><div id="btntop" class='lien' ></div></a> 
	<a name="hautpage" id="hautpage"></a>-->
	<a href="#baspage"  ><img src="../images/flecheB.png" id="btndown"  /></a> 
	<a href="#hautpage"  ><img src="../images/flecheH.png" id="btntop"  /></a> 
		<td>
					<table class="ficheCourante">
					<tr>
					<td>
					Liste Societe :
					</td>
					</tr>
					<tr>
					
	<td>
		<select name="SelectionSociete" style="margin-left: 50px;" >
						<?php 
						
						for ($i = 0; $i < count($fiche); $i++) {
								
											
					?>
					  <option value="<?php  echo $fiche[$i]['id'];?>"><?php  echo $fiche[$i]['NomSociete']; ?></option>
					  <?php } ?>
					</select>  </td> 
					<td> <input name="BoutonRechercheNomSociete"  id="bouton_rechercheNS" type="submit"  alt="Rechercher" value=""/> </td>
					</tr>
					</table>
					
		</td>
		<td >
		<span style="margin-top:-10px ;"> Recherche par Etat prochaine actions :</span> </br>
		<span style="margin-right:175px;">
							<select name="SelectionEPA">
					<?php 
					
					for ($i = 0; $i < count($ListeEPA); $i++) {
							
										
				?>
				  <option value="<?php  echo $ListeEPA[$i][0];?>"><?php  echo $ListeEPA[$i][2]; ?></option>
				  <?php } ?>
				</select></span>
					<input name="BoutonRechercheEPA"  id="bouton_rechercheEPA" type="submit"  alt="Rechercher" value=""/>
		</td>
		</tr>
		</tr>
	</table>
</form><br><br>

<form method="POST" action="ConsulterFiche.php">


		<table class="ficheCourante">
				
			<thead class="thead">
		
				<tr>
						
					<th>
						Nom Societe
					</th>
					<th>
						Adresse	
					</th>
						
					<th>
						Code Postale
					</th>
					
					<th>
						Ville
					</th>
					<th>
						Telephone
					</th>
					
					<th>
						Supprimer
					</th>
					<th>
						Ajouter
					</th>
					<th>
						Rechercher par réference Produit
					</th>
					<th>
					Nombre Action
					</th>
					<th>
						Nombre fiche : <span id="NombreFiche"> <?php echo NombreFicheConsulter($_SESSION['id']); ?> </span>
					</th>
					<th>	
							Modifier La fiche
					</th>
				</tr>
			
			</thead>
			
			<tbody id="tBodyConsulterFiche">
			
<?php

include 'TableauConsulterFiche.php';
	
		
?>




		</tbody>
	</table>
	
</form>

<div id="baspage"> </div>
</div>





<?php include'../html/Footer.html'; ?>
<?php }
else
{
header("Location: accueil.php");
} ?>
