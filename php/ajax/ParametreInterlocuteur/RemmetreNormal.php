<?php
require_once( '../../_function.php');
	//Démarrage des sessions
	session_start();
$ListeF = ListeFiche($_SESSION['id']);
	$Inter = ListeTotalDesInterlocuteur();
if($Inter != false ):
foreach($Inter as $i):



			echo('<tr>
				
				
				<td>
					<input id="NomInterlocuteur  '.$i['IdInterlocuteur'].'   class="modification" type="text" value="  '.$i['NomI'].' "  name="NomI'.$i['IdInterlocuteur'].'"   />
				</td>
				<td>
					<input id="PrenomInterlocuteur  '.$i['IdInterlocuteur'].'   class="modification" type="text" value="  '.$i['PrenomI'].' "  name="PrenomI  '.$i['IdInterlocuteur'].' "  />
				</td>
				<td>
					<input id="TelMobileInterlocuteur  '.$i['IdInterlocuteur'].'   class="modification" type="text" value="  '.$i['TelMobileI'].'"   name="TelMobile  '.$i['IdInterlocuteur'].' "  />
				</td>
				<td>
					<input  id="EmailInterlocuteur  '.$i['IdInterlocuteur'].'  class="modification" type="text" value="  '.$i['emailI'].' "  name="Email  '.$i['IdInterlocuteur'].'"   />
				</td>
				
				<td>	
				<select  name="ListesSocieteInterlocuteur  '.$i['IdInterlocuteur'].'   id="ListeSocieteInterlocuteur'.$i['IdInterlocuteur'].'"  >');
					 
					
					for ($j = 0; $j < count($ListeF); $j++) {
					
				 echo(' <option value=" '.$ListeF[$j][0].'"');
				 if($i['IdFicheSociete'] == $ListeF[$j][0]):
				 echo(' selected');
				 endif;
				 echo('>   '.$ListeF[$j][1].'</option>');
															} 
			echo('	</select>
						
					</td>
				<td class="tdIcone">
				
					<img onclick="SupprimerInterlocuteurParam(  '.$i['IdInterlocuteur'].')" style="float: none; border: none; height: 35px; width: 32px; box-shadow: none;" src="../images/supprimer.png" name="supprimerI"  value="  '.$i['IdInterlocuteur'].' "/>
				
				</td>
				
					<td>	
						<img onclick="ModifierInterlocuteurParam(  '.$i['IdInterlocuteur'].')" id="ModifierI" align="center" class ="reporter" name="ModifierI" value="Modifier"/>
					</td>
					
					
			</tr>');



			endforeach;
			endif;
?>