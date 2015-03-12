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
	if(isset($_POST['AjouterTypeDemande']))
	{
	
$LibelleType= $_REQUEST['NouveauLibelleTypeDemande'];
		//création d'un Type demande
	$res = creeTypeDemande($LibelleType);
	var_dump($res);
		
		if($res = false):
		$message='Erreur Type non ajouter';

echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
		endif;
		if($res = true):
		$message='Vous avez ajouter un Type';

echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
		endif;
	
	 header("Location: AjouterSupprimerTypeDemande.php");
	}
	
	//Si on click sur le boutton supprimer
	if(isset($_POST['supprimerTypeDemande']))
	{
	 $id = $_REQUEST['supprimerTypeDemande'];
	$reussi = supprimerTypeDemande($id);
	
	if($reussi = false):
		$message='Erreur Type demande non Supprimer';

 echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
		endif;
		
	}
	
	if(isset($_POST['ModifierTypeDemande']))
	{
	$type =ListeTypeDemande();

if($type != false):
foreach($type as $t):
 
$Lbl = $_REQUEST['LibelleDemande'.$t['IdDemande']];

$reussi = modifierTypeDemande($t['IdDemande'],$Lbl);
endforeach;
endif;	
	
	}
	
	
	
?>

<div class="contenu">
	
	
	
	<h2>
	Login : <?php echo $_SESSION["user"]; ?>
		</br>
		<h2 align="center">
		Consulter, ajouter et supprimer des types de demande
		</h2>
	</h2>
	</br>
	
<form method="POST" action="AjouterSupprimerTypeDemande.php"  onsubmit="return confirm('Etes vous sur de vouloir supprimer ou Modifier ce type de demande ?')">

		
		<br /><br />

		<table class="ficheCourante">
				
			<thead class="thead">
				
				
							
				<tr>
						
					<th>
						
						LibelleTypeDemande
						
					</th>
					
					
					
					<th>
						Ajouter/Supprimer
					</th>
					<th>
						Modifier
					</th>
					
					<th>
						Nombre fiche : <?php echo NombreTypeDemande(); ?>
					</th>
				</tr>
			
			</thead>
			
			<tbody>
			
<?php
$typeDemande = ListeTypeDemande();

if($typeDemande != false):
foreach($typeDemande as $t):

?>

			<tr>
				
				
				<td>
				
					<input class="modification" type="text" value="<?php echo $t['LibelleDemande']; ?>" name="LibelleDemande<?php echo $t['IdDemande']; ?>" />
				
				</td>
				
				
				<td class="tdIcone">
				
					<input type="submit" name="supprimerTypeDemande" class="suppression" value='<?php echo $t['IdDemande']; ?>'/>
				
				</td>
				
				<td>	
						<input type="submit"  align="center" class ="reporter" name="ModifierTypeDemande" value='<?php echo $t['IdDemande']; ?>'/>
						
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
<form method="POST" action="AjouterSupprimerTypeDemande.php" >

		
	

		<table class="TypeAjouterSupprimer">
		<tr>
<td>
				
					<input class="modification" type="text" value="" name="NouveauLibelleTypeDemande" />
				
				</td>
				<td class="tdIcone">
				
					<input type="submit" name="AjouterTypeDemande" class="ajouter" value=''/>
				
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