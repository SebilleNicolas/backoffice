
<?php 

for ($i = 0; $i < count($ListeTechnicien); $i++) { ?>
																							
	 <option value="<?php  echo $ListeTechnicien[$i][0];?>" <?php 

  if($ListeTechnicien[$i][0] == $RT['IdTechnicien']): ?> selected <?php endif;?> >
		
  <?php  echo $ListeTechnicien[$i][1]; echo " ".$ListeTechnicien[$i][2]; ?>
  <?php } ?>
  </option>
	  
		