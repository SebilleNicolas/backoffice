<?php 	
require_once('../../_function.php');
$req="Select max(idRelanceClient) as maxIdRC from relanceclient";
		$res = $pdo->query($req)->fetch(); 
		// var_dump($res);exit;
		$maxIDRC = $res['maxIdRC'];

				$ListeRelanceClient = ListeRelanceClient($idAction);
				$ListeTypeDemande = ListeTypeDemande();
				foreach($ListeRelanceClient as $RC):
					
					echo('	<tr>
							<td>
							
								<input class="modification" type="text" disabled="disabled" value="'.$RC['IdRelanceClient'].'" name="IdRelanceClient'.$RC['IdRelanceClient'].'" />
							
							</td>
							<td>
							<input disabled="disabled" type="date" value="'. $RC['DateRelanceCli'].'" class="modification" name="DateRelanceTechni" max="'. date('Y-m-d').'" min="'.date_format(date_sub(new DateTime(date('Y-m-d')), new DateInterval('P1Y')), 'Y-m-d').'" />
						
							</td>
							<td>
							<input type="number" min="0" max="23" pattern="[0-9]{1,3}"  name="HeureRelanceTechni" value="'.$RC['HeureRelanceCli'].'" disabled /> :
							<input type="number" min="0" max="59" pattern="[0-9]{1,3}"  name="MinuteRelanceTechni" value="'.$RC['MinuteRelanceCli'].'" disabled />
							</td>
							
							<td>
							
							<select name="RappelTechnicienListeTypeDemande" disabled>');
							
					echo(include 'ListeTypeDemandeRelanceClient.php');
						echo('</select> 
							
							
							</td>
							<td>
							
							<img name="supRT" onclick="SupprimerRelanceClient('.$RC['IdRelanceClient'].')" style=" border: none; height: 35px; width: 32px; box-shadow: none;margin-left: 35px;" src="../images/supprimer.png" value="'. $RC['IdRelanceClient'].'"/>
							
							</td>
							<td>
							<input type="radio" name="SelectCommentaire" onclick="chargeCommentaireRC('.$RC['IdRelanceClient'].')" value="'.$RC['IdRelanceClient'].'"><br>
						
							</td>
						</tr>');
						endforeach; ?>