
<?php 
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
	
	
	
	if(isset($_POST['ConsulterAction']))
	{
	$idSociete = $_POST['ConsulterAction'];
			header("Location: ListeActionParSociete.php?idSociete=$idSociete");
	}
	
	


$rechercher = $_GET['search'];
$tel=0;
$adr = rechercheNomSociete($rechercher);


$tel = rechercheTelephone($rechercher);

if(isset($_REQUEST['rechercherEPA'])){

$EPA= rechercheparEPA($rechercher);

}

//Si on click sur le bouton ajouter
	if(isset($_POST['AjouterAction']))
	{

				$id = $_REQUEST['AjouterAction'];
				
				$PremierIdType = recupererPremierIdType();
				$PremierIdCategorie = recupererPremierIdCategorie();
				
				
				$NumAction = recupererDernierIdActions()+1;
				// var_dump($NumAction);
					//création d'une action
				$res = creeActions($NumAction,$id,$_SESSION["id"],$PremierIdType,$PremierIdCategorie);
				// var_dump($res);
					

					if($res = false):
					$message='Erreur fiche non ajouter';

				echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
					endif;
					if($res = true):
					$message='Vous avez ajouter une action';

				echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
					endif;
				
				header("Location: AjouterAction.php?id=".$id."&IdInter=");
	}
	
	
	if(isset($_POST['supprimerFiche']))
	{
	$id = $_REQUEST['supprimerFiche'];
	$reussi = supprimerFiche($id);
	header("Location: ConsulterFiche.php");
	}

?>




<body>
<div class="contenu">
<h2 align="center"> <u> Resultat  de  la  recherche     :</u>       '<?php echo "      ".$_GET['search'];?>' </h2>
</br></br></br>

	<?php 
	if(isset($_REQUEST['rechercherEPA'] )):
	if( $_REQUEST['rechercherEPA']== '1'):
	?>
	<form method="POST" >
<table class="ficheCourante" align= "center">
	<thead class="thead">
		<th>
			IdAction
		</th>
		<th>
			IdFiche
		</th>
		<th>
			NomSociété
		</th>
		<th>
			NumAction
		</th>
		
		<th>
			Consulter
		</th>
		<th>
			Supprimer
		</th>
		
	</thead>


<?php foreach($EPA as $a):
?>
<tbody id="tbodyConsultActions">
<tr>
<td>
<span id="IdAction"> <?php echo $a['idActions']; ?></span>
</td>
<td>
<span id="FicheSocieteR"> <?php echo $a['idFiche']; ?> </span>
</td>
<td>
<?php $nom=RecupererNomSociete($a['idFiche']); echo $nom; ?>
</td>
<td>
<?php echo $a['NumAction']; ?>
</td>



<td class="tdIcone">
				
					<img onclick="ConsulterActions(<?php echo $a['idActions']?>,<?php echo $a['idFiche']; ?>)" name="ConsulterModifierAction" value="<?php echo $a['idActions']?> "  style=" border: none; height: 35px; width: 32px; box-shadow: none;margin-left: 35px;" src="../images/eyes.png" /> 
				
				</td>
				<td class="tdIcone">
				
					<img onclick="SupprimerActions()" name="supprimerFiche" style=" border: none; height: 35px; width: 32px; box-shadow: none;margin-left: 35px;" src="../images/supprimer.png" value="<?php echo $a['idActions']?>"/>
				
				</td>
			
</tr>
</tbody>
<?php endforeach; ?>
</table>
</form>
	
	
	
	
	
	
	<?php endif; else:
	if(count($adr) > 0): ?>
	<h2 align="center">  NomSociete :  </h2>

<form method="POST" >
<table class="ficheCourante" align= "center">
	<thead class="thead">
		<th>
			Nom Societe
		</th>
		<th>
			Adresse
		</th>
		<th>
			Code Postal
		</th>
		<th>
			Ville
		</th>
		<th>
			Telephone
		</th>
		<th>
			Nombres Actions
		</th>
		<th>
			Consulter
		</th>
		<th>
			Supprimer
		</th>
		<th>
			Ajouter
		</th>
	</thead>


<?php foreach($adr as $a):
?>
<?php 

$pdo = connexion();
	
	if($pdo != false)
	{
			$NomS = $a['NomSociete'];
		$req = "	select id from fichesociete where NomSociete like '%$NomS%'
					
					
				";
		
		$res = $pdo -> query($req)->fetchall();
		$idF = $res[0][0];
		
			$req = "	select count(*) from actions where idFiche = $idF					
				";
		
		$resultat = $pdo -> query($req)->fetchall();
		
		$NbrA = $resultat[0][0];
		
	}

?>
<tr>
<td>
<?php echo $a['NomSociete']; ?>
</td>
<td>
<?php echo $a['Adresse']; ?>
</td>
<td>
<?php echo $a['CodePostal']; ?>
</td>
<td>
<?php echo $a['Ville']; ?>
</td>
<td>
<?php echo $a['Telephone']; ?>
</td>
<td>
<?php echo $NbrA; ?>
</td>


<td class="tdIcone">
				
					 <input type="submit" name="ConsulterAction" class="consulter" value='<?php echo $a['id']; ?>'/>
				
				</td>
				<td class="tdIcone">
				
					<img onclick="SupprimerFicheConsulterFiche(<?php echo $a['id']?> )" name="supprimerFiche" style=" border: none; height: 35px; width: 32px; box-shadow: none;margin-left: 35px;" src="../images/supprimer.png" value="<?php echo $a['id']?>"/>
				
				</td>
				<td class="tdIcone">
				
					<input type="submit" name="AjouterAction" class="ajouter" value='<?php echo $a['id']; ?>'/>
				
				</td>
</tr>
<?php endforeach; ?>
</table>
</form>
<?php endif; ?>


</br></br></br></br>

<?php if(count($tel) > 0): ?>
<h2 align="center">  Telephone :  </h2>
<form method="POST">
		<table class="ficheCourante" align= "center">
			<thead class="thead">
				<th>
					Nom Societe
				</th>
				<th>
					Adresse
				</th>
				<th>
					Fixe
				</th>
				<th>
					Mobile
				</th>
				<th>
					Nom Interlocuteur
				</th>
				<th>
					Nombre Actions
				</th>
				<th>
					Consulter
				</th>
				<th>
					Supprimer
				</th>
				<th>
					Ajouter
				</th>
			</thead>
		<?php foreach($tel as $t):
		?>
				<tr>
					<td>
						<?php echo $t['NomSociete']; ?>
					</td>
					<td>
						<?php echo $t['Adresse']; ?>
					</td>
					<td>
						<?php echo $t['Telephone']; ?>
					</td>
					<td>
						<?php echo $t['TelMobileI']; ?>
					</td>
					<td>
						<?php echo $t['NomI']; ?>
					</td>
					<td>
					<?php echo NombreActionInter($t['IdInterlocuteur']); ?>
					</td>
					<td class="tdIcone">
									
										 <input type="submit" name="ConsulterAction" class="consulter" value='<?php echo $t['id']; ?>'/>
									
					</td>
					
					<td class="tdIcone">
				
					<img onclick="SupprimerFicheConsulterFiche(<?php echo $t['id']?> )" name="supprimerFiche" style=" border: none; height: 35px; width: 32px; box-shadow: none;margin-left: 35px;" src="../images/supprimer.png" value="<?php echo $t['id']?>"/>
				
				</td>
				<td class="tdIcone">
				
					<input type="submit" name="AjouterAction" class="ajouter" value='<?php echo $t['id']; ?>'/>
				
				</td>
				</tr>
		<?php endforeach; ?>
		</table>
</form>
		<?php endif;  endif;?>

<?php if(count($tel) == 0 && count($adr) == 0): ?>  
<p align="center">
Il n'y a pas de resultat a votre recherche
</p>
<?php endif; ?>

</div>
</body>

</html><?php include '../html/Footer.html';?>
<?php }
else
{
header("Location: accueil.php");
} ?>