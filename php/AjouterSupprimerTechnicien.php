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
	if(isset($_POST['AjouterTechnicien']))
	{
	// var_dump($_POST);exit;
		$LibelleTechnicien= $_REQUEST['NouveauLibelleTechnicien'];
		$PrenomT= $_REQUEST['NouveauPrenomTechnicien'];
		$login= $_REQUEST['NouveauLoginTechnicien'];
		$mdp= $_REQUEST['NouveauMdpTechnicien'];
		$adresse= $_REQUEST['NouveauAdresseTechnicien'];
		$cp= $_REQUEST['NouveauCPTechnicien'];
		$Ville= $_REQUEST['NouveauVilleTechnicien'];
		$Statut= $_POST['NouveauStatutTechnicien'];
// var_dump($Statut);exit;
		//création d'un Technicien
	$res = creeTechnicien($LibelleTechnicien,$PrenomT,$login,$mdp,$adresse,$cp,$Ville,$Statut);
	
		
		if($res = false):
		$message='Erreur Technicien non ajouter';

echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
		endif;
		if($res = true):
		$message='Vous avez ajouter un Technicien';

echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
		endif;
	
	
	}
	
	//Si on click sur le boutton supprimer
	if(isset($_POST['supprimerTechnicien']))
	{
	
	 $id = $_REQUEST['supprimerTechnicien'];
	$reussi = supprimerTechnicien($id);
	
	if($reussi = false):
		$message='Erreur Tecnicien non Supprimer';

 echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
		endif;
	}
	
	
	//Si on click sur le boutton supprimer
	if(isset($_POST['ModifierTechnicien']))
	{
	
	//Modifier tous les techniciens
	// $techni =ListeTechnicien();
// if($techni != false):
// foreach($techni as $t):
 
// $Lbl = $_REQUEST['LibelleTechnicien'.$t['IdTechnicien']];

// $reussi = modifierTechnicien($t['IdTechnicien'],$Lbl);

// endforeach;
//endif;	
$id =  $_REQUEST['ModifierTechnicien'];
$Nom =  $_REQUEST['NomTechnicien'.$id];
$Prenom =  $_REQUEST['PrenomTechnicien'.$id];
$login =  $_REQUEST['login'.$id];
$mdp =  $_REQUEST['mdp'.$id];
$adresse =  $_REQUEST['adresse'.$id];
$cp =  $_REQUEST['cp'.$id];
$ville =  $_REQUEST['ville'.$id];
$statut =  $_REQUEST['statut'.$id];
// var_dump($_REQUEST);
// exit;
$reussi = modifierTechnicien($id,$Nom,$Prenom,$login,$mdp,$adresse,$cp,$ville,$statut);


	
	}
	
	
	
?>

<div class="contenu">
	
	
	
	<h2>
	Login : <?php echo $_SESSION["user"]; ?>
		</br>
		<h2 align="center">
		Consulter, ajouter et supprimer des Techniciens
		</h2>
	</h2>
	</br>
	
<form method="POST" action="AjouterSupprimerTechnicien.php"  onsubmit="return confirm('Etes vous sur de vouloir supprimer ou Modifier ce Technicien ?')">

		
		<br /><br />

		<table class="ficheCourante">
				
			<thead class="thead">
				
				
							
				<tr>
						<!--<th>
						ID
					</th>-->
					<th>
					NomTechnicien						
					</th>
					
					<th>
						Prenom
					</th>
					<th>
						login
					</th>
					<th>
						mdp
					</th>
					<th>
						adresse
					</th>
					<th>
						CP
					</th>
					<th>
						Ville
					</th>
					<th>
						Statut
					</th>
					<th>
						Supprimer
					</th>
					
					<th>
						Nombre Technicien : <?php echo NbrTechnicien(); ?>
					</th>
					
				</tr>
			
			</thead>
			
			<tbody>
			
<?php
$techni = ListeTechnicien();
if($techni != false):
foreach($techni as $t):

?>

			<tr>
				
				
				<td>
				
					<input class="modification" type="text" value="<?php echo $t['nom']; ?>" name="NomTechnicien<?php echo $t['id']; ?>" />
				
				</td>
				
				<td>
				
					<input class="modification" type="text" value="<?php echo $t['prenom']; ?>" name="PrenomTechnicien<?php echo $t['id']; ?>" />
				
				</td>
				<td>
				
					<input class="modification" type="text" value="<?php echo $t['login']; ?>" name="login<?php echo $t['id']; ?>" />
				
				</td>
				<td>
				
					<input class="modification" type="text" value="<?php echo $t['mdp']; ?>" name="mdp<?php echo $t['id']; ?>" />
				
				</td>
				<td>
				
					<input class="modification" type="text" value="<?php echo $t['adresse']; ?>" name="adresse<?php echo $t['id']; ?>" />
				
				</td>
				<td>
				
					<input class="modification" type="text" value="<?php echo $t['cp']; ?>" name="cp<?php echo $t['id']; ?>" />
				
				</td>
				<td>
				
					<input class="modification" type="text" value="<?php echo $t['ville']; ?>" name="ville<?php echo $t['id']; ?>" />
				
				</td>
				<td>
				<select name="statut<?php echo $t['id']; ?>">
				<option value="Administrateur" <?php if($t['statut'] == "Administrateur"):?> selected <?php endif; ?> > Administrateur </option>
				<option value="Visiteur" <?php if($t['statut'] == "Visiteur"):?> selected <?php endif; ?>> Visiteur </option>
				</select>
					
				
				</td>
				<td class="tdIcone">
				
					<input type="submit" name="supprimerTechnicien" class="suppression" value='<?php echo $t['id']; ?>'/>
				
				</td>
				
				<td>	
						<input type="submit"  align="center" class ="reporter" name="ModifierTechnicien" value='<?php echo $t['id']; ?>'/>
						
					</td>
			
			</tr>

<?php

			endforeach;
	
		endif;

?>

				
		</tbody>
		
			
	
	</table>
	<!--<table class="ficheCourante">
	<tr>
						
					

					<th>	
						<input type="submit" id="BouttonModifier" align="center" class ="modifier" name="ModifierFiche" value='Modifier'/>
						
					</th>
					</tr>
	</table>-->
</form>

</br></br>
<form method="POST" action="AjouterSupprimerTechnicien.php" >

		
	

		<table class="ficheCourante">
		
		<thead class="thead">
		<tr>
			<th>
				NomTechnicien
			</th>
			<th>
				Prenom
			</th>
			<th>
				login
			</th>
			<th>
				mdp
			</th>
			<th>
				adresse
			</th>
			<th>
				CP
			</th>
			<th>
				Ville
			</th>
			<th>
				Statut
			</th>
			<th>
				Ajouter
			</th>

		</tr>
		
		</thead>	
		<tr>
				<td>
				
					<input class="modification" type="text" value="" name="NouveauLibelleTechnicien" />
				
				</td>
				<td>
				
					<input class="modification" type="text" value="" name="NouveauPrenomTechnicien" />
				
				</td>
				<td>
				
					<input class="modification" type="text" value="" name="NouveauLoginTechnicien" />
				
				</td>
				<td>
				
					<input class="modification" type="text" value="" name="NouveauMdpTechnicien" />
				
				</td>
				<td>
				
					<input class="modification" type="text" value="" name="NouveauAdresseTechnicien" />
				
				</td>
				<td>
				
					<input class="modification" type="text" value="" name="NouveauCPTechnicien" />
				
				</td>
				<td>
				
					<input class="modification" type="text" value="" name="NouveauVilleTechnicien" />
				
				</td>
				<td>
				<select name="NouveauStatutTechnicien">
				<option value="Administrateur"> Administrateur </option>
				<option value="Visiteur" > Visiteur </option>
				</select>
					
				
				</td>
				<td class="tdIcone">
				
					<input type="submit" name="AjouterTechnicien" class="ajouter" value=''/>
				
				</td>
				<td>
				</td>
				</tr>
				</table>
				
				
				<table class="ficheCourante">
	<tr>
						
					

					
					</tr>
	</table>
</form>

				
				

</div>





<?php include'../html/Footer.html'; ?>
<?php }
else
{
header("Location: accueil.php");
} ?>