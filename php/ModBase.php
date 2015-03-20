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
		
if(isset($_POST['dd'])){
		
	$affiche = $_POST['liste'];
	}
	else{
	$affiche = "";
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
		Modification de la base
		</h2>
	</h2>
	</br>

Liste des <form method="POST" action="ModBase.php">
<select name="liste">
<option value="" selected> </option>
<option type="text" value="Pizza">Pizza</option>
<option value="Ingredient">Ingredient</option>
<option value="Panini">Panini</option>
<option value="Dessert">Dessert</option>
</select>

<input type="submit" name="dd" class="ajouter" />
</form>
<?php
switch ($affiche) {
    case "Pizza":
        echo '</br></br>
			Ajouter</br><img class="icone" src="../images/ajouter.png"/>
			</br></br>
<table class="ficheCourante">
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
		</tr>
	</thead>
	<tbody>"';

	$ListePizza = listePizza();

	for ($i = 0; $i < count($ListePizza); $i++) {

	echo '		"<tr>
			<td>';
		
			echo $ListePizza[$i]["NomPizza"]; 
	echo '		</td>
			<td>
			
			<img src="';
			echo $ListePizza[$i][3];
			echo' "/>
			</td>
			<td>
			
			</td>
			<td>';
			echo $ListePizza[$i][2];
			echo '</td>
			<td>
			
			<img class="icone" src="../images/modifier.png"/>
			</td>
			<td>
			<img class="icone" src="../images/supprimer2.jpg"/>
			</td>
		</tr>'; }

	echo '</tbody>
			</table>' ;		
        break;
    case "Ingredient":
        echo '</br></br>
			Ajouter</br><img class="icone" src="../images/ajouter.png"/>
			</br></br>
<table class="ficheCourante">
	<thead class="thead">			
		<tr>
			<th>
				Ingredient
			</th>
		</tr>
	</thead>
	<tbody>"';
        break;
	case "":
        echo "";
        break;

}
?>



	


		
	
