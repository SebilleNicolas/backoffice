$seconde=0;
$minute=0;
$heure=0;
$jour=0;
d = new Date();
interupt = false;
Compteur();
// CompteurModif();

Etat = $('#Cloture').is(':checked');

// alert(Etat);
if(Etat =="true")
{
	interupt = true;
	// alert(interupt);
}

// Fonction qui appele une fonction toutes les secondes
function Compteur()
{
	setInterval("ActualiserCompteur()",1000);
}
// Fonction qui appele une fonction toutes les secondes

//Compteur
function ActualiserCompteur()
	{
	if (!interupt)
	{
		$seconde++;
		
		if($seconde ==60)
		{
			$seconde=0;
			$minute++;
		}

		if($minute ==60)
		{
			$seconde=0;
			$minute=0;
			$heure++;
		}
		if($heure ==24)
		{
			$seconde=0;
			$minute=0;
			$heure=0;
			$jour++;
		}

		if($heure < 10)
		{
		$text = "0" + $heure+ " : ";
		
			
		}
		else
		{
			$text =  $heure+ " : ";
		}
		
		if($minute < 10)
		{
		$text += "0" + $minute + " : ";
		
			
		}
		else
		{
			$text += $minute+ " : ";
		}

		if($seconde < 10)
		{
		$text += "0" + $seconde;
		
			
		}
		else
		{
			$text += $seconde;
		}

	$("#Compteur").val($text);

		
		$("#CompteurJour").val($jour);
	}
}







$("#TestSupprimer").on("click",function(){

return confirm("Vou aller ajouter , continuer ? !");


});


//saisie
$("#Compteur").focusin(function(){

	interupt = true;


});
//sort de saisie
$("#Compteur").focusout(function(){
	$text = $("#Compteur").val;
	str=$text.split(" : ");
	$seconde = str[0];
	$minute = str[1];
	$heure = str[2];

	interupt = false;


});




$("#Test").on("click", function() {
	
	q = $("#texte").val();
    nbr = $("#NbrFiche").text();
	nbr++;
	$.ajax({
		url: "ajax/Categ/test.php",
		type: "GET",
		data: {q : q},
		success : function(data){
			val= $("#newTR").html();
			// $("#toto").html(data + val);
			$("#newTR").html(  data);
			$("#texte").val("");
			$("#NbrFiche").text(nbr);
			
		}
	});
});





$("#ButAjouterRelanceTechni").on("click", function() {
	idRelanceTechni = $("#NumeroAction").val();
	techni = $("#ListeTechnicienRappelTecnicien").val();
	type = $("#ListeTypeRappelTecnicien").val();
	
	
	tinyMCE.triggerSave(true,true);
	comm2 = $("#TACommentRappelTechni").val();
	
	$.ajax({
		url: "ajax/RelanceTechnicien/RelanceTechniAjouter.php",
		type: "GET",
		data: {techni : techni ,type : type , idRelanceTechni : idRelanceTechni , comm2 : comm2 },
		success : function(data){
		// alert(data);
			$("#AjoutRappelTechni").html( data);
			
			
		}
	});
});



function Supp(idCateg)
{
	$.ajax({
		url: "ajax/Categ/test2.php",
		type: "GET",
		data: {idCateg : idCateg },
		success : function(data){
			$("#newTR").html(data);
			
			
		}
	});
	
	
}

function Modifier(idCateg)
{
// alert("Le IDCateg est :   " + idCateg);
Libelle = $("#TxtboxLbl"+idCateg).val();
// alert("Le libelle est :   " + Libelle);

	$.ajax({
		url: "ajax/Categ/test3.php",
		type: "GET",
		data: { Libelle : Libelle , idCateg : idCateg},
		success : function(data){
		
		}
	});
	
	
}


function SupprimerRelanceTechni(idRelanceTechni)
{
	$.ajax({
		url: "ajax/RelanceTechnicien/SupprimerRelanceTechni.php",
		type: "GET",
		data: {idRelanceTechni : idRelanceTechni },
		success : function(data){
			$("#AjoutRappelTechni").html( data);
			
			
		}
	});
	
	
}




function chargeCommentaire(idRelanceTechni)
{
	$.ajax({
		url: "ajax/RelanceTechnicien/ChargerCommentaire.php",
		type: "GET",
		data: {idRelanceTechni : idRelanceTechni },
		success : function(data){
			$("#CommentRappelTechni").html(data);
			
			
		}
	});
	
	
}






$("#ButAjouterRelanceCli").on("click", function() {
	idRelanceCli = $("#NumeroAction").val();
	
	type = $("#ListeTypeRelanceClient").val();
	
	
	tinyMCE.triggerSave(true,true);
	comm2 = $("#TACommentRappelClient").val();
	
	$.ajax({
		url: "ajax/RelanceClient/AjouterRelanceClient.php",
		type: "GET",
		data: {type : type , idRelanceCli : idRelanceCli , comm2 : comm2 },
		success : function(data){
		// alert(data);
			$("#AjoutRelanceCli").html( data);
			
			
		}
	});
});


















