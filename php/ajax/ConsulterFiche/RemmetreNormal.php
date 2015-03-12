<?php
require_once( '../../_function.php');
	//Démarrage des sessions
	session_start();

	$fiche = listeFiche($_SESSION['id']);
if($fiche != false ):
foreach($fiche as $f):



			echo('<tr>
				
				
				<td>
				
					<input class="modification" type="text" value="'.$f['NomSociete'].'" name="NomSociete'.$f['id'].'" />
				
				</td>
				
				<td>

					
				<TEXTAREA class="modification" wrap="virtual"  style="resize: none;" name="Adresse'. $f['id'].'" rows="3" cols="20">'.$f['Adresse'].'</TEXTAREA>

				
				</td>
				
				<td>
				
					<input class="modification" type="text" value="'. $f['CodePostal'].'" name="CodePostal'. $f['id'].'" />
				
				</td>
				
				<td>
				
					<input class="modification"  style="resize: none;" name="Ville'.$f['id'].'" rows="1" cols="20" value="'.$f['Ville'].'"/>
					
				</td>
				
				
				<td>
				
					<input class="modification" type="text" value="'.$f['Telephone'].'" name="Telephone'. $f['id'].'" />
				
				</td>
				
				<td class="tdIcone">
				
					<img onclick="SupprimerFicheConsulterFiche('. $f['id'].')" name="supprimerFiche" style="float: none; border: none; height:  35px; width: 33px; box-shadow: none; margin-left: 10px;" src="../images/supprimer.png"  value="'. $f['id'].'"/>
				
				</td>
				<td class="tdIcone">
				
					<input type="submit" name="AjouterAction" class="ajouter" value="'. $f['id'].'"/>
				
				</td>
				
				<td class="tdIcone">
				
					<input type="submit" name="RechercheReference" class="recherche" value="'. $f['id'].'"/>
				
				</td>
				<td>
				
					'.NombreActionAvecIdFIche($f['id']).'
				
				</td>
				<td class="tdIcone">
				
					 <input type="submit" name="ConsulterAction" class="consulter" value="'. $f['id'].'"/>
				
				</td>
				<td class="tdIcone">
				
					 <input type="image" src="../images/modifier.png" style=" float:left; border: none; height: 35px; width: 32px; box-shadow: none;margin-left: 35px;"  id="BouttonModifier" align="center"  name="ModifierFiche" value="'. $f['id'].'"/>
				
				</td>
				
				
			</tr>');



			endforeach;
			endif;
?>