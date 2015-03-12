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
	if(isset($_POST['AjouterType']))
	{
	
$LibelleType= $_REQUEST['NouveauLibelleType'];
		//création d'un Type
	$res = creeType($LibelleType);
	
		
		if($res = false):
		$message='Erreur Type non ajouter';

echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
		endif;
		if($res = true):
		$message='Vous avez ajouter un Type';

echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
		endif;
	
	// header("Location: AjouterSupprimerType.php");
	}
	
	//Si on click sur le boutton supprimer
	if(isset($_POST['supprimerType']))
	{
	 $id = $_REQUEST['supprimerType'];
	$reussi = supprimerType($id);
	
	if($reussi = false):
		$message='Erreur Type non Supprimer';

 echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
		endif;
		
	}
	
	if(isset($_POST['ModifierType']))
	{
	$type =ListeType();

if($type != false):
foreach($type as $t):
 
$Lbl = $_REQUEST['LibelleType'.$t['IdType']];

$reussi = modifierType($t['IdType'],$Lbl);
endforeach;
endif;	
	
	}
	
	
	
?>

<div class="contenu">
	
	
	
	<h2>
	Login : <?php echo $_SESSION["user"]; ?>
		</br>
		<h2 align="center">
		Consulter, ajouter et supprimer des types
		</h2>
	</h2>
	</br>
	
<form method="POST" action="AjouterSupprimerType.php"  onsubmit="return confirm('Etes vous sur de vouloir supprimer ou Modifier ce type ?')">

		
		<br /><br />

		<table class="ficheCourante">
				
			<thead class="thead">
				
				
							
				<tr>
						
					<th>
						
						LibelleType
						
					</th>
					
					
					
					<th>
						Ajouter/Supprimer
					</th>
					<th>
						Modifier
					</th>
					
					<th>
						Nombre fiche : <?php echo NombreType(); ?>
					</th>
				</tr>
			
			</thead>
			
			<tbody>
			
<?php
$type = ListeType();

if($type != false):
foreach($type as $t):

?>

			<tr>
				
				
				<td>
				
					<input class="modification" type="text" value="<?php echo $t['LibelleType']; ?>" name="LibelleType<?php echo $t['IdType']; ?>" />
				
				</td>
				
				
				<td class="tdIcone">
				
					<input type="submit" name="supprimerType" class="suppression" value='<?php echo $t['IdType']; ?>'/>
				
				</td>
				
				<td>	
						<input type="submit"  align="center" class ="reporter" name="ModifierType" value='Modifier'/>
						
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
<form method="POST" action="AjouterSupprimerType.php" >

		
	

		<table class="TypeAjouterSupprimer">
		<tr>
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