
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
	
	if($_SESSION["statut"] == "Visiteur")
	{
	
	if(isset($_POST['ConsulterAction']))
	{
	$idSociete = $_POST['ConsulterAction'];
			header("Location: ListeActionParSocieteVisiteur.php?idSociete=$idSociete");
	}
	
	


$rechercher = $_GET['search'];
$tel=0;
$adr = rechercheNomSociete($rechercher);


$tel = rechercheTelephone($rechercher);

if(isset($_REQUEST['rechercherEPA'])){

$EPA= rechercheparEPA($rechercher);

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
	
		
	</thead>


<?php foreach($EPA as $a):
?>
<tbody id="tbodyConsultActions">
<tr>
<td>
<span id="IdAction"> <?php echo $a['idActions']; ?></span>
</td>
<td>
<span id="FicheS"> <?php echo $a['idFiche']; ?> </span>
</td>
<td>
<?php $nom=RecupererNomSociete($a['idFiche']); echo $nom; ?>
</td>
<td>
<?php echo $a['NumAction']; ?>
</td>



<td class="tdIcone">
				
					<img onclick="ConsulterActionsVisiteur(<?php echo $a['idActions']?>)" name="ConsulterModifierAction" value="<?php echo $a['idActions']?> "  style=" border: none; height: 35px; width: 32px; box-shadow: none;margin-left: 35px;" src="../images/eyes.png" /> 
				
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
			Consulter
		</th>
		
	</thead>


<?php foreach($adr as $a):
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


<td class="tdIcone">
				
					 <input type="submit" name="ConsulterAction" class="consulter" value='<?php echo $a['id']; ?>'/>
				
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
					NomInterlocuteur
				</th>
				<th>
					NommbreActions
				</th>
				<th>
					Consulter
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
					
			
				</tr>
		<?php endforeach; ?>
		</table>
</form>
		<?php endif;  ?>

<?php if(count($tel) == 0 && count($adr) == 0): ?>  
<p align="center">
Il n'y a pas de resultat a votre recherche
</p>
<?php endif; endif; ?>

</div>
</body>

</html><?php include '../html/Footer.html';
}
else
{
header("Location: accueil.php");
}?>