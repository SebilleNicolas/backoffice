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
	require_once('_function.php');
	//Supprime les actions qui n'ont pas de Etat Valide
	$pdo=connexion();
	
	if(isset($_POST['envoyerDansTableau']))
	{

			$list =recupererActionsPeriodeTableau();
	
// var_dump($list); 

		
			$fp = fopen('file.csv', 'w');
		
			
			for($h = 0; $h < count($list) ; $h++){
				$NouveauTableau = array();
				$max = count($list[$h])/2;
				
				for($CompteurLigne = 0; $CompteurLigne < $max; $CompteurLigne++ )
					$NouveauTableau[$CompteurLigne] = $list[$h][$CompteurLigne];
				// var_dump($CompteurLigne);
					// var_dump($max); 
					// var_dump($list[$h);
					fputcsv($fp, $NouveauTableau, '*');
					// break;
			}

		fclose($fp);
	}
	if(isset($_POST['afficherTableau']))
	{
	$row = 1;
if (($handle = fopen("file.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, "*")) !== FALSE) {
        $num = count($data);
        echo "<p> $num champs à la ligne $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
    }
    fclose($handle);
}
}
if(isset($_POST['ddd']))
	{


$pdo = connexion();
	
	if($pdo != false)
	{
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
		
	$req = "
			SELECT count(A.IdActions)
			FROM actions A, interlocuteur I, fichesociete F
			WHERE I.IdInterlocuteur = A.IdInterlocuteur
			and I.IdFicheSociete = F.id
			and  A.DateDeb BETWEEN '".date_format($date,"Y-m-d")."' and '".date("Y-m-").$dateFin."'
			order by A.Etat asc,A.DateDeb asc, A.HeureDeb asc,A.MinuteDeb asc
			";
			// var_dump($req);
			$result =  $pdo -> query($req)->fetch();
			}

$suffix='.xls';

			$row = 1;
if (($handle = fopen("file.csv", "r")) !== FALSE) {
echo "<table> 
		<thead>
		<th> IDAction</th> 
		<th> Etat </th> 
		<th> NumAction </th> 
		<th> Date </th> 
		<th>Heure </th> 
		<th> Minute </th> 
		<th> HeureFin </th> 
		<th> MinuteFin </th> 
		<th> DureeAction </th> 
		<th> DescriptionAction </th> 
		<th> SolutionAction </th> 
		<th> NomI </th> 
		<th> PrenomI </th> 
		<th> TelMobileI </th> 
		<th>IdInterlocuteur  </th> 
		<th> idFicheSociete </th> 
		<th>NomSociete  </th> 
		</thead>
		<tbody> </br> 
		";
    while (($data = fgetcsv($handle, 1000, "*")) !== FALSE) {
        $num = count($data);
		
       $csv_output = "Il y a ".$result[0]." actions dans ce fichier.";
        $row++;
		
		
		
        for ($c=0; $c < $num; $c++) {
		if($c == 0) { echo "<tr>"; }
            echo   "<td> $data[$c] </td> ";
			// var_dump($data);exit;
			if($c+1 == $num) { echo "</tr> <tr></tr>"; }
        }
		
		// exit;
    }
	echo " </tbody> </table>";
    fclose($handle);
}
       header("Content-Type: text/csv");
        header("Content-disposition: attachment; filename=rapport du :" . date("d-m-Y").$suffix);
        print $csv_output;
        exit;
		}

	if(isset($_POST['EnvoyerEmail']))
	{
	
	

			$mail = 'n.sebille@vauban-systems.fr' ; // Déclaration de l'adresse de destination. 
			if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui présentent des bogues.
			{
				$passage_ligne = "\r\n";
			}
			else
			{
				$passage_ligne = "\n";
			}
			//=====Déclaration des messages au format texte et au format HTML.
			$message_txt = "Rapport du ".date("d-m-Y");
			$message_html = "<html><head></head><body>Rapport du ".date("d-m-Y").".</body></html>";
			//==========
			 
			//=====Lecture et mise en forme de la pièce jointe.
			$fichier   = fopen("file.csv", "r");
			$attachement = fread($fichier, filesize("file.csv"));
			$attachement = chunk_split(base64_encode($attachement));
			fclose($fichier);
			//==========
			 
			//=====Création de la boundary.
			$boundary = "-----=".md5(rand());
			$boundary_alt = "-----=".md5(rand());
			//==========
			 
			//=====Définition du sujet.
			
			$sujet = "Rapport des actions effectuez";
			//=========
			 
			//=====Création du header de l'e-mail.
			$header = "From: \"n.sebille\"<'n.sebille@vauban-systems.fr'>".$passage_ligne;
			$header.= "Reply-to: \"n.sebille\" <'n.sebille@vauban-systems.fr'".$passage_ligne;
			$header.= "MIME-Version: 1.0".$passage_ligne;
			$header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
			//==========
			 
			//=====Création du message.
			$message = $passage_ligne."--".$boundary.$passage_ligne;
			$message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
			$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
			// =====Ajout du message au format texte.
			$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
			$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
			$message.= $passage_ligne.$message_txt.$passage_ligne;
			// ==========
			 
			$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
			 
			//=====Ajout du message au format HTML.
			$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
			$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
			$message.= $passage_ligne.$message_html.$passage_ligne;
			//==========
			 
			//=====On ferme la boundary alternative.
			$message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
			//==========
			 
			 
			 
			$message.= $passage_ligne."--".$boundary.$passage_ligne;
			 
			//=====Ajout de la pièce jointe.
			$message.= "Content-Type: text/csv; name=\"file.csv\"".$passage_ligne;
			$message.= "Content-Transfer-Encoding: base64".$passage_ligne;
			$message.= "Content-Disposition: attachment; filename=\"file.csv\"".$passage_ligne;
			$message.= $passage_ligne.$attachement.$passage_ligne.$passage_ligne;
			$message.= $passage_ligne."--".$boundary."--".$passage_ligne; 
			//========== 
			//=====Envoi de l'e-mail.
			var_dump($mail);
			var_dump($sujet);
			var_dump($message);
			var_dump($header);
			// phpinfo();

			mail($mail,$sujet,$message,$header);
			 }
			//==========

?>

<form method="POST" action="">
<input name="NomEmail"  type="text"   value=""/>
envoyer email
<input name="EnvoyerEmail" src="../images/img_submit.gif" style="margin-left:45px; width:32px; height:32px; border:none; box-shadow: none;" type="image"  alt="Rechercher" value="2"/>
EnvoyerTableau
<input name="envoyerDansTableau" src="../images/img_submit.gif" style="margin-left:45px; width:32px; height:32px; border:none; box-shadow: none;" type="image"  alt="Rechercher" value="2"/>
afficherTableau
<input name="afficherTableau" src="../images/img_submit.gif" style="margin-left:45px; width:32px; height:32px; border:none; box-shadow: none;" type="image"  alt="Rechercher" value="2"/>
dazdazd
<input name="ddd" src="../images/img_submit.gif" style="margin-left:45px; width:32px; height:32px; border:none; box-shadow: none;" type="image"  alt="Rechercher" value="2"/>
</br></br></br></br></br></br></br></br></br></br></br>


<input type="button" value="Tout cocher" onClick="GereChkbox('azert','1');">&nbsp;&nbsp;&nbsp;
<input type="button" value="Tout décocher" onClick="GereChkbox('azert','0');">&nbsp;&nbsp;&nbsp;
<input type="button" value="Inverser la sélection" onClick="GereChkbox('divd_chck','2');">
<br /><br />
<div id="azert">
	<table >
	<input type="checkbox" name="checkazbox1" id="checkdbox1" value="d1"><br />
	<input type="checkbox" name="checkbazox2" id="checqkbox2" value="a2"><br />
	<input type="checkbox" name="checdakbox3" id="checqkbox3" value="fe3"><br />
	<input type="checkbox" name="checzkbox4" id="checadkbox4" value="g4"><br />
	<input type="checkbox" name="checzkbox5" id="chefckbox5" value="z5">
	<input type="checkbox" name="CheckBActionP" id="checkbox" value=""/>
	</table>
</div>


<script type="text/javascript">


function GereChkbox(conteneur, a_faire) {
var blnEtat=null;
var Chckbox = document.getElementById(conteneur).firstChild;
	while (Chckbox!=null) {
		if (Chckbox.nodeName=="INPUT")
			if (Chckbox.getAttribute("type")=="checkbox") {
				blnEtat = (a_faire=='0') ? false : (a_faire=='1') ? true : (document.getElementById(Chckbox.getAttribute("id")).checked) ? false : true;
				document.getElementById(Chckbox.getAttribute("id")).checked=blnEtat;
			}
		Chckbox = Chckbox.nextSibling;
	}
}
//-->
</script>



</form>