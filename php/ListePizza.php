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
	
	
?>

<div class="contenu" >
	<!-- lien vers le haut de page -->
<!-- les liens vers les ancres sont toujours précédés du symbole # -->
<div id="hautpage"> </div>


	<h2>
	Login : <?php echo $_SESSION["user"];  //var_dump( $_SESSION);?>
		</br>
		<h2 align="center">
		Consulter la liste des pizzas
		</h2>
	</h2>
	</br>


Liste des pizzas :
</br></br>
Ajouter</br><img class="icone" src="../images/ajouter.png"/>
</br></br>
<?php ?> 
<table class="ficheCourante">
	<thead class="thead">			
		<tr>
			<th>
				Pizzazz
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
		</tr>
	</thead>
	<tbody>
	<?php 
	$ListePizza = listePizza();
	// var_dump ($ListePizza);exit;
	for ($i = 0; $i < count($ListePizza); $i++) { 
	?>
		<tr>
			<td>
		
			<?php echo $ListePizza[$i]["NomPizza"]?> 
			</td>
			<td>
			
			<img src="<?php echo $ListePizza[$i][3]?>"/>
			</td>
			<td>
			
			</td>
			<td>
			<?php echo $ListePizza[$i][2]?> 
			</td>
			<td>
			
			<img class="icone" src="../images/modifier.png"/>
			</td>
			<td>
			<img class="icone" src="../images/supprimer2.jpg"/>
			</td>
		</tr>
	<?php } ?>
	</tbody>
	
</table>