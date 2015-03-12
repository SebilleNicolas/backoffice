<?php 

for ($i = 0; $i < count($ListeTypeDemande); $i++) { ?>
																							
	 <option value="<?php  echo $ListeTypeDemande[$i][0];?>" <?php 

  if($ListeTypeDemande[$i][0] == $RC['IdType']): ?> selected <?php endif;?> >
		
  <?php  echo $ListeTypeDemande[$i][1];?>
  <?php } ?>
  </option>
	  
		