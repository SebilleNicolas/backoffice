<?php
//inclusion de la page de fonction php
	require_once '../../_function.php';
	
	 if(isset($_GET['dateDeb'])  && isset($_GET['dateFin']))
	{
		
				
			$pdo = connexion();
			$dateDeb = $_GET['dateDeb'];
			
			$dateFin = $_GET['dateFin'];
			
		
			
			$req = "
			SELECT A.IdActions,A.Etat, A.NumAction, A.DateDeb, A.HeureDeb, A.MinuteDeb, A.HeureFin, A.MinuteFin, I.NomI, I.PrenomI
			FROM actions A, interlocuteur I
			WHERE I.IdInterlocuteur = A.IdInterlocuteur
			and  A.DateDeb BETWEEN '".$dateDeb."' and '".$dateFin."'
			order by A.Etat asc,A.DateDeb asc, A.HeureDeb asc,A.MinuteDeb asc
			";
			// var_dump($req);
			$result =  $pdo -> query($req)->fetchall();
		  foreach($result as $f):
			$MinDeb = $f['MinuteDeb'];
			$MinFin =	$f['MinuteFin'];
				if($MinDeb < 10)
				{$MinDeb = "0".$MinDeb;}
				if($MinFin  != ""){
				if($MinFin < 10)
				{$MinFin = "0".$MinFin;	}}
				
			
			echo('
			<tr>
			<td>
			<span id="IdAction"> '. $f['IdActions'].' </span>
			</td>
			<td>
			  '. $f['NumAction'].' 
			</td>
			<td>
			  '. $f['DateDeb'].' 
			</td>
			<td>
			  '. $f['HeureDeb'].' :   '. $MinDeb .' 
			</td>
			<td>');
			  if($f['Etat'] == "CL"){ echo( $f['HeureFin'].' :   '. $MinFin); }   
			echo ('</td>
			<td>');
			 if($f['Etat'] == "CL"){ echo("CLOTURER"); } if($f['Etat'] == "EC"){ echo("EN COURS"); } 
			echo('</td>
			<td>
			 '. $f['NomI'].' 
			</td>
			<td>
			  '. $f['PrenomI'].' 
			</td>
			<td class="tdIcone">
			<img onclick="ConsulterActions(  '. $f['IdActions'].')" name="ConsulterModifierAction" value="  '. $f['IdActions'].' "  style=" border: none; height: 35px; width: 32px; box-shadow: none;margin-left: 35px;" src="../images/Dossier.jpg" /> 
			</td>
			<td class="tdIcone">
				
					<img onclick="SupprimerActionsPeriode(  '. $f['IdActions'].',\''.$f['Etat'].'\')"name="supprimeraction"  style=" border: none; height: 35px; width: 32px; box-shadow: none;margin-left: 35px;" src="../images/supprimer.png" value="  '. $f['IdActions'] .'"/>
				
				</td>
				<td class="tdIcone">
				
					<input type="checkbox" name="CheckBAction[]" id="h" value="'.$f['IdActions'].'"/>
				
				</td>
			</tr>');
			  endforeach; 
		
	
		
	}
	
	
	
	 
?>