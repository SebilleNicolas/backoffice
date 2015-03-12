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
	if(isset($_POST['AjouterEPA']))
	{
	
$LibelleEPA= $_REQUEST['NouveauLibelleEPA'];
$CodeEPA = $_REQUEST['NouveauCodeEPA'];
		//création d'un EPA
	$res = creeEPA($CodeEPA,$LibelleEPA);
	
		
		if($res = false):
		$message='Erreur Type non ajouter';

echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
		endif;
		if($res = true):
		$message='Vous avez ajouter un Etat Prochaine Action';

echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
		endif;
	
	// header("Location: AjouterSupprimerType.php");
	}
	
	//Si on click sur le boutton supprimer
	if(isset($_POST['supprimerEPA']))
	{
	 $id = $_REQUEST['supprimerEPA'];
	$reussi = supprimerEPA($id);
	
	if($reussi = false):
		$message='Erreur EPA non Supprimer';

 echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
		endif;
		
	}
	
	if(isset($_POST['ModifierEPA']))
	{
	$EPA =ListeEtatProchaineAction();

if($EPA != false):
foreach($EPA as $t):
 
$Lbl = $_REQUEST['LibelleEPA'.$t['IdEtatProchaineAction']];
$CodeEPA = $_REQUEST['CodeEPA'.$t['IdEtatProchaineAction']];
$reussi = modifierEPA($t['IdEtatProchaineAction'],$CodeEPA,$Lbl);
endforeach;
endif;	
	
	}
	
	
	
?>

<div class="contenu">
	
	
	
	<h2>
	Login : <?php echo $_SESSION["user"]; ?>
		</br>
		<h2 align="center">
		Consulter, ajouter et supprimer des Etats de prochaines actions
		</h2>
	</h2>
	</br>
	
<form method="POST" action="AjouterSupprimerEPA.php"  onsubmit="return confirm('Etes vous sur de vouloir supprimer ou Modifier l'etat de la prochaine action ?')">

		
		<br /><br />

		<table class="ficheCourante">
				
			<thead class="thead">
				
				
							
				<tr>
					<th>
						Code Etat Prochaine Action	
					</th>
						
					<th>
						Libelle Etat Prochaine Action	
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
			
			<tbody id="tbodyEtatPA">
			
<?php
$EtatPA = ListeEtatProchaineAction();

if($EtatPA != false):
foreach($EtatPA as $t):

?>

			<tr>
				<td class="espace">
				<TEXTAREA class="modification" wrap="virtual"  style="resize: none;" name="CodeEPA<?php echo $t['IdEtatProchaineAction']; ?>" rows="3" cols="20"><?php echo $t['CodeEPA']; ?></TEXTAREA>
					
				
				</td>
				
				<td class="espace">
				<TEXTAREA class="modification" wrap="virtual"  style="resize: none;" name="LibelleEPA<?php echo $t['IdEtatProchaineAction']; ?>" rows="3" cols="20"><?php echo $t['LibelleEPA']; ?></TEXTAREA>
					
				
				</td>
				
				
				<td class="tdIcone">
				
					<img onclick="SupprimerEtatProchaineAction(<?php echo $t['IdEtatProchaineAction']; ?>)" class="suppression" value='<?php echo $t['IdEtatProchaineAction']; ?>'/>
				
				</td>
				
				<td>	
						<input type="submit"  align="center" class ="reporter" name="ModifierEPA" value='Modifier'/>
						
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
<form method="POST" action="AjouterSupprimerEPA.php" >

		
	

		<table class="TypeAjouterSupprimer">
		<tr>
				<td>
					<TEXTAREA class="modification" wrap="virtual"  style="resize: none;" name="NouveauCodeEPA" rows="3" cols="20"></TEXTAREA>
					
				
				</td>
					<td>
					<TEXTAREA class="modification" wrap="virtual"  style="resize: none;" name="NouveauLibelleEPA" rows="3" cols="20"></TEXTAREA>
					
				
				</td>
				<td class="tdIcone">
				
					<input type="submit" name="AjouterEPA" class="ajouter" value=''/>
				
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
