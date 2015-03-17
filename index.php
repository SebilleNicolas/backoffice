<!-- Header de la page -->

<!DOCTYPE HTML>

<html>

	<head>
		
		<title>Spizza</title>
		
		<link rel="stylesheet" type="text/css" href="./css/General.css">
		
		<link rel="stylesheet" type="text/css" href="./css/Texte.css">
		
	</head>

	<body>

		<header>
			
			<a href="index.php" id="Accueil">
			
				<p>
				
					<!-- <img src="./images/logo.jpg"><br/> -->
					
					<h1>Spizza BackOffice</h1>
				
				</p>
			
			</a>

		
		</header>

<?php
	
	/*Accès à la page des fonctions php*/
	require_once('/php/_function.php');
	
	/*Vérification de l'existence des variables user et mdp*/
	if(isset($_REQUEST["user"]) && isset($_REQUEST["mdp"]))
	{
		// var_dump($_REQUEST);
		/*Vérification si le login et le mot de passe sont présent dans la base de données*/
		if(verification($_REQUEST["user"],$_REQUEST["mdp"]))
		{
		

		
			
			/*Commencement des sessions*/
			session_start();
			
			/*Sauvegarde du login*/			
			$_SESSION["user"] = $_REQUEST["user"];
			
			/*Sauvegarde du mot de passe*/
			$_SESSION["mdp"] = $_REQUEST["mdp"];
			
			/*Sauvegarde de l'authentification*/
			$_SESSION["auth"] = "authentifie";
			
		
			
			/*Sauvegarde de l'id de l'utilisateur*/
			$_SESSION['id'] = id($_SESSION["user"], $_SESSION["mdp"]);
			
			/*Passage à la page d'accueil*/
			header("Location: ./php/accueil.php");
		
		}
		else
		{
			
			/*Si le login et le mot de passe sont erroné on renvoit une erreur*/
			$erreur = true;
		
		}
		
	}

?>
	
		<div class="contenu">
		
		
		
			<form method="POST" class="form" action="index.php">
			
				<h2>Connexion :</h2>
				
				<table class="connexion">
					
					<tr class="connexion">
					
						<td class="connexion">
						
							Identifiant
						
						</td>
						
						<td class="connexion">
						
							<input type="text" name="user" required/>
						
						</td>
						
					</tr>
					
					<tr class="connexion">
					
						<td class="connexion" >
						
							Mot de passe
						
						</td>
						
						<td class="connexion">
						
							<input type="password" name="mdp" required/>
						
						</td>
						
						
					</tr>
					
<?php
	
	/*Si la variable erreur existe on affiche le message d'erreur*/
	if(isset($erreur)):

?>
					
					<tr>
						
						<td class="connexion">
							
							Votre login ou votre mot de passe est erroné.
							
						</td>
						
					</tr>
					
<?php

	endif;

?>					
	<tr class="connexion">
					
						<td colspan="2" class="connexion">
						<div class="button">
							<input type="submit" value="Valider" />
						</div>
						</td>
										
					</tr>
				
				</table>
				
			</form>
		
		</div>
	
<!-- Footer -->

		<footer>
		

		
		</footer>
	</body>

</html>
