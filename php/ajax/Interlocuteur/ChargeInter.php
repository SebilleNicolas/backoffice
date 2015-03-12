<?php
require_once( '../../_function.php');


	if(isset($_GET['IdInter']))
	{
		$pdo = connexion();
			$IdInter = $_GET['IdInter'];
			
			
			$req= " select * from interlocuteur where IdInterlocuteur = $IdInter";
			
			$result = $pdo->query($req)->fetchall();
	
			
		// var_dump($result);exit;
	echo('
	<td>
					<input class="modification" type="text" value="'.$result[0]['NomI'].'" name="NomI'.$result[0]['IdInterlocuteur'].'" id="nomInter" />
				</td>
				<td>
					<input class="modification" type="text" value="'.$result[0]['PrenomI'].'" name="PrenomI'.$result[0]['IdInterlocuteur'].'" id="prenomInter" />
				</td>
				<td>
					<input class="modification" type="text" value="'.$result[0]['TelMobileI'].'" name="TelMobile'.$result[0]['IdInterlocuteur'].'"  id="TelMobInter"  />
				</td>
				<td>
					<input class="modification" type="text" value="'.$result[0]['emailI'].'" name="Email'.$result[0]['IdInterlocuteur'].'" id="emailInter" />
				</td>
				
				<td class="tdIcone">
				
				<img value="" style=" border: none; height: 35px; width: 32px; box-shadow: none;margin-left: 35px;" src="../images/supprimer.png"name="supprimerI" onclick="SupprimerInter(' .$result[0]['IdInterlocuteur'].')">
				
				</td>
				
					<td>	
					<img value="" class="reporter" name="ModifierI" onclick="ModifierInter(' .$result[0]['IdInterlocuteur'].')">
						
					</td>
					<td >
						
					</td> ');
		
	}
	
	
?>