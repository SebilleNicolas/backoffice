
<?php
require_once('../../_function.php');
if(isset($_GET['idEtatPA']))
	{	
				$pdo = connexion();
				$idEtatPA = $_GET['idEtatPA'];
					$req= "delete from etatprochaineaction where IdEtatProchaineAction =".$idEtatPA;
					// var_dump($req);exit;
				$result = $pdo->exec($req);


}
$EtatPA = ListeEtatProchaineAction();

if($EtatPA != false):
foreach($EtatPA as $t):


echo('
			<tr>
				<td class="espace">
				<TEXTAREA class="modification" wrap="virtual"  style="resize: none;" name="CodeEPA'. $t['IdEtatProchaineAction'].'" rows="3" cols="20">  '.$t['CodeEPA'].'  </TEXTAREA>
					
				
				</td>
				
				<td class="espace">
				<TEXTAREA class="modification" wrap="virtual"  style="resize: none;" name="LibelleEPA'. $t['IdEtatProchaineAction'].'" rows="3" cols="20">  '. $t['LibelleEPA'].' </TEXTAREA>
					
				
				</td>
				
				
				<td class="tdIcone">
				
					<img onclick="SupprimerEtatProchaineAction('. $t['IdEtatProchaineAction'].')" class="suppression" value="'. $t['IdEtatProchaineAction'].'"/>
				
				</td>
				
				<td>	
						<input type="submit"  align="center" class ="reporter" name="ModifierEPA" value="Modifier"/>
						
					</td>
			</tr>');



			endforeach;
	
		endif;
?>