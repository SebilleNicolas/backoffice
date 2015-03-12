<?php
require_once( '../../_function.php');


if(isset($_GET['NouveauNumSerieLogi']) && isset($_GET['ListeMotifsLogi']) && isset($_GET['IdAction']))
{
	$motif = ListeMotifs();
	$NumSerie= $_GET['NouveauNumSerieLogi'];
	$Motifs= $_GET['ListeMotifsLogi'];
	$idAction = $_GET['IdAction'];
	
	$ListeNumSerie = ListeNumeroSerie($idAction);
	$pdo = connexion();

	if($pdo != false)
	{
		$req=" INSERT INTO numeroserie values(null,'".$NumSerie."','".$Motifs."',$idAction,0) ";
		// var_dump($req);
		$res = $pdo -> exec($req); 
		$reqs=" select max(IdNumSerie) as DernierIdNumS from numeroserie ";
		
		$ress = $pdo ->query($reqs)->fetch(); 
		$DernierIDNumSerie = $ress['DernierIdNumS'];
	}
	if($res ==1){

				
				
	echo(' 
	<tr>
	<td>
		<input class="modification"   type="text" value="'.$DernierIDNumSerie.'" disabled/>
		</td>
		<td>
		<input class="modification"   type="text" value="'.$NumSerie.'" disabled/>
		</td>
				
				<td>
				<select disabled>
				');
				foreach($motif as $m):
				echo('
				<option value="'.$m['IdMotifs'].'"'); if($m['IdMotifs'] == $Motifs): echo('selected'); endif; echo('>'.$m['LibelleMotifs'].'</option>
				'); endforeach;
				echo('</select>
				</td>
				
				<td class="tdicone">
					<img  onclick="SupprimerNumSerieLogi('.$DernierIDNumSerie.')"  style="float: left; border: none; height: 30px; width: 27px; box-shadow: none; margin-left: 10px;" src="../images/supprimer.png" value="'.$DernierIDNumSerie.'" />
					
				
				</td> </tr>');
	
	}
	else{
	echo("rater");
	}
	
	
}
else
{
echo("Totalement rater");
}



	
	
	

?>