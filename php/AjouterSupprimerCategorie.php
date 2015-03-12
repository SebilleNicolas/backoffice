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
	if(isset($_POST['AjouterCategorie']))
	{
	
$LibelleCategorie= $_REQUEST['NouveauLibelleCategorie'];
		//création d'un Type
	$res = creeCategorie($LibelleCategorie);
	
		
		if($res = false):
		$message='Erreur Type non ajouter';

echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
		endif;
		if($res = true):
		$message='Vous avez ajouter un Type';

echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
		endif;
	
	
	}
	
	//Si on click sur le boutton supprimer
	if(isset($_POST['supprimerCategorie']))
	{
	 $id = $_REQUEST['supprimerCategorie'];
	$reussi = supprimerCategorie($id);
	
	if($reussi = false):
		$message='Erreur Type non Supprimer';

 echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
		endif;
		
	}
	
	if(isset($_POST['ModifierCategorie']))
	{
	$Categ =ListeCategorie();

if($Categ != false):
foreach($Categ as $c):
 
$Lbl = $_REQUEST['LibelleCategorie'.$c['IdCategorie']];

$reussi = modifierCategorie($c['IdCategorie'],$Lbl);

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
	


 <!-- <form method="POST" > action="AjouterSupprimerCategorie.php"  onsubmit="return confirm('Etes vous sur de vouloir supprimer ou Modifier cette categorie ?')"-->

		<form  method="POST" onsubmit = "return false;"> 
		<br /><br />

		<table class="ficheCourante">
				
			<thead class="thead">
				
				
							
				<tr>
						
					<th>
						
						LibelleCategorie
						
					</th>
					
					
					
					<th>
						Ajouter/Supprimer
					</th>
					<th>
						Modifier
					</th>
					
					<th>
						Nombre fiche : <span id="NbrFiche"> <?php echo NombreCategorie(); ?> </span>
					</th>
				</tr>
			
			</thead>
			
			<tbody id="newTR">
			
<?php
include 'ajax/Categ/tableau.php';

?>

<tr >

</tr>
				
		</tbody>
	</table>

</form>


	

		<table class="TypeAjouterSupprimer">
		<tr>
<td>
				
					<input class="modification" id="texte" type="text" value="" name="NouveauLibelleCategorie" />
				
				</td>
				<td class="tdIcone">
				
					<img id="Test" name="AjouterCategorieqzd" class="ajouter" value=''/>
				
				</td>
				<td>
				</td>
				</tr>
				</table>
				
				
		

	
</div>





<?php include'../html/Footer.html'; ?>
<?php }
else
{
header("Location: accueil.php");
} ?>