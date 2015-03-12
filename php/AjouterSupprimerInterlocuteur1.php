<?php

/**
 * Page qui permet au comptable de choisir un mois à partir d'un visiteur pour valider une fiche
**/

	//Démarrage des sessions
	session_start();
	
	//inclusion du header
	include '../html/Header.html';
	
	//inclusion de la page de fonction php
	require_once('_function.php');
	
	//Vérification de l'authentification
	verificationAuthentification();
	
	//Détermination du menu pour l'utilisateur
	menu($_SESSION["statut"]);
if($_SESSION["statut"] == "Administrateur")
	{
	
	//Si on click sur le bouton ajouter
	if(isset($_POST['AjouterInterlocuteur']))
	{
	
$NouveauNomI= $_REQUEST['NouveauNomI'];
$NouveauPrenomI= $_REQUEST['NouveauPrenomI'];
$NouveauTelMobile= $_REQUEST['NouveauTelMobile'];
$NouveauEmailI= $_REQUEST['NouveauEmailI'];
$Societe = $_REQUEST['NouvelleListeSocieteInterlocuteur']; 
		//création d'un Type
	$res = creeInterlocuteur($Societe,$NouveauNomI,$NouveauPrenomI,$NouveauTelMobile,$NouveauEmailI);
	
		
		if($res = false):
		$message='Erreur Type non ajouter';

echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
		endif;
		if($res = true):
		$message='Vous avez ajouter l\'interlocuteur '.$NouveauNomI.'   '.$NouveauPrenomI;

echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
		endif;
	
	// header("Location: AjouterSupprimerType.php");
	}
	
	//Si on click sur le boutton supprimer
	if(isset($_POST['supprimerI']))
	{ 
	 $id = $_REQUEST['supprimerI'];
	
	// var_dump($id);exit;
	$reussi = supprimerI($id);
	
	if($reussi = false):
		$message='Erreur Type non Supprimer';

 echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
		endif;
		
	}
	
	if(isset($_POST['ModifierI']))
	{
	
	$IdF = ListeTotalDesInterlocuteur();
// var_dump($_REQUEST);exit;
			if($IdF != false):
			foreach($IdF as $t):
			 
			$NomI = $_REQUEST['NomI'.$t['IdInterlocuteur']];
			$PrenomI = $_REQUEST['PrenomI'.$t['IdInterlocuteur']];
			$TelMobileI = $_REQUEST['TelMobile'.$t['IdInterlocuteur']];
			$email = $_REQUEST['Email'.$t['IdInterlocuteur']];
			$Societe2 = $_REQUEST['ListesSocieteInterlocuteur'.$t['IdInterlocuteur']]; 
			$reussi = modifierInterlocuteur($t['IdInterlocuteur'],$Societe2,$NomI,$PrenomI,$TelMobileI,$email);
			endforeach;
			endif;	
	
	}
	
	//Si on click sur le bouton SlectionnerInterlocuteur
	// if(isset($_POST['SelectionnerInterlocuteur']))
	// {
	
// $idInter= $_REQUEST['SelectionnerInterlocuteur'];
		
	// $idFiche= $_GET['id'];
		
	
	// header("Location: AjouterAction.php?id=".$idFiche."IdI=".$idInter);
	// }
	$ListeF = ListeFiche($_SESSION['id']);
					
	
?>

<div class="contenu">
	<div id="hautpage"> </div>
	
	
	<h2 align ="center">
	Login : <?php echo $_SESSION["user"]; ?>
		</br>
		<h2 align="center">
		Consulter, ajouter et supprimer des Interlocuteurs
		</br></br>
		
		</h2>
		
	</h2>
	</br>
	Trier les interlocuteurs par société : <input type="checkbox" id="CheckBoxTrierInterParSociete" />
	
		
	<a href="#hautpage"  ><img src="../images/flecheH.png"  id="btntop"  /></a> 
	<a href="#baspage"  ><img src="../images/flecheB.png" style="right: 30px; top: 780px;" id="btntop"  /></a> 
<form method="POST"  >

		
		<br /><br />

		<table class="ficheCourante">
				
			<thead class="thead">
				
				
							
				<tr>
						
					<th>
						Nom
					</th>				
					<th>
						Prénom
					</th>
					<th>
						Téléphone Mobile
					</th>
					<th>
						Email
					</th>
					<th>
						Société
					</th>
					<th>
						Supprimer
					</th>
					
					<th>
						Modifier
					</th>
					
				</tr>
			
			</thead>
			
			<tbody id="TbodyInterParam">
			
<?php
$Inter = ListeTotalDesInterlocuteur();
// var_dump($ListeF);exit;
if($Inter != false):
foreach($Inter as $i):

?>

			<tr>
				
				
				<td>
					<input id="NomInterlocuteur<?php echo $i['IdInterlocuteur']; ?>" class="modification" type="text" value="<?php echo $i['NomI']; ?>" name="NomI<?php echo $i['IdInterlocuteur']; ?>" />
				</td>
				<td>
					<input id="PrenomInterlocuteur<?php echo $i['IdInterlocuteur']; ?>" class="modification" type="text" value="<?php echo $i['PrenomI']; ?>" name="PrenomI<?php echo $i['IdInterlocuteur']; ?>" />
				</td>
				<td>
					<input id="TelMobileInterlocuteur<?php echo $i['IdInterlocuteur']; ?>" class="modification" type="text" value="<?php echo $i['TelMobileI']; ?>" name="TelMobile<?php echo $i['IdInterlocuteur']; ?>" />
				</td>
				<td>
					<input  id="EmailInterlocuteur<?php echo $i['IdInterlocuteur']; ?>"class="modification" type="text" value="<?php echo $i['emailI']; ?>" name="Email<?php echo $i['IdInterlocuteur']; ?>" />
				</td>
				
				<td>	
				<select  name="ListesSocieteInterlocuteur<?php echo $i['IdInterlocuteur']; ?>" id="ListeSocieteInterlocuteur<?php echo $i['IdInterlocuteur']; ?>">
					<?php 
					
					for ($j = 0; $j < count($ListeF); $j++) {
					?>
				  <option value="<?php  echo $ListeF[$j][0];?>" <?php if($i['IdFicheSociete'] == $ListeF[$j][0]): ?> selected <?php endif;?> > <?php echo "  ".$ListeF[$j][1]; ?></option>
				  <?php } ?>
				</select>
						
					</td>
				<td class="tdIcone">
				
					<img onclick="SupprimerInterlocuteurParam(<?php echo $i['IdInterlocuteur']; ?>)" name="supprimerI" style="float: none; border: none; height: 35px; width: 32px; box-shadow: none;" src="../images/supprimer.png" class="suppdression" value='<?php echo $i['IdInterlocuteur']; ?>'/>
				
				</td>
				
					<td>	
						<img onclick="ModifierInterlocuteurParam(<?php echo $i['IdInterlocuteur']; ?>)" id="ModifierI" align="center" style="float: none;" class ="reporter" name="ModifierI" value='Modifier'/>
					</td>
					
					
			</tr>

<?php

			endforeach;
	
		endif;

?>
</tbody>
<tbody class="thead">
	<th>
		Nom
	</th>
	<th>
		Prénom
	</th>
	<th>
		Téléphone Mobile
	</th>
	<th>
		Email
	</th>
	<th>
		Société
	</th>
	<th>
		Ajouter
	</th>
</tbody>
<tfoot>
<tr class="espace">
				<td>
				
					<input class="modification" type="text" value="" name="NouveauNomI" />
				
				</td>
				
				<td>
				
					<input class="modification" type="text" value="" name="NouveauPrenomI" />
				
				</td>
				<td>
				
					<input class="modification" type="text" value="" name="NouveauTelMobile" />
				
				</td>
				<td>
				
					<input class="modification" type="text" value="" name="NouveauEmailI" />
				
				</td>
				<td>
				<select  name="NouvelleListeSocieteInterlocuteur">
			
					<?php 
					
					for ($i = 0; $i < count($ListeF); $i++) {?>
				  <option value="<?php  echo $ListeF[$i][0];?>"> <?php  echo "  ".$ListeF[$i][1]; ?></option>
				  <?php } ?>
				</select>
				</td>
				<td class="tdIcone">
				
					<input type="submit" name="AjouterInterlocuteur" class="ajouter" value=''/>
				
				</td>
				
				
				
				</tr>
				
		
		</tfoot>
	</table>

</form>

				

</div>

<div id="baspage"> </div>



<?php include'../html/Footer.html'; ?>
<?php }
else
{
header("Location: accueil.php");
} ?>