
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
	
	$NomSociete = RecupererNomSociete($_GET['idFicheSociete']);
	$idFS =$_GET['idFicheSociete'];
	// var_dump($idFS);exit;
	if(isset($_POST['RechercheParMotifs']))
	{
	// var_dump($_POST);exit;
	$idFicheSociete = $_POST['RechercheParMotifs'];
		$Motif=$_POST['ListeMotifs'];
			header("Location: RechercheAction.php?type=1&search=$Motif&idFicheSociete=$idFS");
	}
	if(isset($_POST['RechercheParNumeroDeSerie']))
	{
	
	$idFicheSociete = $_POST['RechercheParNumeroDeSerie'];
	$NumS=$_POST['rechercheNumSerie'];
			header("Location: RechercheAction.php?type=2&search=$NumS&idFicheSociete=$idFS");
	}
?>


<body>
<div class="contenu">

<h2> Societe : <?php echo $NomSociete; ?> </h2> 
<h2> NumeroSociete : <span id="idFicheSociete"> <?php echo $_GET['idFicheSociete']; ?> </span></h2> </br></br></br>

<form method="post">
<table class="ficheCourante">
<th></th>
<th>

				<select name="ListeMotifs" >
				<?php 
				$motif = ListeMotifs();
				foreach($motif as $m):
				?>
				<option value="<?php echo $m['IdMotifs'];?>"><?php echo $m['LibelleMotifs'];?></option>
				<?php endforeach; ?>
				</select>
				
		<input type="submit" name="RechercheParMotifs" class="bouton_recherche2"    value="<?php $_GET['idFicheSociete'];?>"/>
</th>
<th></th><th></th><th></th>
<th>

<div id="zone_recherche">
			<p> Recherche par Numero de serie  : </p>
			<input id="texte_recherche"  name="rechercheNumSerie" type="text" value="<?php //echo $ValueAdr;?>" />
			<input type="submit" name="RechercheParNumeroDeSerie" id="RechercheParNumeroDeSerie" class="bouton_recherche"   value="<?php $_GET['idFicheSociete'];?>"/>
		</div>

</th>
</table>
</form>

<div id="TableauRechercheActionParReference">


</div>
</div>
</body>
</html><?php include '../html/Footer.html';?>
<?php }
else
{
header("Location: accueil.php");
} ?>