<?php
 $ListeNumSerie = ListeNumeroSerie($IdAction); 

 $motif = ListeMotifs();
 foreach($ListeNumSerie as $l):
 echo('
 <tr>
		<td>
			<input class="modification"   type="text" value="'. $l['IdNumSerie'].'" disabled/>
		</td>
		<td>
			<input class="modification"   type="text" value="'.$l['NumeroSerie'].'" disabled/>
		</td>
				
				<td>
				<select disabled>');
				
				foreach($motif as $m):
				echo('
				<option value="'.$m['IdMotifs'].'"'); if($m['IdMotifs'] == $l['IdMotifs']): echo('selected'); endif; echo('>'.$m['LibelleMotifs'].'</option>
				'); endforeach;
				echo('</select>
				</td>
				
				<td class="tdicone">
				
					<img  onclick="SupprimerNumSerieLogi('.$l['IdNumSerie'].')" style="float: left; border: none; height: 30px; width: 27px; box-shadow: none; margin-left: 10px;" src="../images/supprimer.png" value="" />
				
				</td> </tr>');
endforeach; 
	
	
?>