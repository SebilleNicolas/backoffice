<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php



	//Démarrage des sessions
	session_start();
	
	//inclusion du header
	include '../html/Header.html';
	
	//inclusion de la page de fonction php
	require_once('_function.php');
	
	include '../html/menuAdministrateur.html';
		
		
		
		
	if(isset($_POST['dd']))
	{
	// var_dump($_REQUEST['NouvellePizza']);
	if($_REQUEST['NouvellePizza'] == ""){
	$message='Erreur: Vous devez ajouter un Nom a la nouvelle pizza.';
	echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
	}
	else{
	
	
		$NomPizza = $_REQUEST['NouvellePizza'];
		// Mettre le name dans le input type file *****************************************************************************
		// $Image = $_REQUEST['NouvelleImage'];
		$Ingredient = $_REQUEST['NouveauIngredient'];
		$Prix = $_REQUEST['NouveauPrix'];
		
		
		
		//création de la pizza 
		$reussi = creePizza($NomPizza, $Ingredient, $Prix);

		if($reussi = false){$message='Erreur fiche non ajouter';}
		
		
		if($reussi = true){$message='La fiche a été ajouter';}
		

		// echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
		
		
		

	// header("Location:  AjouterPizza.php?id=".$id."&IdInter=");
	// header("Location:  AjouterPizza.php");
	
	}
	}
	
	
?>

<div class="contenu" >
	<!-- lien vers le haut de page -->
<!-- les liens vers les ancres sont toujours précédés du symbole # -->
<div id="hautpage"> </div>


	<h2>
	Login : <?php echo $_SESSION["user"];  //var_dump( $_SESSION);?>
		</br>
		<h2 align="center">
		Ajouter pizzas
		</h2>
	</h2>
	</br>



</br></br>

</br></br>
<form method="POST" action="AjouterPizza.php">
	<table class="ficheCourante" align="center">

		<thead class="thead">			
			<tr>
				<th>
					Pizza
				</th>
				<th>
					Image
				</th>
				<th>
					Ingredient
				</th>
				<th>
					Prix
				</th>
				<th>
					Ajouter
				</th>
				<th>
					Supprimer
				</th>
			</tr>
		</thead>
		<tbody>
		
			<tr>
				<td>
				<input type="text"  style="width: 220px;" name="NouvellePizza" class="modification" />
				</td>
				<td>
				<input type="file" name="nom" />
				
				</td>
				<td>
				<input type="text"  style="width: 220px;" name="NouveauIngredient" class="modification" />
				</td>
				<td>
				<input type="text"  style="width: 220px;" name="NouveauPrix" class="modification" />
				</td>
				<td>
				
				
				<input type="submit" name="dd" class="ajouter" />
				</td>
				<td>
				<input type="submit" name="supprimerPizza" class="ButAnu" />
				</td>
				
				
			</tr>
		
		</tbody>
		
	</table>
</form>
