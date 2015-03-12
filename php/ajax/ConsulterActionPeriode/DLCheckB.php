<?php

	

$suffix='.xls';

			$row = 1;
if (($handle = fopen("../../file.csv", "r")) !== FALSE) {

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
    while (($data = fgetcsv($handle, 1000, "*")) !== FALSE) {
        $num = count($data);
		
       $csv_output = "fin";
        $row++;
		
		
		
        for ($c=0; $c < $num; $c++) {
		if($c == 0) { echo "<tr>"; }
            echo   "<td> $data[$c] </td> ";
			
			if($c+1 == $num) { echo "</tr> <tr></tr>"; }
        }
		
		
    }
	echo " </tbody> </table>";
    fclose($handle);
}
		header("Content-Type: text/csv");
        header("Content-disposition: attachment; filename=rapport du_" . date("d-m-Y-H-i").$suffix);
     
       
        exit;
		

?>