		<select>
					<?php 
					
					for ($i = 0; $i < count($ListeTechnicien); $i++) {
							
						
					?>
																						<!--Regarde Si L'utilisateur de la liste est celui authentifier-->
																						<!-- Si oui ==> affiche le nom ey prenom dans listbox -->
																						 <!-- Sinon ==> Propriete selected ==> rien -->
  <option value="<?php  echo $ListeTechnicien[$i][0]; echo " ".$ListeTechnicien[$i][1];?>" <?php if($ListeTechnicien[$i][3]==$_SESSION['user']): ?>
		
  selected="<?php echo $ListeTechnicien[$i][1]; echo " ".$ListeTechnicien[$i][2]; endif;?>">
 
																							<?php if($ListeTechnicien[$i][3]!=$_SESSION['user']):?> 
  selected=""> 																	<?php endif; ?>
  <?php  echo $ListeTechnicien[$i][1]; echo " ".$ListeTechnicien[$i][2]; ?></option>
  
</select>






		<select>
					<?php 
					
					for ($i = 0; $i < count($ListeTechnicien); $i++) {
							
						
					?>
																						
  <option value="<?php  echo $ListeTechnicien[$i][0]; echo " ".$ListeTechnicien[$i][1];?>" <?php if($ListeTechnicien[$i][3] == $_SESSION['user']): ?> selected <?php endif;?>>
		
  <?php  echo $ListeTechnicien[$i][1]; echo " ".$ListeTechnicien[$i][2]; ?>
  
  </option>
  
</select>




<!-- Liste deroulante motif ! -->
<select name="" size="18" multiple="" id="" class="Text-10-GrisFonce padding" tabindex="62">

<option value="1">APERIO</option>
</select>