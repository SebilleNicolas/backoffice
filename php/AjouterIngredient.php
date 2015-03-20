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
	if($_REQUEST['NouvelleIngredient'] == ""){
	$message='Erreur: Vous devez ajouter un Nom au nouvelle ingredient.';
	echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
	}
	else{
	
			
		$NomIngredient = $_REQUEST['NouvelleIngredient'];

		//création de l'ingredient 

		$reussi = creeIngredient($NomIngredient);

		if($reussi = false){$message='Erreur Ingredient non ajouter'; echo '<script type="text/javascript">window.alert("'.$message.'");</script>';}
		
		
		if($reussi = true){$message='L Ingredient a été ajouter'; echo '<script type="text/javascript">window.alert("'.$message.'");</script>';}
		
	
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
		Ajouter Ingrédient
		</h2>
	</h2>
	</br>



</br></br>

</br></br>
<form method="POST" action="AjouterIngredient.php">
	<table class="ficheCourante" align="center">

		<thead class="thead">			
			<tr>
				<th>
					Ingredient
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
				<input type="text"  style="width: 220px;" name="NouvelleIngredient" class="modification" />
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
