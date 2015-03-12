<?php

require_once( '../../_function.php');
	//Démarrage des sessions
	session_start();
	$fiche = listeFicheparOC($_SESSION['id']);
if($fiche != false ):
foreach($fiche as $f):



			echo('<tr>
				
				
				<td>
				
					<input   disabled="disabled" class="modification" style="width: 170px;" type="text" value="'.$f['NomSociete'].'" name="NomSociete'.$f['id'].'" />
				
				</td>
				
				<td>

					
				<TEXTAREA   disabled="disabled" class="modification" wrap="virtual"  style="resize: none;" name="Adresse'. $f['id'].'" rows="3" cols="20">'.$f['Adresse'].'</TEXTAREA>

				
				</td>
				
				<td>
				
					<input  disabled="disabled" class="modification" type="text" value="'. $f['CodePostal'].'" name="CodePostal'. $f['id'].'" />
				
				</td>
				
				<td>
				
					<input   disabled="disabled" class="modification"  style="resize: none;" name="Ville'.$f['id'].'" rows="1" cols="20" value="'.$f['Ville'].'"/>
					
				</td>
				
				
				<td>
				
					<input  disabled="disabled" class="modification" type="text" value="'.$f['Telephone'].'" name="Telephone'. $f['id'].'" />
				
				</td>
		
				<td>
				
					'.NombreActionAvecIdFIche($f['id']).'
				
				</td>
				<td class="tdIcone">
				
					 <input type="submit" name="ConsulterActionVisiteur" class="consulter" value="'. $f['id'].'"/>
				
				</td>
			
			</tr>');



			endforeach;
			endif;
?>