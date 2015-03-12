<?php
//inclusion de la page de fonction php
	require_once('../../_function.php');
	
	 if(isset($_GET['idRelanceTechni']) )
	{
		$pdo=connexion();
		
			$idRelanceTechni = $_GET['idRelanceTechni'];
		$idAction = $_GET['idAction'];
			
			
			
			$req= "delete from relancetechnicien where IdRelanceTechni = $idRelanceTechni";
			// var_dump($req);exit;
			$result = $pdo->exec($req);
		
		$req="Select max(IdRelanceTechni) as IdRelance from relancetechnicien"; 
		$res = $pdo->query($req)->fetch(); 
		// var_dump($res);exit;
		$IdRelanceTechnicien = $res['IdRelance'];
// var_dump($IdRelanceTechnicien);
				$ListeRappelTechnicien = ListeRappelTechnicien($idAction);
		
		$ListeTypeDemande = ListeTypeDemande();
		$ListeTechnicien = ListeTechnicien();
		
			 // var_dump($ListeRappelTechnicien);exit;
					
					foreach($ListeRappelTechnicien as $RT):
		
	
					
						echo('<tr>
							<td>
							
								<input class="modification" type="text" disabled="disabled" value="'.$RT['IdRelanceTechni'].'" name="IdRelanceTechni'. $RT['IdRelanceTechni'].'" />
							
							</td>
							<td>
							<input type="date" value="'.$RT['DateRelanceTechni'].'" class="modification" name="DateRelanceTechni" max="'.date('Y-m-d').'" min="'.date_format(date_sub(new DateTime(date('Y-m-d')), new DateInterval('P1Y')), 'Y-m-d').'" />
							</td>
							<td>
							<input type="number" min="0" max="23" pattern="[0-9]{1,3}"  name="HeureRelanceTechni" value="'.$RT['HeureRelanceTechni'].'"/> :
							<input type="number" min="0" max="59" pattern="[0-9]{1,3}"  name="MinuteRelanceTechni" value="'.$RT['MinuteRelanceTechni'].'" />
							</td>
							<td>
							<select name="RappelTechnicienListeTechnicien">
										
							');
						echo(	include '../../ListeTechnicienRelanceTechni.php');
							echo('</select>
								
							</td>
							<td>
							
							<select name="RappelTechnicienListeTypeDemande">');
				echo( include '../../ListeTypeRelanceTechni.php');
				 
				echo('		</select> 
							
							
							</td>
							<td>
							<img name="supRT" onclick="SupprimerRelanceTechni(' .$RT['IdRelanceTechni'].')" class="suppression" value="'.$RT['IdRelanceTechni'].'"/>
							</td>
							<td>
							<input type="radio" name="SelectCommentaire" onclick="chargeCommentaire('.$RT['IdRelanceTechni'].')" value="'.$RT['IdRelanceTechni'].'"><br>
						
							</td>
						</tr>');
					
	
							endforeach;
						
	}

	 
?>
