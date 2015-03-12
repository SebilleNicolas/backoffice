<?php

	//Démarrage des sessions
	session_start();
	
	//inclusion du header
	include '../html/Header.html';
	
	
	
	//inclusion de la page de fonction php
	require_once('_function.php');
	//Supprime les actions qui n'ont pas de Etat Valide
	$pdo=connexion();
	if($pdo != null)
	{
			$req="Delete from actions where EtatValide = 0";
	$pdo->exec($req);		
	}
	//Vérification de l'authentification
	verificationAuthentification();
	
	//Obtention du menu en fonction du statut
	menu($_SESSION["statut"]);
	if($_SESSION["statut"] == "Administrateur")
	{
	
	//Recupere l'ID de l'action
	 $IdAction = recupererDernierIdActions();
	 
	//Id de la prochaine action
	$IdProchaineA = $IdAction + 1;
	
	//Recupere la liste des Type de demande
	$ListeTypeDemande = ListeTypeDemande();
	
	
	//Recupere la liste des Techniciens
	$ListeTechnicien = ListeTechnicien();
	
		//Recupere la liste des Techniciens
	$ListeType = ListeType();
	
	
	//Recupere la liste des EtatProchaineAction
	$ListeEPA = ListeEtatProchaineAction();
	
	
	//Recupere la liste des Techniciens
	$ListeCategorie = ListeCategorie();
	
	//Recupere L'etat de l'action
	$Etataction = EtatAction($IdAction);
	
	if(isset($_GET['rapport']))
	{
		if($_GET['rapport'] == 2)
		{
			header("Location: DLCheckB.php");
		}
	}

	if(isset($_POST['AjoutNouveauInterlocuteur']))
	{
	
	header("Location: AjouterSupprimerInterlocuteur1.php");
	
	}
	
$dateJourTest = date("N");
	$cpt = 0;
	for($i = $dateJourTest; $i != 1; $i--)
	{
		$cpt++;
	}	
	$dateFin = $cpt;
	$dateFin += 2;
	$dateFin = date("d") - $dateFin;
	
	$cpt= $cpt + 7;
	
		$date= date_create(date("Y-m-d"));
		date_sub($date,date_interval_create_from_date_string($cpt." days"));
$ContenuActionCL = recupererActionsPeriodeDefaultCL();
$ContenuActionEC= recupererActionsPeriodeDefaultEC();



if(isset($_POST['ddd']))
	{
	  $DateDebConsult = $_POST['DateDebConsult'];
	$DateFinConsult = $_POST['DateFinConsult'];
	header("Location: DL.php?DateDebConsult=$DateDebConsult&DateFinConsult=$DateFinConsult");
	
		}
		
		
		
		if(isset($_POST['afficherTableau']))
	{
		if(isset($_POST['CheckBAction']))
		{
		//Vide le fichier CSV
		$NouveauTableau = array();
		$fp = fopen('file.csv', 'w');
		fputcsv($fp, $NouveauTableau, '*');
		fclose($fp);

		
		//Parcour les checkbox et ajoute dans le fichier
		foreach($_POST['CheckBAction'] as $chkbx){
 
		$a = ajouterdansCSV($chkbx);
		}
	
		 header("Location: telecharger.php");
	}
	else
	{
	echo'<h2 align="center"  > Aucune action cocher. Veuillez cocher les actions que vous désirez télécharger. </h2>';
	}
	}
?>

<div class="contenu">

	<h2>
	
		Login : <?php echo $_SESSION["user"]; ?></br>
		
		
	</h2>
	<h2 align="center">
	
		Consulter les actions pendant une période </br>
	</h2>
	</br></br>

<form method="POST" id="FormConsutActionPeriode" action="">
	<table align="center" class="ficheCourante">
		<thead class="thead">
		<th >
			 Debut
			</th>
			<th>			
			</th>

			<th>
			Fin
			</th>
			<th>
			Valider
			</th>
			
		</thead>
		<tbody>
		<td> 
		<input type="date" id="dateDebConsultAction" value="<?php echo date_format($date,"Y-m-d"); ?>" class="modification" name="DateDebConsult" style="width: 140px;"  />
		</td>
		<td class="espace">à</td>
		<td>
		<?php


	$cpt = 0;
	for($j = date_format($date,"N"); $j != 5; $j++)
	{
		$cpt++;
	}	
	
		$jourF = date_format($date,"d");  
		
		$jourF = $jourF +$cpt;
		$mois = date_format($date,"m");
		if($jourF == 29 && date("L") == 1 )
		{
			
		}
		elseif($jourF == 29)
		{
			$jourF--;
		}
		if($jourF > date("t",$mois))
		{
		//Recupere le nombre de jour dans le mois.
		$moisQ = mktime( 0, 0, 0, $mois, 1, date("Y") ); 
	   $nombreDeJours = intval(date("t",$moisQ));
	   
			$jourF = $jourF - $nombreDeJours ;
		
	 
		}
		
		
		
		if($jourF < 10)
		{
			$jourF = "0".$jourF;
		}
		
		$datefini = date("Y-").$mois."-".$jourF; 
		?>
		<input type="date" id="dateFinConsultAction"  value="<?php	echo $datefini ?>" class="modification" name="DateFinConsult" style="width: 140px;"  />
		</td>
		
		<td>
		<img  src="../images/img_submit.gif" id="BouttonRechercheConsultDate" style="margin-left:45px; width:32px; height:32px; border:none; box-shadow: none;" alt="Submit"  value="1">
		</td>
		</tbody>
		</table>
		</br></br></br>
		
		<span style="font-family: Comic Sans MS;	font-size: 15px;-webkit-margin-before:1em;-webkit-margin-after: 0;-webkit-margin-start: 0px;-webkit-margin-end: 0px; margin-left: 450px;">
		Telecharger les action du premier tableau (télécharge tout le tableau) :
		</span>
<input name="ddd" src="../images/img_submit.gif" style="margin-left:10px; width:32px; height:32px; border:none; box-shadow: none;" type="image"  alt="Rechercher" value="2"/>		
		</br></br></br>
		<span style="font-family: Comic Sans MS;	font-size: 15px;-webkit-margin-before:1em;-webkit-margin-after: 0;-webkit-margin-start: 0px;-webkit-margin-end: 0px; margin-left: 555px;">
		Telecharger les actions sélectionnées :
		</span>
<input name="afficherTableau" src="../images/img_submit.gif" style="margin-left:10px; width:32px; height:32px; border:none; box-shadow: none;" type="image"  alt="Rechercher" value="2"/>
	</br></br>
	
		</br></br><h2 align="center"> Liste des actions suivant les dates selectionnées (actions de la semaine dernière par défault) : </h2>
		</br>
		<table style="border:none;">
		<td>
		<span style="font-family: Comic Sans MS;	font-size: 15px; margin-left: 1224px; margin-top: 12px;">
		Tout cocher :
		</span>
		</td>
		<td>
		<input type="checkbox"  value="Tout cocher" id="ButCocherCheckBox">
		</td>
		</table>
		

		
	<div id="aaaa">
				<table class="ficheCourante" align="center">
				
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
						Etat
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
					<th>
					selectionner actions
					</th>
					
				</tr>
			
			</thead>
				
			<tbody id="tbodyConsultActionsPeriode">
			
			<?php  if(count($ContenuActionCL) > 0): foreach($ContenuActionCL as $f):
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
			<span id="IdAction"> <?php  echo $f['IdActions']?> </span>
			</td>
			<td>
			<?php  echo $f['NumAction']?> 
			</td>
			<td>
			<?php  echo $f['DateDeb']?> 
			</td>
			<td>
			<?php  echo $f['HeureDeb']?> : <?php  echo $MinDeb; ?> 
			</td>
			<td>
			<?php  if($f['Etat'] == "CL"): echo $f['HeureFin']?> : <?php  echo $MinFin; endif;  ?> 
			</td>
			<td>
			<?php if($f['Etat'] == "CL"): echo ("CLOTURER"); endif; if($f['Etat'] == "EC"): echo ("EN COURS"); endif;?> 
			</td>
			<td>
			<?php echo $f['NomI']?> 
			</td>
			<td>
			<?php  echo $f['PrenomI']?> 
			</td>
			<td class="tdIcone">
			<img onclick="ConsulterActions(<?php  echo $f['IdActions']?>,<?php  echo $f['idFiche']?>)" name="ConsulterModifierAction" value="<?php  echo $f['IdActions']?> "  style=" border: none; height: 35px; width: 32px; box-shadow: none;margin-left: 35px;" src="../images/Dossier.jpg" /> 
			</td>
			<td class="tdIcone">
				
					<img onclick="SupprimerActionsPeriode(<?php  echo $f['IdActions']?> , '<?php  echo $f['Etat']?>' )"name="supprimeraction"  style=" border: none; height: 35px; width: 32px; box-shadow: none;margin-left: 35px;" src="../images/supprimer.png" value='<?php  echo $f['IdActions']; ?>'/>
				
				</td>
				<td class="tdIcone" >
				
					<input type="checkbox" name="CheckBAction[]" id="h" value="<?php  echo $f['IdActions']?>"/>
				
				</td>
			</tr>
			<?php  endforeach; endif;?>
			
			</tbody>
			<tfoot>
			
			</tfoot>
		</table>
		</div>
		</br></br></br></br>
		<h2 align="center"> Totalité des actions "en cours" : </h2> </br>
		<div id="ConsultActionPeriodeCheckEC">
		<table class="ficheCourante" align="center">
				
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
						Etat
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
					<th>
					selectionner actions
					</th>
				</tr>
					
				</tr>
			
			</thead>
			
			<tbody id="tbodyConsultActionsPeriodeEC">
			<?php if(count($ContenuActionEC) > 0): foreach($ContenuActionEC as $f):
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
			<span id="IdAction"> <?php  echo $f['IdActions']?> </span>
			</td>
			<td>
			<?php  echo $f['NumAction']?> 
			</td>
			<td>
			<?php  echo $f['DateDeb']?> 
			</td>
			<td>
			<?php  echo $f['HeureDeb']?> : <?php  echo $MinDeb; ?> 
			</td>
			<td>
			<?php  if($f['Etat'] == "CL"): echo $f['HeureFin']?> : <?php  echo $MinFin; endif;  ?> 
			</td>
			<td>
			<?php if($f['Etat'] == "CL"): echo ("CLOTURER"); endif; if($f['Etat'] == "EC"): echo ("EN COURS"); endif;?> 
			</td>
			<td>
			<?php echo $f['NomI']?> 
			</td>
			<td>
			<?php  echo $f['PrenomI']?> 
			</td>
			<td class="tdIcone">
			<img onclick="ConsulterActions(<?php  echo $f['IdActions']?> , <?php  echo $f['IdFicheSociete']?>)" name="ConsulterModifierAction" value="<?php  echo $f['IdActions']?> "  style=" border: none; height: 35px; width: 32px; box-shadow: none;margin-left: 35px;" src="../images/Dossier.jpg" /> 
			</td>
			<td class="tdIcone">
				
					<img onclick="SupprimerActionsPeriode(<?php  echo $f['IdActions']?> , '<?php  echo $f['Etat']?>')" name="supprimeraction"  style=" border: none; height: 35px; width: 32px; box-shadow: none;margin-left: 35px;" src="../images/supprimer.png" value='<?php  echo $f['IdActions']; ?>'/>
				
				</td>
					<td class="tdIcone">
				
					<input type="checkbox" name="CheckBAction[]" id="checkbox<?php  echo $f['IdActions']?>" value="<?php  echo $f['IdActions']?>"/>
				
				</td>
			</tr>
			<?php  endforeach; endif;?>
			</tbody>
			<tfoot>
			
			</tfoot>
		</table>
		</div>
	</form>
	</br>
	</br>

</div>







<?php include'../html/Footer.html'; ?>
<?php }
else
{
header("Location: accueil.php");
} ?>