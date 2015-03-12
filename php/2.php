<?php

/**
 * Page montrant les précédentes fiches du visiteur
 * Il ne peut que visionner ses fiches
**/
	
	//Démarrage des sessions
	session_start();
	
	//inclusion du header
	include '../html/Header.html';
	
	
	
	//inclusion de la page de fonction php
	require_once('_function.php');
	
	//Vérification de l'authentification
	verificationAuthentification();
	
	//Obtention du menu en fonction du statut
	menu($_SESSION["statut"]);
	if($_SESSION["statut"] == "Administrateur")
	{
	

	$NomSociete = RecupererNomSociete($_GET['id']);
	
	//Recupere l'ID de l'action
	 $IdAction = $_GET['idaction'];
	if($IdAction == 0)
	{
	
	 	 $IdAction = 1;
	 }
	
	//Id de la prochaine action
	$IdProchaineA = $IdAction + 1;
	
	//Recupere la liste des Type de demande
	$ListeTypeDemande = ListeTypeDemande();
	
	
	//Recupere la liste des Techniciens
	$ListeTechnicien = ListeTechnicien();
	
		//Recupere la liste des Techniciens
	$ListeType = ListeType();
	
	
	//Recupere la liste des EtatProchaineAction
	$ListeEPA = ListeEtatProchaineAction();
	
	//Recupere la liste des rappels technicien
	$ListeRappelTechnicien = ListeRappelTechnicien($IdAction);
	
	//Recupere la liste des rappels Client
	$ListeRelanceClient = ListeRelanceClient($IdAction);
	
	//Recupere la liste des Categories
	$ListeCategorie = ListeCategorie();
	
	//Recupere la liste des Interlocuteur
	$ListeInterocuteur = ListeInterlocuteur($_GET['id']);
	// var_dump($ListeInterocuteur);
	
	//Recupere L'etat de l'action
	$Etataction = EtatAction($IdAction);
	
	//Recupere la liste des Sujet
	$ListeSujet = ListeSujet();
	
	
		//Si on click sur le boutton ajouterTechnicien
	if(isset($_POST['ajoutNouveauTechnicien']))
	{
	
	header("Location: AjouterSupprimerTechnicien.php");
	
	}
	
	//Si on click sur le boutton ajouterCAtegorie
	if(isset($_POST['ajoutNouveauCateg']))
	{
	
	header("Location: AjouterSupprimerCategorie.php");
	
	}
	
	//Si on click sur le boutton ajouterType
	if(isset($_POST['ajoutNouveauType']))
	{
	
	header("Location: AjouterSupprimerType.php");
	
	}
	//Si on click sur le boutton SupprimerRelanceTechni
	if(isset($_POST['SupprimerRelanceTechni']))
	{
	
	$id = $_POST['SupprimerRelanceTechni'];
	$reussi = supprimerRelanceTechnicien($id);
	$id = $_GET['id']; 
	header("Location: AjouterAction.php?id=$id");
	}
	
	if(isset($_POST['AjouterRelanceTechni']))
	 { 
	 
	 $idTechnicien = $_POST['ListeTechnicienRappelTecnicien'];
		$idType = $_POST['ListeTypeRappelTecnicien'];
		
		$Commentaire =  $_POST['CommentRappelTechni'];
		$id = $_GET['id']; 
		//Ajouter Rappel Technicien
		$res = AjoutRappelTechni($IdAction,$idTechnicien,$idType,$Commentaire);
		header("Location: AjouterAction.php?id=$id");
		
		
		// if($_POST['test'] != "")
		// {
		
		 
		// }
	
	}
	//Si on click sur le boutton ajouterTypeDemande
	if(isset($_POST['ajoutNouveauTypeDemande']))
	{
	
	header("Location: AjouterSupprimerTypeDemande.php");
	
	}
	
	
	if(isset($_POST['AnnulerAction']))
	{
		header("Location: ConsulterFiche.php");
		// header("Location: AjouterSupprimerInterlocuteur.php?id=".$id);
	}
	
	
	//Si on click sur le boutton SupprimerRelanceClient
	if(isset($_POST['SupprimerRelanceCli']))
	{
	
	$id = $_POST['SupprimerRelanceCli'];
	$reussi = supprimerRelanceTechnicien($id);
	$id = $_GET['id']; 
	header("Location: AjouterAction.php?id=$id");
	}
	
	if(isset($_POST['AjouterRelanceClient']))
	 { 
	 
	
		$idType = $_POST['ListeTypeRappelClient'];
		
		$Commentaire =  $_POST['CommentRappelClient'];
		$id = $_GET['id']; 
		//Ajouter Relance Client
		$res = AjoutRelanceClient($IdAction,$idType,$Commentaire);
		header("Location: AjouterAction.php?id=$id");
		
	
	}
	
	//Si on click sur le boutton AjouterNouvelleInterlocuteur
	if(isset($_POST['ajoutNouveauInterlocuteur']))
	{
	
	$id = $_POST['ajoutNouveauInterlocuteur'];
	header("Location: AjouterSupprimerInterlocuteur.php?id=".$id);
	}
	//Si on click sur le boutton AjouterProchaineAction
	if(isset($_POST['AjouterPA']))
	{
	
		
		$DatePA = $_POST['DateProchaineAction'];
		$IdListeTechni = $_POST['ListeTechniongletRappelAction'];
		$IdListeEPA = $_POST['ListeEPAongletRappelAction'];
		$IdListeTD = $_POST['ListeTypeDemandeongletRappelAction'];
		$NumPA = $_POST['NumProchaineAction'];
		$DebutHeurePA = $_POST['DebutHeurePA'];
		$DebutMinutePA = $_POST['DebutMinutePA'];
		$FinHeurePA = $_POST['FinHeurePA'];
		$FinMinutePA = $_POST['FinMinutePA'];
		$ObjetPA = $_POST['ObjetPA'];
		$DescriptionPA = $_POST['DescriptionPA'];
		$SolutionPA = $_POST['SolutionPA'];
	$res = creePA($IdAction,$DatePA,$IdListeTechni,$IdListeEPA,$IdListeTD,$NumPA,$DebutHeurePA,$DebutMinutePA,$FinHeurePA,$FinMinutePA,$ObjetPA,$DescriptionPA,$SolutionPA);
	}
	$idffiche = $_GET['id'];
	
	
	
	//Si on click sur le boutton AjouterProchaineAction
	if(isset($_POST['EnregisterAction']))
	{
	// var_dump($_POST['ContenuTextDescription']);
	// var_dump($_POST['SelectInterocuteur']);
	// var_dump(empty($_POST['ContenuTextDescription']));
	// var_dump(empty($_POST['SelectInterocuteur']));
	if(!empty($_POST['SelectInterocuteur']) == true && !empty($_POST['ContenuTextDescription']) == true )
	{
	
	// $NumAction = $_POST['NouveauNumero'];
	
	$id = $_GET['id']; //var_dump($_POST);
	
	
	// -------------- ContenuPremierTableau -------------- 
	$NouveauNumero = $_POST['NouveauNumero'];
	$DateDeb =  $_POST['DateDeb'];
	$HeureDeb =  $_POST['HeureDeb'];
	$MinuteDeb =  $_POST['MinuteDeb'];
	$DureeEnJour =  $_POST['DureeEnJour'];
	$TempsAction =  $_POST['TempsAction'];
	$DateFin =  $_POST['DateFin'];
	$HeureFin =  $_POST['HeureFin'];
	$MinuteFin =  $_POST['MinuteFin'];
	$SelectTechnicien =  $_POST['SelectTechnicien'];
	$SelectType =  $_POST['SelectType'];
	$SelectCategorie =  $_POST['SelectCategorie'];
	$SelectInterocuteur =  $_POST['SelectInterocuteur'];
	
	
	// -------------- ContenuPremierOnglet --------------
	$ListeEPAOngletDescription = $_POST['ListeEPAOngletDescription'];
	$ContenuTextDescription =  $_POST['ContenuTextDescription'];
	$ContenuTextSolution =  $_POST['ContenuTextSolution'];
	
	
		if(isset($_POST['ListeMotifs']))
	{	$ListeMotifs =  $_POST['ListeMotifs'];	}
	else
	{	$ListeMotifs = null;	}
						
		$SelectInterocuteur =  $_POST['SelectInterocuteur'];	
	
	
	
	
	modifierAction($IdAction,$NouveauNumero,$DateDeb,$HeureDeb ,$MinuteDeb ,$DureeEnJour,$TempsAction ,$DateFin ,$HeureFin,$MinuteFin,
	$SelectTechnicien ,$SelectType ,$SelectCategorie,$SelectInterocuteur,$ContenuTextDescription,$ContenuTextSolution,$ListeMotifs,$ListeEPAOngletDescription);
	$message='Vous avez modifier l\'action';

	echo '<script type="text/javascript">window.alert("'.$message.'");
	</script>';;
	
	header("Location: ConsulterFiche.php");
	}
	
		else
		{
		//Affiche erreur et reste sur la meme page
		echo('<p > Erreur: Verrifier que la description et l\'interlocuteur sont bien renseigner.<p>');
		
		}
	
		
	}
	
	
	
	 $Contenu = ContenuAction($_GET['idaction']);
	 // var_dump($Contenu);
	 $DureeA = $Contenu[0]['DureeActionJour'];
	 // var_dump($DureeA);
$HeureDeb = $Contenu[0]['HeureDeb'];
$MinuteDeb = $Contenu[0]['MinuteDeb'];	
$HeureFin = $Contenu[0]['HeureFin'];
$MinuteFin = $Contenu[0]['MinuteFin'];	
	
	// if($HeureDeb < 10)
	// {$HeureDeb = "0".$HeureDeb;}
	// if($MinuteDeb < 10)
	// {$MinuteDeb = "0".$MinuteDeb;}
	// if($HeureFin < 10)
	// {$HeureFin = "0".$HeureFin;}
	// if($MinuteFin < 10)
	// {$MinuteFin = "0".$MinuteFin;}
	
	
?>



<div class="contenu"  onload="recupValCloture()">
	<h2 align="center">
	Consulter et modifier une action
		 
	</h2>
	<h2>
	
		Login : <?php echo $_SESSION["user"]; ?></br>
		Societe : <?php echo $NomSociete; ?>
		
	</h2>
	<p align="left">	Fiche Numero : <span  id="FS"> <?php echo $_GET['id']; ?> </span> </p>
	<p align="left">	Action Numero : <span  id="IdAction"> <?php echo $IdAction; ?> </span> </p>
	<p align="left">	Id Interlocuteur : <span  id="IdInterlocu"> <?php  echo$Contenu[0]['IdInterlocuteur'];?> </span> </p>			
	<form method="POST" name="FormEnregistrer"><!--<form method="POST" name="FormEnregistrer">  action="AjouterAction.php?id=$id" -->
	
	<tr>
			<td>
			Valider : <input type="submit" class="ButVal" name="EnregisterAction"  value="<?php echo $_GET['id'];?>"/>
			</td>
			</br></br></br>
				<td>
			Annuler : <input type="submit" class="ButAnu"  name="AnnulerAction"  value=""/>
			</td>
			</tr>


		
		<br /><br />

		<table class="ficheCourante" align ="center">
				
			<thead class="thead">
				
				
							
				<tr>
						
					<th>
						
						Numero
						
					</th>
						
				
						
					<th>
						
						Date Debut
						
					</th>
						
					<th>
						Heure Debut
					</th>
					
					<th>
						Duree(jour)
					</th>
					
					<th>
						Temps
					</th>
					
					<th>
						Etat
					</th>
					
					
				</tr>
			
			</thead>
			
			
			
			
			

			<tbody>
			
				<tr>
				
					<td>
					
						<input type="text" id="Numero"  style="width: 220px;" name="NouveauNumero" class="modification" value="<?php echo $Contenu[0]['NumAction']; ?>" />
						
					
					</td>
					
					<td>
					
						<input type="date" value="<?php echo $Contenu[0]['DateDeb']; ?>" class="modification" name="DateDeb" style="width: 140px;" />
					
					</td>
					
					<td>
					
					<!--<p id="haha" onload="FunctionDate()"> </p>
					
					// <script>
						// function FunctionDate()
						// {
							// document.getElementById("haha").innerHTML = Date();
						// }
					 </script>-->
					
						<input type="number" min="0" max="23"  style="width:35px;" pattern="[0-9]{1,3}"  name="HeureDeb" value="<?php echo $HeureDeb; ?>"/> :
						<input type="number" min="0" max="59" style="width:35px;" pattern="[0-9]{1,3}"  name="MinuteDeb" value="<?php echo $MinuteDeb;  ?>"/>
					 
					</td>
					
				<td>
				
					<input type="number" id="CompteurJourModif" min="0"  pattern="[0-9]" style="width: 50px;" name="DureeEnJour" value="<?php echo $DureeA; ?>"/>
					
				</td>
				<td>
					
						<input id="CompteurModif" maxlength="12" type="text" value= "<?php echo $Contenu[0]['DureeAction']; ?>" style="width:75px;" name="TempsAction" class="modification" />
					
					</td>
					<td>
					
						<input type="checkbox" id ="ClotureModif" class="CheckBox" onclick="ChangerEtat()" name="ClotureAction" value="<?php $Contenu[0]['Etat']; ?>" <?php if($Contenu[0]['Etat'] == "CL"):?> checked <?php endif; ?>>Action Cloturer<br>
					
					</td>
					

				</tr>
			
			</tbody>
				<thead class="thead">
				
				
							
				<tr>
						
				
						
					<th>
						
						Date fin
						
					</th>
						
					<th>
						Heure fin
					</th>
					
					<th>
						Technicien
					</th>
					
					<th>
						Type
					</th>
					
					<th>
						Categorie
					</th>
					<th>
						
					</th>
					
					
				</tr>
			
			</thead>
			
			<tbody>
			
				<tr>
				
		
					
					<td>
					
						<input type="date" value="<?php  if (is_numeric($HeureFin)) {echo $Contenu[0]['DateFin'];} ?>" id="DateFin" class="modification" name="DateFin" style="width: 140px;" min="<?php echo date_format(date_sub(new DateTime(date('Y-m-d')), new DateInterval('P1Y')), 'Y-m-d'); ?>" />
					
					</td>
					
					<td>
			
						<input type="number" min="0" style="width:35px;" max="23" pattern="[0-9]{1,3}"  id="HeureFin" name="HeureFin" value="<?php if (is_numeric($HeureFin)) {echo $HeureFin;} ?>"/> :
						<input type="number" min="0" style="width:35px;" max="59" pattern="[0-9]{1,3}"  id="MinuteFin" name="MinuteFin" value="<?php if (is_numeric($MinuteFin)) {echo $MinuteFin;} ?>"/> 
					
					</td>
					
				<td>
				</br>
				<!--<input type="text" name="NouveauTechnicien" class="modification" />-->
	<select name="SelectTechnicien">
					<?php include 'ListeTechnicien.php'?>
  
</select>
					
					
					
				</td>
				<td>
					</br>
						<!--<input type="text" name="NouveauType" class="modification" />-->
						<select name="SelectType">
					<?php 
					
					for ($i = 0; $i < count($ListeType); $i++) {
							
										
				?>
				  <option value="<?php  echo $ListeType[$i][0];?>"  <?php if($ListeType[$i][0] == $Contenu[0]['IdType']):?> selected <?php endif;?>  ><?php  echo $ListeType[$i][1]; ?></option>
				  <?php } ?>
				</select>
						
					
					</td>
					<td>
					</br>
						<!--<input type="text" name="NouveauCategorie" class="modification" />-->
						<select name="SelectCategorie">
						<option value=""></option>
					<?php 
					
					for ($i = 0; $i < count($ListeCategorie); $i++) {
							
										
				?>
				  <option value="<?php  echo $ListeCategorie[$i][0];?>" <?php if($ListeCategorie[$i][0] == $Contenu[0]['IdCategorie']):?> selected <?php endif;?> ><?php  echo $ListeCategorie[$i][1]; ?></option>
				  <?php } ?>
				</select>
					
					</td>
					
				</tr>
			<tr class="espace"></tr>
			<tr>
			<td></td><td></td>
			<td>
			Interlocuteur :
			</td>
			<td>
			<select id="SelectInterlocuteur" name="SelectInterocuteur">
			
					<?php 
					
					for ($i = 0; $i < count($ListeInterocuteur); $i++) {
							
										
				?>
				  <option value="<?php  echo $ListeInterocuteur[$i][0];?>"  <?php   if($ListeInterocuteur[$i][0] == $Contenu[0]['IdInterlocuteur']): ?>  selected <?php endif;  ?> ><?php  echo $ListeInterocuteur[$i][2];echo "  ".$ListeInterocuteur[$i][3]; ?></option>
				  <?php } ?>
				</select>
				
			</td> 
			
			</tr>
			<tr class="espace"></tr>
				<table class="ficheCourante" align="center">
				
			<thead class="thead">
				
					
				<tr>
						
					<th>
						Nom
					</th>				
					<th>
						Prenom
					</th>
					<th>
						TelMobile
					</th>
					<th>
						Email
					</th>
					
					<th>
						Supprimer/Ajouter
					</th>
					<th>
						Modifier
					</th>
				
				</tr>
			
			</thead>
			
			<tbody>
			
<?php
$Inter = ListeInterlocuteur($_GET['id']);

// if($Inter != false):
// foreach($Inter as $i):


?>

			<tr id="Interlocuteur">
				<?php  if(count($ListeInterocuteur)> 0 ): ?>
				
				<td>
					<input class="modification" type="text" value="" name="NomI" id="nomInter" />
				</td>
				<td>
					<input class="modification" type="text" value="" name="PrenomI" id="prenomInter" />
				</td>
				<td>
					<input class="modification" type="text" value="" name="TelMobile" id="TelMobInter" />
				</td>
				<td>
					<input class="modification" type="text" value="" name="Email" id="emailInter" />
				</td>
				
				<td class="tdIcone">
				
					<img type="submit" name="supprimerI" style="float: none; border: none; height: 35px; width: 32px; box-shadow: none;" src="../images/supprimer.png" onclick="SupprimerInter()" value=''/>
				
				</td>
				
					<td>	
						<img value="" class="reporter" name="ModifierI">
					</td>
					<td >
						
					</td>
			</tr>

<?php

			// endforeach;
	
		endif;

?>
<thead class="thead">
		<th>
			Nom
		</th>
		<th>
			Prenom
		</th>
		<th>
			TelMobile
		</th>
		<th>
			Email
		</th>
		<th>
			Ajouter
		</th>
		<th>
			
		</th>
</thead>
<tr class="espace">
				<td>
				
					<input class="modification" id="NouveauNomI" type="text" value="" name="NouveauNomI" />
				
				</td>
				&nbsp
				<td>
				
					<input class="modification" type="text" value="" id="NouveauPrenomI" name="NouveauPrenomI" />
				
				</td>
				<td>
				
					<input class="modification" type="text" value=""id="NouveauTelMobile"  name="NouveauTelMobile" />
				
				</td>
				<td>
				
					<input class="modification" type="text" value=""  id="NouveauEmailI" name="NouveauEmailI" />
				
				</td>
				<td class="tdIcone">
				
					<img  name="AjouterInterlocuteur" id="ButAjouterInterlocuteur" style="float: none; border: none; height: 35px; width: 32px; box-shadow: none;" src="../images/ajouter.png" value='<?php echo $_GET['id']; ?>'/>
				
				</td>
				
				<td>
				</td>
				
				</tr>
				
		</tbody>
		
	</table>
			</tbody>
			<tfoot>
			
			<!--<input type="submit" name="ajoutNouvelleFiche" style="float: none; border: none; height: 35px; width: 32px; box-shadow: none;" src="../images/ajouter.png" /> -->
			</tfoot>
		</table>
		
		
	
	</br>
	</br>
<div class="systeme_onglets" id="systeme_onglets">
<div class="onglets">
<span class="onglet_0 onglet" id="onglet_descript" onclick="javascript:change_onglet('descript');">Description</span>
<span class="onglet_0 onglet" id="onglet_RappelRelances" onclick="javascript:change_onglet('RappelRelances');">Rappel Technicien</span>
<span class="onglet_0 onglet" id="onglet_RelanceClient" onclick="javascript:change_onglet('RelanceClient');">Relances client</span>
<span class="onglet_0 onglet" id="onglet_NumSerie" onclick="javascript:change_onglet('NumSerie');">Numero De Serie</span>
<span class="onglet_0 onglet" id="onglet_BaseDeConnaissance" onclick="javascript:change_onglet('BaseDeConnaissance');">Base De Connaissance </span>
</div>


<div class="contenu_onglets">
<div class="contenu_onglet" id="contenu_onglet_descript">
</br>
<h2>
Renseignement de l'action
</h2>

	<table class="RappelRelanceClient">
	
	<thead class="thead">
	<tr>
	
	
	
				<th>
				Etat prochaine Action
				</th>
				<th>
					<select name="ListeEPAOngletDescription">
					<option value="">
					<?php for ($i = 0; $i < count($ListeEPA); $i++){ ?>
																						
					  <option value="<?php  echo $ListeEPA[$i][0]; ?>"<?php if($ListeEPA[$i][0] == $Contenu[0]['IdEtatPA']){?> selected <?php }?> >
								
						  <?php echo " ".$ListeEPA[$i][2]; ?>
						  <?php } ?>
						  </option>
					</select>
	</th>
	</tr>
	<tr>
			<th>
				Descriptions
			</th>
			<th>
				Motifs
			</th>
			<th>
				Solutions
			</th>
	 </tr>
</thead>
<tbody>
		<td>
				<div class="description">
				<textarea class="Description"  id="ContenuTextDescription" style="resize: none;" name="ContenuTextDescription"><?php echo $Contenu[0]['DescriptionAction'];?></textarea>
				</div>
		</td>
		<td>
				<!-- Liste deroulante motif ! -->
				<div class="listeDeroulante">
				<select name="ListeMotifs" size="18" multiple="" id="" class="Text-10-GrisFonce padding" tabindex="62">
				<?php 
				$motif = ListeMotifs();
				foreach($motif as $m):
				?>
				<option value="<?php echo $m['IdMotifs'];?>" <?php if($Contenu[0]['IdMotifs'] == $m['IdMotifs']):?> selected <?php endif;?> ><?php echo $m['LibelleMotifs'];?></option>
				<?php endforeach; ?>
				</select>
				</div>
		</td>
		<td>
				<div class="description" name="test">
				<textarea class="Description" style="resize: none;" id="ContenuTextSolution" name="ContenuTextSolution"><?php echo $Contenu[0]['SolutionAction'];?></textarea>
				</div>
				
		</td>
		</tbody>
	</table>

</div>
</div>


<div class="contenu_onglet" id="contenu_onglet_RappelRelances">
</br>

	<table class="ficheCourante" >
	<tr>

	<td >
	<h2>
	Rappel Technicien :
	</h2>
			 Liste Technicien : <select id="ListeTechnicienRappelTecnicien" name="ListeTechnicienRappelTecnicien">
				<?php include 'ListeTechnicien.php'?>
		</select>

			Type :
			
			<select id="ListeTypeRappelTecnicien"  name="ListeTypeRappelTecnicien">
						<?php 
						
						for ($i = 0; $i < count($ListeTypeDemande); $i++) {
						?>
		<option value="<?php  echo $ListeTypeDemande[$i][0]; ?>"><?php  echo $ListeTypeDemande[$i][1]; ?></option>
																	<?php } ?>
		</select> 
		</br>
		Ajouter Rappel Technicien :  <img  id="ButAjouterRelanceTechni" name="AjouterdRelanceTechni" style="float: none; border: none; height: 35px; width: 32px; box-shadow: none;" src="../images/ajouter.png" value=''/>
		</td>
	<td class = "espace">
	</td>
	
	
	
	
	
		
	</tr>

	<!--2e Ligne )==> Petit tableau Rappel Technicien-->
		<tr>
						<td>
						<table>
							<thead class="thead">
						<tr>
							<th >
								Id
							</th>
							<th >
								Date
							</th>
							<th >
								Heure
							</th>
							<th  class="rappel">
								Technicien
							</th>
							<th >
								Type
							</th>
							
							<th >
								Supprimer
							</th>
							<th >
								Commentaire
							</th>
						</tr>

					</thead>
					
					
					<tbody id="AjoutRappelTechni">
					
					<?php 
					
					foreach($ListeRappelTechnicien as $RT):
					
					
					?>
						<tr>
							<td>
						
								<input class="modification" type="text" disabled="disabled" value="<?php   echo $RT['IdRelanceTechni']; ?>" name="IdRelanceTechni<?php   echo $RT['IdRelanceTechni']; ?>" />
							
							</td>
							<td>
							<input type="date"  disabled="disabled" style="width: 140px;" value="<?php echo $RT['DateRelanceTechni']; ?>" class="modification" name="DateRelanceTechni" />
							<!--<input class="modification" type="text" value="" name="DateRelanceTechni<?php// echo $f['id']; ?>" />-->
							</td>
							<td>
							<input type="number" min="0" max="23" pattern="[0-9]{1,3}"  name="HeureRelanceTechni" value="<?php echo $RT['HeureRelanceTechni']; ?>" disabled /> :
							<input type="number" min="0" max="59" pattern="[0-9]{1,3}"  name="MinuteRelanceTechni" value="<?php echo $RT['MinuteRelanceTechni']; ?>"  disabled />
							</td>
							<td>
						<select name="RappelTechnicienListeTechnicien" disabled>
							<?php	include 'ListeTechnicienRelanceTechni.php'; ?>
							</select>
						
							</td>
							<td>
							
						<select name="RappelTechnicienListeTypeDemande" disabled>
					<?php include 'ListeTypeDemande.php'; ?>
						</select> 
							</td>
							<td>
							
							<img name="supRT" onclick="SupprimerRelanceTechni(<?php echo $RT['IdRelanceTechni'];  ?>)" style="float: none; border: none; height: 35px; width: 32px; box-shadow: none;" src="../images/supprimer.png" value='<?php echo $RT['IdRelanceTechni'];  ?>'/>
							
							</td>
							<td>
							<input type="radio" name="SelectCommentaire" onclick="chargeCommentaire(<?php echo $RT['IdRelanceTechni'];  ?>)" value="<?php echo $RT['IdRelanceTechni'];  ?>"><br>
						
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<!--fin du petit tableau relance client -->
						</td>
						<td class = "espace">
						
						</td>
						<td>
						
						</td>
				
		</tr>
		<!--3e Ligne-->
		<tr>
		
			<td>
			Commentaire : 
			</td>
			
			<td class = "espace">
			</td>
			
		</tr>
	<tr>

			<td id="CommentRappelTechni">
			<div class="commentaire" name="CommentRappelTechni" >
					<textarea id="TACommentRappelTechni" class="Description" name="CommentaireRappelTechni" autofocus ="true"></textarea>
					</div>
					
			</td>
			
			<td>
			</td>
	
	</tr>
	</table>


		
		

		<!--<div class="commentaire" >
        <textarea class="Description" style="resize: none;"></textarea>
		</div>-->
	
</div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
<div class="contenu_onglet" id="contenu_onglet_RelanceClient">
</br>
<table class="ficheCourante">
	<tr>

	<td >
	<h2>
	Relance Client :
	</h2>
			 

			Type :
			
			<select id="ListeTypeRelanceClient"  name="ListeTypeRappelTecnicien">
						<?php 
						
						for ($i = 0; $i < count($ListeTypeDemande); $i++) {
						?>
		<option value="<?php  echo $ListeTypeDemande[$i][0]; ?>"><?php  echo $ListeTypeDemande[$i][1]; ?></option>
																	<?php } ?>
		</select> 
		</br>
		Ajouter Relance Client :  <img  id="ButAjouterRelanceClient" name="AjouterdRelanceClient" style="float: none; border: none; height: 35px; width: 32px; box-shadow: none;" src="../images/ajouter.png" value=''/>
		</td>
	<td class = "espace">
	</td>
	
	
	
	
	
		
	</tr>

	<!--2e Ligne )==> Petit tableau Rappel Technicien-->
		<tr>
						<td>
				<table>
				
				
		<thead class="thead">
			<th>
			ID
			</th>
			<th>
			Date
			</th>
			<th>
			Heure
			</th>
			<th>
			Type
			</th>
			<th>
			Supprimer
			</th>
			<th>
			Commmentaire
			</th>
		</thead>
		
		<tbody id = "AjoutRelanceCli">
		
		<?php foreach($ListeRelanceClient as $RC):	?>
			<tr>
							<td>
							
								<input class="modification" type="text" disabled="disabled" value="<?php   echo $RC['IdRelanceClient']; ?>" name="IdRelanceTechni<?php   echo $RC['IdRelanceClient']; ?>" />
							
							</td>
							<td>
							<input type="date" disabled="disabled" style="width: 140px;" value="<?php echo $RC['DateRelanceCli']; ?>" class="modification" name="DateRelanceTechni" max="<?php echo date('Y-m-d'); ?>" min="<?php echo date_format(date_sub(new DateTime(date('Y-m-d')), new DateInterval('P1Y')), 'Y-m-d'); ?>" />
							<!--<input class="modification" type="text" value="" name="DateRelanceTechni<?php// echo $f['id']; ?>" />-->
							</td>
							<td>
							<input type="number" min="0" max="23" pattern="[0-9]{1,3}"  name="HeureRelanceTechni" value="<?php echo $RC['HeureRelanceCli']; ?>" disabled /> :
							<input type="number" min="0" max="59" pattern="[0-9]{1,3}"  name="MinuteRelanceTechni" value="<?php echo $RC['MinuteRelanceCli']; ?>" disabled />
							</td>
						
							<td>
							
						<select name="RappelTechnicienListeTypeDemande" disabled>
					<?php include 'ListeTypeDemandeRelanceClient.php'; ?>
						</select> 
							</td>
							<td>
							
							<img name="supRT" onclick="SupprimerRelanceClient(<?php echo $RC['IdRelanceClient'];  ?>)" style="float: none; border: none; height: 35px; width: 32px; box-shadow: none;" src="../images/supprimer.png" value='<?php echo $RC['IdRelanceClient'];  ?>'/>
							
							</td>
							<td>
							<input type="radio" name="SelectCommentaireRC" onclick="chargeCommentaireRC(<?php echo $RC['IdRelanceClient'];  ?>)" value="<?php echo $RC['IdRelanceClient'];  ?>"><br>
						
							</td>
						</tr>
		
		<?php 	endforeach; ?>
		</tbody>
				</table>
				<!--fin du petit tableau relance client -->
				
				</td>
						<td class = "espace">
						
						</td>
						<td>
						
						</td>
				
		</tr>
		<!--3e Ligne-->
		<tr>
		
			<td>
			Commentaire : 
			</td>
			
			<td class = "espace">
			</td>
			
		</tr>
	<tr>

			<td id="CommentRelanceClient">
			<div class="commentaire" name="CommentRappelClient" >
					<textarea id="TACommentRappelClient" class="Description" name="CommentRappelClient"></textarea>
					</div>
					
			</td>
			
			<td>
			</td>
	
	</tr>
	</table>
				
				
				
				</div>

<!--  ----------------------------------------------------------------------------------------------------------------------------------------- -->



<div class="contenu_onglet" id="contenu_onglet_NumSerie">
<h2> Ajouter un nouveau numero de serie</h2>

	<table class="RappelRelanceClient">
		<thead class="thead" align="center">
			<th>
				LOGICIEL
			</th>
			
			
			<th>
				MATERIEL
			</th>
		</thead>
		<tbody>
		<td>
		<table class="ficheCourante">
		<thead class="thead" align="center">
			<th>
				IdNumSerie
			</th>
			<th>
				NumSerie
			</th>
			<th>
				Motifs
			</th>
			<th>
				Ajouter/Supprimer
			</th>
		
			</thead>
		<tbody id="tbodyNumeroSerieLogi" >
		
		<?php include'TableauNumeroSerieLogi.php';?>
			
		
			
		</tbody>
		<tfoot>
		<tr> <td></td>
			<td>
				
					<input class="modification" style="width: 170px;" id="NouveauNumSerieLogi" type="text" value="" />
				
				</td>
				
				<td>
				
				<select id="ListeMotifsLogi" >
				<?php 
				$motif = ListeMotifs();
				foreach($motif as $m):
				?>
				<option value="<?php echo $m['IdMotifs'];?>"><?php echo $m['LibelleMotifs'];?></option>
				<?php endforeach; ?>
				</select>
				</td>
				<td class="tdicone">
		
			<img style="float: none; border: none; height: 35px; width: 32px; box-shadow: none;" src="../images/ajouter.png"  id="AjouterNumSerieLogi" >
						
				</td>
				
			</tr>	
		</tfoot>
		</table>
		</td>
		
		<td>
		<table class="ficheCourante">
		<thead class="thead" align="center">
			<th>
				IdNumSerie
			</th>
			<th>
				NumSerie
			</th>
			<th>
				Motifs
			</th>
			<th>
				Ajouter/Supprimer
			</th>
		
			</thead>
		<tbody id="tbodyNumeroSerieMater" >
		
<?php
$ListeNumSeries = ListeNumeroSerieMateriel($IdAction);
 foreach($ListeNumSeries as $ma):
 echo('
 <tr>
		<td>
			<input class="modification"   type="text" value="'. $ma['IdNumSerie'].'" disabled/>
		</td>
		<td>
			<input class="modification"   type="text" value="'.$ma['NumeroSerie'].'" disabled/>
		</td>
				
				<td>
				<select disabled>');
				
				foreach($motif as $m):
				echo('
				<option value="'.$m['IdMotifs'].'"'); if($m['IdMotifs'] == $ma['IdMotifs']): echo('selected'); endif; echo('>'.$m['LibelleMotifs'].'</option>
				'); endforeach;
				echo('</select>
				</td>
				
				<td class="tdicone">
				
					<img  onclick="SupprimerNumSerieMater('.$ma['IdNumSerie'].')" style="float: none; border: none; height: 35px; width: 32px; box-shadow: none;" src="../images/supprimer.png" value="" />
				
				</td> </tr>');
endforeach;  ?>
		</tbody>
		<tfoot>
		<tr>
		<td></td>
			<td>
				
					<input class="modification" style="width: 170px;" id="NouveauNumSerieMater" type="text" value=""/>
				
				</td>
				
				<td>
				
				<select id="ListeMotifsMater" >
				<?php 
				$motif = ListeMotifs();
				foreach($motif as $m):
				?>
				<option value="<?php echo $m['IdMotifs'];?>"><?php echo $m['LibelleMotifs'];?></option>
				<?php endforeach; ?>
				</select>
				</td>
				<td class="tdicone">
				
						<img  id="AjouterNumSerieMater" style="float: none; border: none; height: 35px; width: 32px; box-shadow: none;" src="../images/ajouter.png"  />
				
				</td>
				
		</tr>
		</tfoot>
		</table>
		
		
		</td>
</table>




</div>
<div class="contenu_onglet" id="contenu_onglet_BaseDeConnaissance">

	<h2> Base de Connaissance </h2>

	<table class="ficheCourante">
	<tr>
	<table class="ficheCourante">
	<tr>
	<thead class="thead">
	
	<th>
		Nom Du Sujet
	</th>
	<th>
		Ajouter Le sujet
	</th>
	</thead>
	<tbody>
	
	<td>
		<input class="modification" style="width: 230px;" id="NouveauNomSujet" type="text" value=""/>
	</td>
	<td class="tdicone">
					
							<img   id="AjouterSujet" style="float: none; border: none; height: 35px; width: 32px; box-shadow: none;" src="../images/ajouter.png"  />
					
					</td>
	</tbody>
	</tr>
	</table>
	<table class="ficheCourante" style="margin-left: 1000px; margin-top: -50px;">
		
		<thead class="thead">
				<tr>
					
					<th>
						Liste Sujets
					</th>
					<th>
						Supprimer
					</th>
					<th>
						Ajouter dans l'action
					</th>
				</tr>
		</thead>
		<tbody>
	
		
			<td>
			<select name="SelectSujet" id="SelectSujet" >
						<?php 
						
						for ($i = 0; $i < count($ListeSujet); $i++) {
								
											
					?>
					  <option value="<?php  echo $ListeSujet[$i][0];?>"><?php  echo $ListeSujet[$i][1]; ?></option>
					  <?php } ?>
					</select>
			</td>
			<td class="tdicone">
							
									<img   id="SupprimerSujet" style="float: left; border: none; height: 30px; width: 27px; box-shadow: none; margin-left: 57px;" src="../images/supprimer.png"  />
							
							</td>
							<td class="tdicone">
							
									<img   id="AjouterSujetDecription" style="float: left; border: none; height: 30px; width: 27px; box-shadow: none; margin-left: 57px;" src="../images/ajouter.png"  />
							
							</td>
	</tbody>
		</table>
	</tr>
	<tr>
			
				<td>
				Solution : 
				</td>
				
				<td class = "espace">
				</td>
				
			</tr>
		<tr>

				<td id="CommentBaseConnaissance">
				<div class="commentaire" name="CommentBaseConnaissance" style="float: none;">
						<textarea id="TASujetBaseDeConnaissance" class="Description" name="SujetBaseDeconnaissance"></textarea>
						</div>
						
				</td>
	
		</tr>
		
		</table>
		




	</div>
</form>




</br></br></br></br>

<div align='center'>

</div>



	</div>
	
</div>

</form>



<?php include'../html/Footer.html'; ?>
<script type="text/javascript">
azemps = document.getElementById("CompteurModif");
	// alert(azemps.value);
	string = azemps.value.toString();
	// alert(str);
	var str = string.split(" : ");
	heure=str[0];
	minute=str[1];
	seconde=str[2];
	if(minute < 10){
	minute = minute.substring(1,2);
					}
if(heure < 10){
	heure = heure.substring(1,2);
				}

CompteurModif();

	if( document.getElementById("ClotureModif").checked == true)
	{
		interupt = true;
	}
	else
	{
		interupt = false;
	}
	// alert("interupt = "+interupt);
	
	
 function ChangerEtat()
 {
 // alert("click");

	if(interupt == true)
	 {
		// Compteur marche
		interupt = false;
		
		
	}
	else
	{
		// Compteur stop
		interupt = true;
	}
		// alert(interupt);
		// IdActions = $("#Numero").attr("value");
		
	
		if(interupt){
		// alert("compteur stop");
			date2 = new Date();
			EtatModif = "CL";
			jourModif = date2.getDate();
			moisModif = date2.getMonth()+1;
			anneeModif = date2.getFullYear();
			HeureModif = date2.getHours();
			MinuteModif = date2.getMinutes();
	
			
			if(jourModif<10)
			{
			jourModif = "0"+jourModif;
			}
			if(moisModif<10)
			{
			moisModif = "0"+moisModif;
			}
			
			
			if (HeureModif<10 && HeureModif != "00")
			{
			HeureModif= "0"+HeureModif;
			}
			
			if (MinuteModif<10 && MinuteModif != "00")
			{
			MinuteModif= "0"+MinuteModif;
			}
			
			DatesModif = anneeModif+"-"+moisModif+ "-" + jourModif;
			
			
			
		}
		else
		{
			EtatModif = "EC";
			
			DatesModif = "";
			
			HeureModif = "";
			MinuteModif = "";
		}
	document.getElementById("DateFin").value=DatesModif ;
	document.getElementById("HeureFin").value= HeureModif;
	document.getElementById("MinuteFin").value= MinuteModif;
	

}
function CompteurModif()
{
	
	
	bool = 0;
	// alert("bool : "+bool);
		setInterval("ActualiserCompteurModif(bool)",1000);
}





function ActualiserCompteurModif(bool)
	{
	// alert("bool p : "+bool);
	// if(bool==0){
			// seconde=Secondez;
			// minute=Minutez;
			// heure=Heurez; 
			jour=0;
			// bool=1;
				bool=1;
				// alert("bool chang : "+bool);
				// }

	if (!interupt)
	{
		seconde++;
		
		if(seconde ==60)
		{
			seconde=0;
			minute++;
		}

		if(minute ==60)
		{
			seconde=0;
			minute=0;
			heure++;
		}
		if(heure ==24)
		{
			seconde=0;
			minute=0;
			heure=0;
			jour++;
		}

		if(heure < 10 && heure != "00")
		{
		text = "0" + heure+ " : ";
		
			
		}
		else
		{
			text =  heure+ " : ";
		}
		
		if(minute < 10 || minute == "00")
		{
		text += "0" + minute + " : ";
		
			
		}
		else
		{
			text += minute+ " : ";
		}

		if(seconde < 10)
		{
		if(seconde == "0"){
		text += "00";
		}
		else{text += "0" + seconde;}
			
		}
		else
		{
			text += seconde;
		}
		// alert("nouvHeure = "+heure);
		// alert("nouvminute = "+minute);
		// alert("nouvseconde = "+seconde);
		// alert("nouvjour = "+jour);
// alert("text = "+text);
	document.getElementById("CompteurModif").value= text;
	
		// document.getElementById("#CompteurJourModif").val($jour);
	}
}
</script>
<script type="text/javascript">
//<!--
var anc_onglet = 'descript';
change_onglet(anc_onglet);
//-->
</script>
<?php }
else
{
header("Location: accueil.php");
} ?>