<?php

 $Categ = ListeCategorie();

					if($Categ != false):
					foreach($Categ as $c):
					
					

				echo(	'
						<tr>
				
				
				<td>
				
					<input class="modification" type="text" id="TxtboxLbl'. $c['IdCategorie'].'" value="'.$c['LibelleCategorie'].'" name="LibelleCategorie'.$c['IdCategorie'].'" />
				
				</td>
				
				
				<td class="tdIcone">
				
					
					<img  align="center" onclick="Supp(' .$c['IdCategorie'].')"  name="supprimerCategoried" class="suppression" value="'.$c['IdCategorie'].'"/>
				
				</td>
				
				<td>	
				<img id="ModfierCategorie"  align="center" onclick="Modifier('.$c['IdCategorie'].')"  name="ModifierCategorie" class="reporter" value="Modifier"/>
						
						
					</td>
			</tr>

				');

						endforeach;
				
					endif;
				
?>