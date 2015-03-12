<?php
require_once( '../../_function.php');


if(isset($_GET['NouveauNumSerieMater']) && isset($_GET['ListeMotifsMater']) && isset($_GET['IdAction']))
{
	$motif = ListeMotifs();
	$NumSerie= $_GET['NouveauNumSerieMater'];
	$Motifs= $_GET['ListeMotifsMater'];
	$idAction = $_GET['IdAction'];
	
	$ListeNumSerie = ListeNumeroSerieMateriel($idAction);
	$pdo = connexion();

	if($pdo != false)
	{
		$req=" INSERT INTO numeroserie values(null,'".$NumSerie."','".$Motifs."',$idAction,1) ";
		
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
					<img  onclick="SupprimerNumSerieMater('.$DernierIDNumSerie.')" style="float: left; border: none; height: 30px; width: 27px; box-shadow: none; margin-left: 10px;" src="../images/supprimer.png" value="'.$DernierIDNumSerie.'" />
					
				
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