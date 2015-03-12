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
	if(isset($_POST['AjouterMotifs']))
	{
	
$LibelleMotifs= $_REQUEST['NouveauLibelleMotifs'];
		//création d'un Type
	$res = creeMotifs($LibelleMotifs);
	
		
		if($res = false):
		$message='Erreur Type non ajouter';

echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
		endif;
		if($res = true):
		$message='Vous avez ajouter un Motifs';

echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
		endif;
	
	
	}
	
	//Si on click sur le boutton supprimer
	if(isset($_POST['supprimerMotifs']))
	{
	 $id = $_REQUEST['supprimerMotifs'];
	$reussi = supprimerMotifs($id);
	
	if($reussi = false):
		$message='Erreur Type non Supprimer';

 echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
		endif;
		
	}
	
	if(isset($_POST['ModifierMotifs']))
	{
	$Motifs =ListeMotifs();

if($Motifs != false):
foreach($Motifs as $c):
 
$Lbl = $_REQUEST['LibelleMotifs'.$c['IdMotifs']];

$reussi = modifierMotifs($c['IdMotifs'],$Lbl);

endforeach;
endif;	
	
	}
	
	
	
?>

<div class="contenu">
	
	
	
	<h2>
	Login : <?php echo $_SESSION["user"]; ?>
		</br>
		<h2 align="center">
		Consulter, ajouter et supprimer des Categories
		</h2>
	</h2>
	</br>
	
<form method="POST" action="AjouterSupprimerMotifs.php"  onsubmit="return confirm('Etes vous sur de vouloir supprimer ou Modifier ce Motifs?')">

		
		<br /><br />

		<table class="ficheCourante">
				
			<thead class="thead">
				
				
							
				<tr>
						
					<th>
						
						LibelleMotifs
						
					</th>
					
					
					
					<th>
						Ajouter/Supprimer
					</th>
					<th>
						Modifier
					</th>
					
					<th>
						Nombre motifs : <?php //echo NombreCategorie(); ?>
					</th>
				</tr>
			
			</thead>
			
			<tbody>
			
<?php
$Motifs = ListeMotifs();

if($Motifs != false):
foreach($Motifs as $m):

?>

			<tr>
				
				
				<td>
				
					<input class="modification" style="width: 300px "  type="text" value="<?php echo $m['LibelleMotifs']; ?>" name="LibelleMotifs<?php echo $m['IdMotifs']; ?>" />
				
				</td>
				
				
				<td class="tdIcone">
				
					<input type="submit" name="supprimerMotifs"  class="suppression" value='<?php echo $m['IdMotifs']; ?>'/>
				
				</td>
				
				<td>	
						<input type="submit"  align="center" class ="reporter" name="ModifierMotifs" value=''/>
						
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
<form method="POST" action="AjouterSupprimerMotifs.php" >

		
	

		<table class="TypeAjouterSupprimer">
		<tr>
<td>
				
					<input class="modification" type="text" value="" name="NouveauLibelleMotifs" />
				
				</td>
				<td class="tdIcone">
				
					<input type="submit" name="AjouterMotifs" class="ajouter" value=''/>
				
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