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
		//création d'un Type
	$res = creeInterlocuteur($_GET['id'],$NouveauNomI,$NouveauPrenomI,$NouveauTelMobile,$NouveauEmailI);
	
		
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
	
	
	$reussi = supprimerI($id);
	
	if($reussi = false):
		$message='Erreur Type non Supprimer';

 echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
		endif;
		
	}
	
	if(isset($_POST['ModifierI']))
	{
	$IdF = ListeInterlocuteur($_GET['id']);

if($IdF != false):
foreach($IdF as $t):
 
$NomI = $_REQUEST['NomI'.$t['IdInterlocuteur']];
$PrenomI = $_REQUEST['PrenomI'.$t['IdInterlocuteur']];
$TelMobileI = $_REQUEST['TelMobile'.$t['IdInterlocuteur']];
$email = $_REQUEST['Email'.$t['IdInterlocuteur']];
$reussi = modifierInterlocuteur($t['IdInterlocuteur'],$IdF,$NomI,$PrenomI,$TelMobileI,$email);
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
	
	$ListeInterocuteur = ListeTotalDesInterlocuteur();
?>

<div class="contenu">
	
	
	
	<h2 align ="center">
	Login : <?php echo $_SESSION["user"]; ?>
		</br>
		<h2 align="center">
		Consulter, ajouter et supprimer des Interlocuteurs
		</br></br>
		</h2>
		
	</h2>
	</br>
	<form  method="POST" >
<form method="POST" action="AjouterSupprimerType.php"  onsubmit="return confirm('Etes vous sur de vouloir supprimer ou Modifier ce type ?')">

		
		<br/><br/>

		<table class="ficheCourante">
				
			<thead class="thead">
				
				<tr>
			<td></td><td></td>
			<td>
			Interlocuteur :
			</td>
			<td>
			<select id="SelectInterlocuteur" name="SelectInterlocuteur">
			
					<?php 
					
					for ($i = 0; $i < count($ListeInterocuteur); $i++) {
							
										
				?>
				  <option value="<?php  echo $ListeInterocuteur[$i][0];?>" 
				  <?php if(isset($_GET['IdInter'])):
				  if($_GET['IdInter'] != ""):
				  if($ListeInterocuteur[$i][0] == $_GET['IdInter']):
				  
				  ?>  selected <?php endif; endif; endif; ?> ><?php  echo "  ".$ListeInterocuteur[$i][3]; ?></option>
				  <?php } ?>
				</select>
				

			
			</td> 
							
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
					<th>
						Selectionner
					</th>
				</tr>
			
			</thead>
			
			<tbody>
			
<?php
$Inter = ListeTotalDesInterlocuteur();

// if($Inter != false):
// foreach($Inter as $i):

?>

			<tr id="Interlocuteur">
				
				
				<td>
					<input class="modification" type="text" value="" name="NomI" />
				</td>
				<td>
					<input class="modification" type="text" value="" name="PrenomI" />
				</td>
				<td>
					<input class="modification" type="text" value="" name="TelMobile" />
				</td>
				<td>
					<input class="modification" type="text" value="" name="Email" />
				</td>
				
				<td class="tdIcone">
				
					<input type="submit" name="supprimerI" class="suppression" value=''/>
				
				</td>
				
					<td>	
						<input type="submit"  align="center" class ="reporter" name="ModifierI" value='Modifier'/>
					</td>
					<td >
						
					</td>
			</tr>

<?php

			// endforeach;
	
		// endif;

?>

<tr class="espace">
				<td>
				
					<input class="modification" type="text" value="" name="NouveauNomI" />
				
				</td>
				&nbsp
				<td>
				
					<input class="modification" type="text" value="" name="NouveauPrenomI" />
				
				</td>
				<td>
				
					<input class="modification" type="text" value="" name="NouveauTelMobile" />
				
				</td>
				<td>
				
					<input class="modification" type="text" value="" name="NouveauEmailI" />
				
				</td>
				<td class="tdIcone">
				
					<img  name="AjouterInterlocuteur" id="ButAjouterInterlocuteur" class="ajouter" value=''/>
				
				</td>
				
				<td>
				</td>
				
				</tr>
				
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
<!--<form method="POST" action="AjouterSupprimerType.php" >

		
	

		<table class="TypeAjouterSupprimer">
		<tr class="espace">
				<td>
				
					<input class="modification" type="text" value="" name="NouveauLibelleType" />
				
				</td>
				&nbsp
				<td>
				
					<input class="modification" type="text" value="" name="NouveauLibelleType" />
				
				</td>
				<td>
				
					<input class="modification" type="text" value="" name="NouveauLibelleType" />
				
				</td>
				<td>
				
					<input class="modification" type="text" value="" name="NouveauLibelleType" />
				
				</td>
				<td class="tdIcone">
				
					<input type="submit" name="AjouterType" class="ajouter" value=''/>
				
				</td>
				<td>
				</td>
				</tr>
				</table>
				
				
				<table class="ficheCourante">
	
	</table>
</form>-->

				
				

</div>





<?php include'../html/Footer.html'; ?>
<?php }
else
{
header("Location: accueil.php");
} ?>