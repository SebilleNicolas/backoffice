
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
	
	$rechercher = $_GET['search'];
$IdFicheSociete = $_GET['idFicheSociete'];
$Type = $_GET['type'];

	
	if(isset($_POST['ConsulterAction']))
	{
	$IDAction = $_POST['ConsulterAction'];
			header("Location: 2.php?idaction=$IDAction&id=$IdFicheSociete");
	}
	
	



$Nom = "";
if($Type == "1")
{
$Motifs = rechercheMotifs($rechercher,$IdFicheSociete);
// var_dump($Motifs);exit;
$idDuMotifs = $_GET['search'];
$NomMotifs = ListeMotifs();
foreach($NomMotifs as $NM):
if($NM['IdMotifs'] == $idDuMotifs){
$Nom = $NM['LibelleMotifs'];}
endforeach;
}
if($Type == "2")
{
$NumS = rechercheNumS($rechercher);
$Nom = $rechercher ;
// var_dump($NumS);exit;
}
else
{}




//Si on click sur le bouton ajouter
	if(isset($_POST['AjouterAction']))
	{				
				header("Location: AjouterAction.php?id=".$id."&IdInter=");
	}
	
	


?>




<body>
<div class="contenu">
<h2 align="center"> <u> Resultat  de  la  recherche     :</u>       '<?php echo "      ".$Nom;?>' </h2>
</br></br></br>

	<?php if($Type == "1"): if(count($Motifs) > 0): ?>
	<h2 align="center">  Motifs :  </h2>

<form method="POST" >
<table class="ficheCourante" align= "center">
	<thead class="thead">
		<th>
			IdNumSociete
		</th>
		<th>
			Numero Serie
		</th>
		<th>
			Id Actions
		</th>
	
		<th>
			Consulter
		</th>
	
	
	</thead>


<?php foreach($Motifs as $id): ?>
<tr>
<td>
<?php echo $id['IdNumSerie']; ?>
</td>
<td>
<?php echo $id['NumeroSerie'];?>
</td>
<td>
<?php echo $id['IdActions']; ?>
</td>


<td class="tdIcone">
				
					 <input type="submit" name="ConsulterAction" class="consulter" value='<?php echo $id['IdActions']; ?>'/>
				
				</td>
				
			
</tr>
<?php endforeach; ?>
</table>
</form>
<?php endif; endif; ?>


</br></br></br></br>

<?php if($Type == "2"): if(count($NumS) > 0): ?>
<h2 align="center">  Numero De Serie :  </h2>
<form method="POST">
		<table class="ficheCourante" align= "center">
			<thead class="thead">
				<th>
					ID Num Serie
				</th>
				<th>
					Numero De Serie
				</th>
				<th>
					IdActions
				</th>
				<th>
					Consulter
				</th>
				
				
				
			</thead>
		<?php foreach($NumS as $NS):
		?>
				<tr>
					<td>
						<?php echo $NS['IdNumSerie']; ?>
					</td>
					<td>
						<?php echo $NS['NumeroSerie']; ?>
					</td>
					<td>
						<?php echo $NS['IdActions']; ?>
					</td>
				
					
					<td class="tdIcone">
									
										 <input type="submit" name="ConsulterAction" class="consulter" value='<?php echo $NS['IdActions']; ?>'/>
									
					</td>
					
				</tr>
		<?php endforeach; ?>
		</table>
</form>
		<?php endif; endif; ?>

<?php if($Type == "1"):  if(count($Motifs) == 0): ?>  
<p align="center">
Il n'y a pas de resultat a votre recherche
</p>
<?php endif; endif;
 if($Type == "2"):  if(count($NumS) == 0):?>
 <p align="center">
Il n'y a pas de resultat a votre recherche
</p>
<?php endif; endif;?>

</div>
</body>

</html><?php include '../html/Footer.html';?>
<?php }
else
{
header("Location: accueil.php");
} ?>