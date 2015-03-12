<?php 
$ListeType = ListeType();
for ($i = 0; $i < count($ListeType); $i++) { ?>
																							
	 <option value="<?php  echo $ListeType[$i][0];?>" <?php 

  if($ListeType[$i][0] == $RT['IdType']): ?> selected <?php endif;?> >
		
  <?php  echo $ListeType[$i][1];?>
  <?php } ?>
  </option>
	  
		