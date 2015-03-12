<?php

require_once('../../_function.php');
if(isset($_GET['idAction']) && isset($_GET['IdFS']))
	{	
				$pdo = connexion();
				$idAction = $_GET['idAction'];
				$IdFS = $_GET['IdFS'];
					$req= "delete from actions where idActions =$idAction and idFiche = $IdFS ";
					// var_dump($req);exit;
				$result = $pdo->exec($req);

$FicheEC = listeActionParIdFiche($IdFS);
// var_dump($FicheEC);
foreach($FicheEC as $f):
			$MinDeb = $f['MinuteDeb'];
			$MinFin =	$f['MinuteFin'];
				if($MinDeb < 10)
				{$MinDeb = "0".$MinDeb;}
				if($MinFin  != ""){
				if($MinFin < 10)
				{$MinFin = "0".$MinFin;	}}
				
			echo('<tr>
			<td>
			<span id="IdAction"> '.$f['IdActions'].' </span>
			</td>
			<td>
			'. $f['NumAction'].'
			</td>
			<td>
			'.   $f['DateDeb'].' 
			</td>
			<td>
			'.   $f['HeureDeb'].' : '.$MinDeb .' 
			</td>
			<td>
			'.   $f['HeureFin'].' : '.   $MinFin .' 
			</td>
			<td>
			'.   $f['NomI'].' 
			</td>
			<td>
			'.   $f['PrenomI'].' 
			</td>
			<td class="tdIcone">
			<img onclick="ConsulterActions('.$f['IdActions'].')" name="ConsulterModifierAction" value="'.   $f['IdActions'].' " style="float: none; border: none; height: 35px; width: 32px; box-shadow: none;" src="../images/eyes.png" /> 
			</td>
			<td class="tdIcone">
				
					<img onclick="SupprimerActions('.$f['IdActions'].')"name="supprimeraction" style="float: none; border: none; height: 35px; width: 32px; box-shadow: none;" src="../images/supprimer.png" value="'.   $f['IdActions'] .'"/>
				
				</td>
			</tr>');
			 endforeach; 
	
	}
?>