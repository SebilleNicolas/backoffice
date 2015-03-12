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
	//Supprime les actions qui n'ont pas de Etat Valide
	$pdo=connexion();
	if($pdo != null)
	{
			$req="Delete from actions where EtatValide = 0";
	$pdo->exec($req);		
	}
	//Vérification de l'authentification
	verificationAuthentification();
	
	
	//Détermination du menu pour l'utilisateur
	menu($_SESSION["statut"]);
	if($_SESSION["statut"] == "Administrateur")
	{
	
	if(isset($_POST['ajoutNouvelleFiche']))
	{
	if($_POST['NouvelleFiche'] == ""){
	$message='Erreur: Vous devez ajouter un Nom a la nouvelle societe.';

echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
	}
	else{
	
	
		$NomSociete = $_REQUEST['NouvelleFiche'];
		
		$Adresse = $_REQUEST['NouvelleAdresse'];
		$CodePostal = $_REQUEST['NouveauCodePostal'];
		$Ville = $_REQUEST['NouvelleVille'];
		$Telephone = $_REQUEST['NouveauTelephone'];
		$email = $_REQUEST['NouveauEmail'];
		
		
		//création du frais
		$reussi = creeFiche($NomSociete, $Adresse, $CodePostal , $Ville,$_SESSION['id'],$Telephone,$email);
		if($reussi = false):
		$message='Erreur fiche non ajouter';

echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
		endif;
		if($reussi = true):
		$message='La fiche a été ajouter';
		
echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
		endif;
		
		$listeFiche = "
						SELECT MAX(id)
						FROM fichesociete
					";
					 // var_dump($fiche);exit;
		
		$result = $pdo -> query($listeFiche)->fetchall();
		
		$PremierIdType = recupererPremierIdType();
	$PremierIdCategorie = recupererPremierIdCategorie();
	
	$id = $result[0][0];
	$NumAction = recupererDernierIdActions()+1;
	
		//création d'une action
	$res = creeActions($NumAction,$id,$_SESSION["id"],$PremierIdType,$PremierIdCategorie);
	header("Location:  AjouterAction.php?id=".$id."&IdInter=");
	}
	}



?>

<div class="contenu">
	
<h2>
	
		Login : <?php echo $_SESSION["user"]; ?>
		
		</br>

	</h2>
	<h2 align = "center">
	
		Ajouter une nouvelle Fiche (société)
	
</br></br>
	</h2>
	<form method="POST" action="RenseignerNewFiche.php">

		
		<br /><br />

		<table class="ficheCourante" align="center">
				
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
						Email
					</th>
					<th>
						Ajouter
					</th>
					
				</tr>
			
			</thead>
			
			
			

			<tbody>
			
				<tr>
				
					<td>
					
						<input type="text" name="NouvelleFiche" class="modification" />
					
					</td>
					
					<td>
					
						<TEXTAREA class="modification"  style="resize: none;" name="NouvelleAdresse" rows="3" cols="20"></TEXTAREA>
					
					</td>
					
					<td>
					
						<input class="modification" type="text"  name="NouveauCodePostal" />
					
					</td>
					
				<td>
				<input class="modification" type="text"  name="NouvelleVille" />
					
					
				</td>
				<td>
					<input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" name="NouveauTelephone" max="10" class="modification" />  
					
						
					
					</td>
					<td>
					
						<input type="email" name="NouveauEmail" class="modification" />
					
					</td>
					<td class="tdIcone">
					
						<input type="submit" name="ajoutNouvelleFiche" class="ajouter" />
					
					</td>

				</tr>
			
			</tbody>
			
		</table>
		
		
	</form>

</div>


</html><?php include '../html/Footer.html';?>
<?php }
else
{
header("Location: accueil.php");
} ?>


