<?php

/**
 * Page montrant les précédentes fiches du visiteur
 * Il ne peut que visionner ses fiches
**/
	
	//Démarrage des sessions
	session_start();
	
	//inclusion du header
	include '../html/Header.html';
	
	
	
	//inclusion de la page de fonction php
	require_once('_function.php');;
	
	//Vérification de l'authentification
	verificationAuthentification();
	
	//Obtention du menu en fonction du statut
	menu($_SESSION["statut"]);
	if($_SESSION["statut"] == "Administrateur")
	{
	
	//Recupere l'ID de l'action
	 $IdAction = recupererDernierIdActions();
	
	//Recupere la liste des Type de demande
	$ListeTypeDemande = ListeTypeDemande();
	
	//Recupere le nom de la societe avec l'idFicheSociete
	$NomSociete = RecupererNomSociete($_GET['id']);
	
	//Recupere la liste des Techniciens
	$ListeTechnicien = ListeTechnicien();
	
		//Recupere la liste des Techniciens
	$ListeType = ListeType();
	
	
	//Recupere la liste des Techniciens
	$ListeCategorie = ListeCategorie();
	
	//Recupere L'etat de l'action
	$Etataction = EtatAction($IdAction);
	
	//Recupere la liste des actions de la Societe en cours
	$FicheEC = listeActionParIdFiche($_GET['id']);

	
	if(isset($_POST['ConsulterModifierAction']))
	{
	$id = $_POST['ConsulterModifierAction'];
			header("Location: 2.php?idaction=$id&id=".$_GET['id']);
	}
	$idFiche = $_GET['id'];
	if(isset($_POST['supprimeraction']))
	{
	$id = $_POST['supprimeraction'];
	$res = SupprimerAction($id); 
	
	header("Location: ConsulterAction.php?id=".$idFiche);
	
	
	
		// $message='Voulez vous vraiment supprimer cette action ?';

	// echo '<script type="text/javascript">d = confirm("'.$message.'"); 
	// if(d==true){ '$res = SupprimerAction($id); '}
	// else{ alert("NON"); }
	// </script>';
	
	
	// echo '<script type="text/javascript">  
	// if(d==true){}
	// else{ alert("NON"); }
	 // document.location.href = "./ConsulterAction.php?id='.$idFiche.'";
	// </script>';
	}
	
	
?>



<div class="contenu">

	<h2>
	<?php// var_dump(listeActionParIdFiche($_GET['id']));exit; ?>
		Login : <?php echo $_SESSION["user"]; ?></br>
		
		societe : <?php echo $NomSociete; ?></br>
		Id Societe : <span id="FicheS" > <?php echo $_GET['id']; ?> </span> </br>
		NombreAction : <span id="NbrActionConsultAction"> <?php echo NombreActionAvecIdFIche($_GET['id']); ?> </span>	
		
		<?php //var_dump($FicheEC);?>
	</h2>
	<?php if ($FicheEC != null): ?>
<form method="POST" >		<!--  action="AjouterAction.php?id=$id" -->

		
		<br /><br />

		<table class="ficheCourante">
				
			<thead class="thead">
				
				
							
				<tr>
					<th>
						
						IdAction
						
					</th>
					<th>
						
						Numero
						
					</th>
						
				
						
					<th>
						
						Date Debut
						
					</th>
						
					<th>
						Heure Debut
					</th>
					<th>
						Heure Fin
					</th>
					
					<th>
						Nom Interlocuteur
					</th>
					
					<th>
						Prenom Interlocuteur
					</th>
					<th>
					Consulter/Modifier
					</th>
					<th>
					Supprimer
					</th>
					
				</tr>
			
			</thead>
			
			<tbody id="tbodyConsultActions">
			<?php foreach($FicheEC as $f):
			$MinDeb = $f['MinuteDeb'];
			$MinFin =	$f['MinuteFin'];
				if($MinDeb < 10)
				{$MinDeb = "0".$MinDeb;}
				if($MinFin  != ""){
				if($MinFin < 10)
				{$MinFin = "0".$MinFin;	}}
				?>
			<tr>
			<td>
			<span id="IdAction"> <?php echo $f['IdActions']?> </span>
			</td>
			<td>
			<?php echo $f['NumAction']?> 
			</td>
			<td>
			<?php echo $f['DateDeb']?> 
			</td>
			<td>
			<?php echo $f['HeureDeb']?> : <?php echo $MinDeb; ?> 
			</td>
			<td>
			<?php echo $f['HeureFin']?> : <?php echo $MinFin; ?> 
			</td>
			<td>
			<?php echo $f['NomI']?> 
			</td>
			<td>
			<?php echo $f['PrenomI']?> 
			</td>
			<td class="tdIcone">
			<img onclick="ConsulterActions(<?php echo $f['IdActions']?>,<?php echo $_GET['id']; ?>)" name="ConsulterModifierAction" value="<?php echo $f['IdActions']?> "  style=" border: none; height: 35px; width: 32px; box-shadow: none;margin-left: 35px;" src="../images/Dossier.jpg" /> 
			</td>
			<td class="tdIcone">
				
					<img onclick="SupprimerActions(<?php echo $f['IdActions']?>)"name="supprimeraction"  style=" border: none; height: 35px; width: 32px; box-shadow: none;margin-left: 35px;" src="../images/supprimer.png" value='<?php echo $f['IdActions']; ?>'/>
				
				</td>
			</tr>
			<?php endforeach; ?>
			</tbody>
			<tfoot>
			
			</tfoot>
		</table>
		
		
	</form>
	
	<?php else: ?>
	<p>
		Il n'y a pas de resultat !
	</p>
	<?php endif; ?>
	</br>
	</br>

</div>





</div>

<?php include'../html/Footer.html'; ?>
<?php }
else
{
header("Location: accueil.php");
} ?>