<?php
	require_once('_function.php');
  $DateDebConsult = $_GET['DateDebConsult'];
	$DateFinConsult = $_GET['DateFinConsult'];
//Fonction qui recupere un double tableau de données
			$list =recupererActionsPeriodeTableau($DateDebConsult,$DateFinConsult);

		
			$fp = fopen('file.csv', 'w');
		
			//Decoupage du tableau de données
			for($h = 0; $h < count($list) ; $h++){
				$NouveauTableau = array();
				$max = count($list[$h])/2;
				//Pour chaque ligne du tableau , insertion dans le nouveau tableau (1ligne sur 2)
				for($CompteurLigne = 0; $CompteurLigne < $max; $CompteurLigne++ )
					$NouveauTableau[$CompteurLigne] = $list[$h][$CompteurLigne];
			
					//ecriture dans le fichier CSV
					fputcsv($fp, $NouveauTableau, '*');
					
			}

		fclose($fp);
//recuperer le nombre d'actions selectionner
$result = recupererNbrActionsPeriodeTableau($DateDebConsult,$DateFinConsult);

$suffix='.xls';

			$row = 1;
			//Si le fichier file.csv a reussi a etre ouvert
if (($handle = fopen("file.csv", "r")) !== FALSE) {
//on ecrit directement dans le fichier XLS
//Tableau + entete
echo "<table> 
		<thead>
		<th> ID Action</th> 
		<th> Etat </th> 
		<th> Numero Action </th> 
		<th> Date </th> 
		<th>Heure Debut</th> 
		<th> Minute Debut</th> 
		<th> Heure Fin </th> 
		<th> Minute Fin </th> 
		<th> Duree Action </th> 
		<th> Description Action </th> 
		<th> Solution Action </th> 
		<th> Nom Interlocuteur </th> 
		<th> Prenom Interlocuteur </th> 
		<th> Telephone Mobile </th> 
		<th>ID Interlocuteur  </th> 
		<th> ID FicheSociete </th> 
		<th>Nom Societe  </th> 
		</thead>
		<tbody> </br> 
		";
		//tant qu'il y a des lignes
    while (($data = fgetcsv($handle, 1000, "*")) !== FALSE) {
        $num = count($data);
		
       $csv_output = "Il y a ".$result[0]." actions dans ce fichier.";
        $row++;
		
		
		//parcours des colonne
        for ($c=0; $c < $num; $c++) {
		//Si on es a la premiere colone (c=0) on ouvre nouvelle ligne
		if($c == 0) { echo "<tr>"; }
		//on ecrit dans le fichier par colonne.
            echo   "<td> $data[$c] </td> ";
			//Si on es a la derniere colone (c+1= nbrMaxDuTableau) on ferme la ligne et on met une nouvelle ligne pour espacer
			if($c+1 == $num) { echo "</tr> <tr></tr>"; }
        }
		
		// exit;
    }
	echo " </tbody> </table>";
	//on ferme le tableau
    fclose($handle);
	// on ferme le fichier
}
		// on force le telechargement en precisant le type de fichier
		header("Content-Type: text/csv");
		// on donne un nom au fichier de type XLS
        header("Content-disposition: attachment; filename=rapport du_" . date("d-m-Y-H-i").$suffix);
     
        print $csv_output;
        exit;
?>