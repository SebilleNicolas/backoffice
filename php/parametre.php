<?php


	//Démarrage des sessions
	session_start();
	
	//inclusion du header
	include '../html/Header.html';
	
	
	
	//inclusion de la page de fonction php
	require_once('_function.php');
	//Supprime les actions qui n'ont pas de Etat Valide
	$pdo=connexion();
	if($pdo != null)
	{
			$req="Delete from actions where EtatValide = 0";
	$pdo->exec($req);		
	}
	//Vérification de l'authentification
	verificationAuthentification();
	
	//Obtention du menu en fonction du statut
	menu($_SESSION["statut"]);
	if($_SESSION["statut"] == "Administrateur")
	{
	
	//Recupere l'ID de l'action
	 $IdAction = recupererDernierIdActions();
	 
	//Id de la prochaine action
	$IdProchaineA = $IdAction + 1;
	
	//Recupere la liste des Type de demande
	$ListeTypeDemande = ListeTypeDemande();
	
	
	//Recupere la liste des Techniciens
	$ListeTechnicien = ListeTechnicien();
	
		//Recupere la liste des Techniciens
	$ListeType = ListeType();
	
	
	//Recupere la liste des EtatProchaineAction
	$ListeEPA = ListeEtatProchaineAction();
	
	
	//Recupere la liste des Techniciens
	$ListeCategorie = ListeCategorie();
	
	//Recupere L'etat de l'action
	$Etataction = EtatAction($IdAction);
	
	
	
		//Si on click sur le boutton ajouterTechnicien
	if(isset($_POST['ajoutNouveauTechnicien']))
	{
	
	header("Location: AjouterSupprimerTechnicien.php");
	
	}
	
	//Si on click sur le boutton ajouterCAtegorie
	if(isset($_POST['ajoutNouveauCateg']))
	{
	
	header("Location: AjouterSupprimerCategorie.php");
	
	}
	
	//Si on click sur le boutton ajouterType
	if(isset($_POST['ajoutNouveauTypeDemande']))
	{
	
	header("Location: AjouterSupprimerTypeDemande.php");
	
	}
	
	if(isset($_POST['AjouterRelanceTechni']))
	{
		if($_POST['test'] != "")
		{
		header("Location: AjouterSupprimerType.php");
		}
	
	}
	//Si on click sur le boutton ajouterTypeDemande
	if(isset($_POST['ajoutNouveauType']))
	{
	
	header("Location: AjouterSupprimerType.php");
	
	}
	//Si on click sur le boutton ajouter Nouveau Etat Prochaine Action
	if(isset($_POST['ajoutNouveauEPA']))
	{
	
	header("Location: AjouterSupprimerEPA.php");
	
	}
	//Si on click sur le boutton ajouter Nouveau Etat Prochaine Action
	if(isset($_POST['ajoutNouveauMotifs']))
	{
	
	header("Location: AjouterSupprimerMotifs.php");
	
	}
	
	$ListeInterocuteur = ListeTotalDesInterlocuteur();
	
	if(isset($_POST['AjoutNouveauInterlocuteur']))
	{
	
	header("Location: AjouterSupprimerInterlocuteur1.php");
	
	}
	
	
	
?>

<div class="contenu">

	<h2>
	
		Login : <?php echo $_SESSION["user"]; ?></br>
		
		
	</h2>
	<h2 align="center">
	
		Ajouter des parametres </br>
	</h2>
	</br></br>
	
<form method="POST" action="">

		
		<br /><br />

		<table class="ficheCourante">
				
			
				<thead class="thead">
				
				
							
				<tr>
						
					<th>
						
						Type demande
						
					</th>
						
				
					
					
					<th>
						Technicien
					</th>
					
					<th>
						Type
					</th>
					
					<th>
						Categorie
					</th>
					<th>
						Etat des prochaine action
					</th>
					<th>
						Motifs
					</th>
					<th>
						Interlocuteur
					</th>
					
				</tr>
			
			</thead>
			
			<tbody>
			
				<tr>
				
					<td>
					</br>
					
					<select>
					<?php 
					
					for ($i = 0; $i < count($ListeTypeDemande); $i++) {
							
						
					?>
  <option value="<?php  echo $ListeTypeDemande[$i][0]; ?>"><?php  echo $ListeTypeDemande[$i][1]; ?></option>
  <?php } ?>
</select>
						
					
					</td>
					
					
					
				<td>
				</br>
				
	<select>
					<?php for ($i = 0; $i < count($ListeTechnicien); $i++) { ?>
																						
  <option value="<?php  echo $ListeTechnicien[$i][0]; echo " ".$ListeTechnicien[$i][1];?>" <?php 

  if($ListeTechnicien[$i][3] == $_SESSION['user']): ?> selected <?php endif;?>>
		
  <?php  echo $ListeTechnicien[$i][1]; echo " ".$ListeTechnicien[$i][2]; ?>
  <?php } ?>
  </option>
  
</select>
						
					
					
				</td>
				<td>
					</br>
						
						<select>
					<?php 
					
					for ($i = 0; $i < count($ListeType); $i++) {
							
										
				?>
				  <option value="<?php  echo $ListeType[$i][1];?>"><?php  echo $ListeType[$i][1]; ?></option>
				  <?php } ?>
				</select>
						
					
					</td>
					<td>
					</br>
						
						<select>
					<?php 
					
					for ($i = 0; $i < count($ListeCategorie); $i++) {
							
										
				?>
				  <option value="<?php  echo $ListeCategorie[$i][1];?>"><?php  echo $ListeCategorie[$i][1]; ?></option>
				  <?php } ?>
				</select>
				
					</td>
					<td>
					</br>
						<select>
					<?php 
					
					for ($i = 0; $i < count($ListeEPA); $i++) {
							
										
				?>
				  <option value="<?php  echo $ListeEPA[$i][1];?>"><?php  echo $ListeEPA[$i][2]; ?></option>
				  <?php } ?>
				</select>
					
						
					
					</td>
						<td>
					</br>
						<select>
					<?php 
					$ListeMotifs = ListeMotifs();
					for ($i = 0; $i < count($ListeMotifs); $i++) {
							
										
				?>
				  <option value="<?php  echo $ListeMotifs[$i][0];?>"><?php  echo $ListeMotifs[$i][1]; ?></option>
				  <?php } ?>
				</select>
				
						
					
					</td>
					
					<td>
					<br>
					<select  name="SelectInterlocuteur">
			
					<?php 
					
					for ($i = 0; $i < count($ListeInterocuteur); $i++) {
							
										
				?>
				  <option value="<?php  echo $ListeInterocuteur[$i][0];?>" 
				  <?php if(isset($_GET['IdInter'])):
				  if($_GET['IdInter'] != ""):
				  if($ListeInterocuteur[$i][0] == $_GET['IdInter']):
				  
				  ?>  selected <?php endif; endif; endif; ?> ><?php echo $ListeInterocuteur[$i][2]."  ".$ListeInterocuteur[$i][3]; ?></option>
				  <?php } ?>
				</select>
				
					</td>

				</tr>
			<tr>
			<td>
				<input type="submit" name="ajoutNouveauTypeDemande" class="ajouter" />
			</td>
			<td>
				<input type="submit" name="ajoutNouveauTechnicien" class="ajouter" />
			</td>
			<td>
				<input type="submit" name="ajoutNouveauType" class="ajouter" />
			</td>
			<td>
					<input type="submit" name="ajoutNouveauCateg" class="ajouter" />
			</td>
			<td>
				<input type="submit" name="ajoutNouveauEPA" class="ajouter" />
			</td>
			<td>
					<input type="submit" name="ajoutNouveauMotifs" class="ajouter" />
			</td>
			<td>
				<input type="submit" name="AjoutNouveauInterlocuteur" class="ajouter" />
			</td>
			</tr>
			</tbody>
			<tfoot>
			
			
			</tfoot>
		</table>
		
		
	</form>
	</br>
	</br>
<d
</div>





</div>

<?php include'../html/Footer.html'; ?>
<?php }
else
{
header("Location: accueil.php");
} ?>