 <?php
	// if(isset($_GET['q']))
	// {
		// INSERT
	
	
		// echo("<tr> <td>" . $_GET['q'] . "</td></tr>");
	// }
// ?>

<?php
//inclusion de la page de fonction php
	require_once('../../_function.php');
	
	
	
		// echo(var_dump($_GET));exit;
	if(isset($_GET['q']))
	{
		
		
		$pdo = connexion();
	$text = $_GET['q'];
		$req= " insert into categorie values(null, '".$text."')";
		
		$result = $pdo->exec($req);
		
		$req="Select max(IdCategorie) as IdCate from categorie";
		$res = $pdo->query($req)->fetch(); 
		// var_dump($res);exit;
		$idAction = $res['IdCate'];
		include 'tableau.php';
		
	
		
		
		
	}
	
	
	
	 
	 
?>
