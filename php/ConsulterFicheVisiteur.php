<?php

/**
 * Page qui permet au comptable de choisir un mois à partir d'un visiteur pour valider une fiche
**/

	//Démarrage des sessions
	session_start();
	
	//inclusion du header
	include '../html/Header.html';
	
	//inclusion de la page de fonction php
	require_once('_function.php');
	
	
	//Vérification de l'authentification
	verificationAuthentification();
	// $rechercheAdresse = false;
	$rechercheTelephone = false;
	$adr="";
	//Détermination du menu pour l'utilisateur
	menu($_SESSION["statut"]);

	if($_SESSION["statut"] == "Visiteur")
	{
	

	if(isset($_POST['ConsulterActionVisiteur']))
	{var_dump($_POST);
	$id = $_REQUEST['ConsulterActionVisiteur'];
	header("Location: ConsulterActionVisiteur.php?id=$id");
	}
	
	if(isset($_POST['BoutonRechercheNomSociete']))
	{
		
		$NomSociete = $_POST['SelectionSociete'];
		header("Location: ConsulterActionVisiteur.php?id=$NomSociete");
	}
	
	if(isset($_POST['BoutonRechercheEPA']))
	{
			
		$rechercher =htmlentities( $_POST['SelectionEPA']);

		// var_dump($_POST);var_dump($type);exit;
		header("Location: RechercheFicheSocieteVisiteur.php?search=$rechercher&rechercherEPA=1");

	}
	
	if(isset($_POST['BoutonShearchAdresse']))
	{ $rechercher =htmlentities( $_POST['rechercheAdresse']);
	
	header("Location: RechercheFicheSocieteVisiteur.php?search=$rechercher");
	

	}	
	
	
	if(isset($_POST['BoutonShearchTelephone']))
	{
		
	$rechercher =htmlentities( $_POST['rechercheTelephone']);
	
	
	// var_dump($_POST);var_dump($type);exit;
	header("Location: RechercheFicheSocieteVisiteur.php?search=$rechercher");

	
	
	}
	
	$fiche = listeFicheparOC($_SESSION['id']);
	$ListeEPA = ListeEtatProchaineAction();
?>

<div class="contenu">
	<div id="hautpage"> </div>
	
	
	<h2>
	Login : <?php echo $_SESSION["user"]; ?>
		</br>
		<?php  ?>
		<h2 align="center">
		Consulter les fiches de societe et les actions d'une societe selectionne
		</h2>
	</h2>
	</br>
	<!--action="2.php?search=<?php //echo $rechercher; ?>" id="BoutonShearchAdresse"		src="bouton_recherche.png"-->
	
	<form method="POST" action="">
	
	<table class="ficheCourante" align="center">

	<th>
	<?php //if($rechercheAdresse == true): $ValueAdr = $_GET['search']; endif; if($rechercheAdresse == false):  $ValueAdr = ""; endif;?>
		<div id="zone_recherche">
			<p> NomSociete  : </p>
			<input id="texte_recherche"  name="rechercheAdresse" type="text" value="<?php //echo $ValueAdr;?>" />
			<input  name="BoutonShearchAdresse" class="bouton_recherche" type="submit"  alt="Rechercher" value="1"/>
		</div>
	</th>
	<th>   </th>
	<th>   </th> 
	<th>
		<div id="zone_recherche" class="RechercheTele" >
			<p> Telephone : </p> 
			<input id="texte_recherche" name="rechercheTelephone" type="text" value=""  />
			<input name="BoutonShearchTelephone" class="bouton_recherche" type="submit"  alt="Rechercher" value="2"/>
		
		</div>
	</th>
	</br></br></br></br>
	</table>
</form>
</br></br>
<form method="POST">
	<table class="ficheCourante">
<span style="margin-left: 1100px;"> Recherche par Etat prochaine actions :</span>
		<tr>
		<td>
		<span style="margin-left: 80px;"> Trier les fiches par ordre Alphabétique : <input type="checkbox" id="CheckBoxTrierFicheOrdreCroissantVis" /></span>
		</td>
		<td >
		<span style="margin-left: 80px;"> Trier les fiches par Nombre d'actions : <input type="checkbox" id="CheckBoxTrierParNbrActionsVis" /> </span>
		</td>
		
		<!--<a href="#"><div id="btntop" class='lien' ></div></a> 
	<a name="hautpage" id="hautpage"></a>-->
	<a href="#baspage"  ><img src="../images/flecheB.png" id="btndown"  /></a> 
	<a href="#hautpage"  ><img src="../images/flecheH.png" id="btntop"  /></a> 
		<td>
					<select name="SelectionSociete" style="margin-left: 80px;" >
						<?php 
						
						for ($i = 0; $i < count($fiche); $i++) {
								
											
					?>
					  <option value="<?php  echo $fiche[$i]['id'];?>"><?php  echo $fiche[$i]['NomSociete']; ?></option>
					  <?php } ?>
					</select> 
					<input name="BoutonRechercheNomSociete"  id="bouton_rechercheNS" type="submit"  alt="Rechercher" style=" margin-left: 170px; margin-top: -26px;" value=""/>
		</td>
		<td >
		<span style="margin-right:200px;">
							<select name="SelectionEPA">
					<?php 
					
					for ($i = 0; $i < count($ListeEPA); $i++) {
							
										
				?>
				  <option value="<?php  echo $ListeEPA[$i][0];?>"><?php  echo $ListeEPA[$i][2]; ?></option>
				  <?php } ?>
				</select></span>
					<input name="BoutonRechercheEPA"  id="bouton_rechercheEPA" type="submit"  alt="Rechercher" value=""/>
		</td>
		</tr>
	</table>
</form><br><br>
<form method="POST" action="ConsulterFicheVisiteur.php">

		
		<br /><br />

		<table class="ficheCourante" align="center">
				
			<thead class="thead">
				
				
							
				<tr>
						
					<th>
						Nom Societe
					</th>
						
				
						
					<th>
						Adresse	
					</th>
						
					<th>
						Code Postale
					</th>
					
					<th>
						Ville
					</th>
					<th>
						Telephone
					</th>
					
					<th>
					Nombre Action
					</th>
					<th>
						Nombre fiche : <?php echo NombreFicheConsulter($_SESSION['id']); ?>
					</th>
					
				</tr>
			
			</thead>
			
			<tbody id="tBodyConsulterFiche">
			
<?php
// if($adr==false):
$fiche = listeFicheVisiteur();

if($fiche != false ): //&& $rechercheTelephone == false && $rechercheAdresse == false
foreach($fiche as $f):

?>

			<tr>
				
				
				<td>
				
					<input class="modification" type="text" value="<?php echo $f['NomSociete']; ?>" name="NomSociete<?php echo $f['id']; ?>" disabled/>
				
				</td>
				
				<td>

					
				<TEXTAREA disabled  class="modification" wrap="virtual"  style="resize: none;" name="Adresse<?php echo $f['id']; ?>" rows="3" cols="20"><?php echo $f['Adresse']; ?></TEXTAREA>

				
				</td>
				
				<td>
				
					<input disabled class="modification" type="text" value="<?php echo $f['CodePostal']; ?>" name="CodePostal<?php echo $f['id']; ?>" disabled/>
				
				</td>
				
				<td>
				
					<TEXTAREA disabled class="modification"  style="resize: none;" name="Ville<?php echo $f['id']; ?>" rows="1" cols="20"><?php echo $f['Ville']; ?></TEXTAREA>
					
				</td>
				
				
				<td>
				
					<input disabled class="modification" type="text" value="<?php echo $f['Telephone']; ?>" name="Telephone<?php echo $f['id']; ?>" />
				
				</td>
				
				
				
				<td>
				
					<?php echo NombreActionAvecIdFIche($f['id']); ?>
				
				</td>
				<td class="tdIcone">
				
					 <input type="submit" name="ConsulterActionVisiteur" class="consulter" value='<?php echo $f['id']; ?>'/>
				
				</td>
				
			</tr>

<?php

			endforeach;
	
		endif;
		//if($rechercheTelephone == true || $rechercheAdresse == true):

?>
<!--
<P> Recherche validé </p> -->
<?php// endif; ?>



		</tbody>
	</table>
	
</form>



</div>



<div id="baspage"> </div>
<script>
tinymce.remove('textarea');
</script>
<?php include'../html/Footer.html'; 

	
}
else
{
header("Location: accueil.php");
}?>
