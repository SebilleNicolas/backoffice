<?php

/**
 * Page montrant les précédentes fiches du visiteur
 * Il ne peut que visionner ses fiches
**/
	
	//Démarrage des sessions
	session_start();
	
	
	
	
	
	//inclusion de la page de fonction php
	include '_function.php';
	
	//Vérification de l'authentification
	verificationAuthentification();

?>
<script type="text/javascript" src="../js/tinymce/tinymce.min.js">

</script>
<script type="text/javascript">
tinymce.init({
        selector: ".Description",
		
	
        menubar: false,
		height: 185
});</script>
<table class="RappelRelanceClient">
	<tr>

	<td class="RappelRelanceClient">
	<h2>
	Relance Client :
	</h2>
			 

			
	
	
	
	</td>
		
	</tr>


		<!--3e Ligne-->
		<tr>
		
			<td>
			Commentaire : 
			</td>
			
			<td class = "espace">
			</td>
			
		</tr>
	<tr>

			<td id="CommentRelanceClient">
			<div class="commentaire" name="CommentRappelClient" >
					<textarea id="TACommentRappelClient" class="Description" name="CommentRappelClient"></textarea>
					</div>
					
			</td>
			
			<td>
			</td>
	
	</tr>
	</table>
				
				
		

<!--  ----------------------------------------------------------------------------------------------------------------------------------------- -->



</form>






<?php //include'../../../html/Footer.html'; ?>
