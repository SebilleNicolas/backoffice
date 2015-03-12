<?php
//inclusion de la page de fonction php
	// require_once('../../_function.php');
	
						
		$ListeRappelTechnicien = ListeRappelTechnicien($idRelanceTechni);
		
			
		$ListeTechnicien = ListeTechnicien();
		
			 
					
					foreach($ListeRappelTechnicien as $RT):
		
	
					
						echo('<tr>
							<td>
							
								<input class="modification" type="text" disabled="disabled" value="'.$RT['IdRelanceTechni'].'" name="IdRelanceTechni'. $RT['IdRelanceTechni'].'" disabled />
							
							</td>
							<td>
							<input disabled="disabled" type="date" value="'.$RT['DateRelanceTechni'].'" class="modification" style="width: 180px;" name="DateRelanceTechni" max="'.date('Y-m-d').'" min="'.date_format(date_sub(new DateTime(date('Y-m-d')), new DateInterval('P1Y')), 'Y-m-d').'" />
							</td>
							<td>
							<input type="number" min="0" max="23" pattern="[0-9]{1,3}"  name="HeureRelanceTechni" value="'.$RT['HeureRelanceTechni'].'" disabled/> :
							<input type="number" min="0" max="59" pattern="[0-9]{1,3}"  name="MinuteRelanceTechni" value="'.$RT['MinuteRelanceTechni'].'" disabled />
							</td>
							<td>
							<select name="RappelTechnicienListeTechnicien" disabled >
										
							');
						echo(	include '../../ListeTechnicienRelanceTechni.php');
							echo('</select>
								
							</td>
							<td>
							
							<select name="RappelTechnicienListeTypeDemande" disabled >');
				echo( include '../../ListeTypeRelanceTechni.php');
				 
				echo('		</select> 
							
							
							</td>
							<td>
							<img name="supRT" onclick="SupprimerRelanceTechni(' .$RT['IdRelanceTechni'].')" style=" border: none; height: 35px; width: 32px; box-shadow: none;margin-left: 35px;" src="../images/supprimer.png" value="'.$RT['IdRelanceTechni'].'"/>
							</td>
							<td>
							<input type="radio" name="SelectCommentaire" onclick="chargeCommentaire('.$RT['IdRelanceTechni'].')" value="'.$RT['IdRelanceTechni'].'"><br>
						
							</td>
						</tr>');
					
	
							endforeach;
						
						
?>
