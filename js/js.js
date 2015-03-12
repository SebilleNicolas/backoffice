$seconde=0;
$seconde=0;
$minute=0;
$heure=0;
$jour=0;
d = new Date();
interupt = false;
Compteur();
// VerifTrieFiche();
Etat = $('#Cloture').is(':checked');


if(Etat =="true")
{
	interupt = true;

}

// Fonction Compteur qui appele la fonction ActualiserCompteur() toutes les secondes
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





		
//Checkbox
$("#Cloture").on("click",function(){

	if(interupt)
	 {
		// Compteur marche
		interupt = false;
		
		
	}
	else
	{
		// Compteur stop
		interupt = true;
	}
		
		IdActions = $("#Numero").attr("value");
		
	
		if(interupt)
		{
			date2 = new Date();
			Etat = "CL";
			jour = date2.getDate();
			mois = date2.getMonth()+1;
			annee = date2.getFullYear();
			Heure = date2.getHours();
			Minute = date2.getMinutes();
	
			
			if(jour<10)
			{
			jour = "0"+jour;
			}
			if(mois<10)
			{
			mois = "0"+mois;
			}
			
			
			if (Heure<10)
			{
			Heure= "0"+Heure;
			}
			
			if (Minute<10)
			{
			Minute= "0"+Minute;
			}
			
			Dates = annee+"-"+mois+ "-" + jour;
			
			
			
		}
		else
		{
			Etat = "EC";
			
			Dates = "";
			
			Heure = "";
			Minute = "";
		}
	
$.ajax({
			url: "ajax/Etat.php",
			type: "GET",
			data: {IdActions : IdActions, Etat : Etat , Dates : Dates ,Heure : Heure , Minute : Minute},
			success : function(data){
			
			$("#DateFin").val(Dates);
			$("#HeureFin").val(Heure);
			$("#MinuteFin").val(Minute);
			}
		});

		
	

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
			
			$("#newTR").html(data);
			$("#texte").val("");
			$("#NbrFiche").text(nbr);
			
		}
	});
});


$("#ButAjouterRelanceTechni").on("click", function() {
	idRelanceTechni = $("#IdAction").text();
	
	techni = $("#ListeTechnicienRappelTecnicien").val();
	type = $("#ListeTypeRappelTecnicien").val();
	
			
	
	tinyMCE.triggerSave(true,true);
	comm2 = $("#TACommentRappelTechni").val();
	
	$.ajax({
		url: "ajax/RelanceTechnicien/RelanceTechniAjouter.php",
		type: "GET",
		data: {techni : techni ,type : type , idRelanceTechni : idRelanceTechni , comm2 : comm2 },
		success : function(data){
		
			$("#AjoutRappelTechni").html( data);
			alert("Vous avez ajoute une Relance Technicien");
			tinyMCE.execCommand('mceSetContent',false,"");
			
		}
	});
});


function SupprimerFicheConsulterFiche(idFiche)
{
Test = confirm("Voulez vous supprimer la Fiche ? \n Attention, toutes les actions ou les interlocuteurs liés a cette fiche seront supprimez.\n Continuez? ");

if(Test == true)
{
nbr = $("#NombreFiche").text();
	nbr--;
	$.ajax({
		url: "ajax/ConsulterFiche/SupprimerFiche.php",
		type: "GET",
		data: {idFiche : idFiche },
		success : function(data){
			$("#tBodyConsulterFiche").html(data);
			 $("#NombreFiche").text(nbr);
			alert("Vous avez supprimez la fiche.");
		}
	});
	}else{}
	
}

function Supp(idCateg)
{
Test = confirm("Voulez vous supprimer la categorie ?");

if(Test == true)
{
 nbr = $("#NbrFiche").text();
	nbr--;
	$.ajax({
		url: "ajax/Categ/test2.php",
		type: "GET",
		data: {idCateg : idCateg },
		success : function(data){
			$("#newTR").html(data);
			 $("#NbrFiche").text(nbr);
			
		}
	});
	}else{}
	
}

function Modifier(idCateg)
{
Test = confirm("Voulez vous modifier la categorie ?");

if(Test == true)
{

Libelle = $("#TxtboxLbl"+idCateg).val();


	$.ajax({
		url: "ajax/Categ/test3.php",
		type: "GET",
		data: { Libelle : Libelle , idCateg : idCateg},
		success : function(data){
		
		}
	});
	}else{}
	
}


function SupprimerRelanceTechni(idRelanceTechni)
{
Test = confirm("Voulez vous supprimer la Relance du technicien ?");

if(Test == true)
{ idAction = $("#IdAction").text();
	$.ajax({
		url: "ajax/RelanceTechnicien/SupprimerRelanceTechni.php",
		type: "GET",
		data: {idRelanceTechni : idRelanceTechni , idAction : idAction},
		success : function(data){
		
			$("#AjoutRappelTechni").html(data);
			alert("Vous avez supprimer une Relance Technicien");
			tinyMCE.execCommand('mceSetContent',false,"");
		}
	});
	}else{}
	
}




function chargeCommentaire(idRelanceTechni)
{
tinymce.execCommand('mceFocus',true,'TACommentRappelTechni'); 
	
	$.ajax({
		url: "ajax/RelanceTechnicien/ChargerCommentaire.php",
		type: "GET",
		data: {idRelanceTechni : idRelanceTechni },
		success : function(data){
		
			 tinyMCE.get('TACommentRappelTechni').setContent(data);
			
			
		}
	});
}






$("#ButAjouterRelanceClient").on("click", function() {
	idAction = $("#IdAction").text();
	
	type = $("#ListeTypeRelanceClient").val();
	
	
	tinyMCE.triggerSave(true,true);
	comm2 = $("#TACommentRappelClient").val();

	$.ajax({
		url: "ajax/RelanceClient/AjouterRelanceClient.php",
		type: "GET",
		data: {type : type , idAction : idAction , comm2 : comm2 },
		success : function(data){
		
			$("#AjoutRelanceCli").html( data);
			alert("Vous avez ajouter une Relance Client");
			tinyMCE.execCommand('mceSetContent',false,"");
			
		}
	});
});


function SupprimerRelanceClient(idRelanceClient)
{
Test = confirm("Voulez vous supprimer la Relance Client ?");

if(Test == true)
{
	$.ajax({
		url: "ajax/RelanceClient/SupprimerRelanceClient.php",
		type: "GET",
		data: {idRelanceClient : idRelanceClient },
		success : function(data){
			$("#AjoutRelanceCli").html( data);
			alert("Vous avez supprimer une Relance Client");
			tinyMCE.execCommand('mceSetContent',false,"");
		}
	});
	}else{}
	
}




function chargeCommentaireRC(idRelanceClient)
{
	$.ajax({
		url: "ajax/RelanceClient/ChargerCommentaire.php",
		type: "GET",
		data: {idRelanceClient : idRelanceClient },
		success : function(data){
		tinyMCE.get('TACommentRappelClient').setContent(data);
			
		}
	});
	
}


$("#SelectInterlocuteur").on("click", function() {

	 var shOpt = $(this).find('option:selected');
	IdInter = shOpt.val();
	$.ajax({
		url: "ajax/Interlocuteur/ChargeInter.php",
		type: "GET",
		data: {IdInter : IdInter },
		success : function(data){
			
			$("#Interlocuteur").html(data);
			
		}
	});
	

});

$("#SelectSujet").on("click", function() {

	 var shOpt = $(this).find('option:selected');
	IdSujet = shOpt.val();
	$.ajax({
		url: "ajax/Sujet/ChargeSujet.php",
		type: "GET",
		data: {IdSujet : IdSujet },
		success : function(data){
			
			tinyMCE.get('TASujetBaseDeConnaissance').setContent(data);
			
			
		}
	});
	

});

$("#ButAjouterInterlocuteur").on("click", function() {
	idFS = $("#FS").text();
	idAction =  $("#IdAction").text();
	
	NomI = $("#NouveauNomI").val();
	PrenomI = $("#NouveauPrenomI").val();
	TelMobile = $("#NouveauTelMobile").val();
	
	Email = $("#NouveauEmailI").val();
	if (NomI != "")
	{
	$.ajax({
		url: "ajax/Interlocuteur/AjouterInterlocuteur.php",
		type: "GET",
		data: {NomI : NomI , idFS : idFS , PrenomI : PrenomI , TelMobile : TelMobile ,Email : Email , idAction  :idAction },
		success : function(data){
		val = $("#SelectInterlocuteur").html();
			$("#SelectInterlocuteur").html( val + data);
			$("#SelectInterlocuteurRA").html( val + data);
			 $("#NouveauNomI").val("");
			$("#NouveauPrenomI").val("");
			$("#NouveauTelMobile").val("");
			$("#NouveauEmailI").val("");
			alert("Vous avez Ajouter un interlocuteur");
								}
	});
	}
	else
	{alert("Veuillez au minimum renseigner le nom de l'interlocuteur");}
});



function SupprimerInter(interlocuteur)
{
IdInterlocu = $("#IdInterlocu").text();

if(interlocuteur != null)
{
nbrI = document.getElementById("SelectInterlocuteur").options.length;

verif=false;
if(IdInterlocu == interlocuteur){
Test = confirm("Voulez vous supprimer l'interlocuteur ? \n Attention, en supprimant cette interlocuteur vous supprimer aussi l'action en cours. "+
" \n Si vous souhaitez conservé l'action en cours, Ajouter un nouvel interlocuteur,valider et enregistrer l'action puis supprimer l'ancien interlocuteur dans \n 'AjouterDesParametres-->Interlocuteur-->Supprimer'.");
verif=true;

}
else
{
Test = confirm("Voulez vous supprimer l'interlocuteur ?");
}


if(Test == true && verif == false)
{
	IdFS = $("#FS").text();
	
			
	$.ajax({
		url: "ajax/Interlocuteur/SupprimerInterlocuteur.php",
		type: "GET",
		data: {IdInter : IdInter , IdFS : IdFS},
		success : function(data){
			$("#SelectInterlocuteur").html(data);
			$("#SelectInterlocuteurRA").html(data);
			alert("Vous avez supprimer un interlocuteur");
			$("#nomInter").val("");
			$("#prenomInter").val("");
			$("#TelMobInter").val("");
			$("#emailInter").val("");
		nbrL = document.getElementById("SelectInterlocuteur").options.length;
		
			if ( nbrL == 0)
			{
				$("#Interlocuteur").html("");
				
			}
		
		}
	});
}

else if(Test == true && verif == true)
{
	IdFS = $("#FS").text();
	
			
	$.ajax({
		url: "ajax/Interlocuteur/SupprimerInterlocuteur.php",
		type: "GET",
		data: {IdInter : IdInter , IdFS : IdFS},
		success : function(data){
			$("#SelectInterlocuteur").html(data);
			$("#SelectInterlocuteurRA").html(data);
			alert("Vous avez supprimer un interlocuteur");
			$("#nomInter").val("");
			$("#prenomInter").val("");
			$("#TelMobInter").val("");
			$("#emailInter").val("");
		nbrL = document.getElementById("SelectInterlocuteur").options.length;
		
			if ( nbrL == 0)
			{
				$("#Interlocuteur").html("");
				
			}
		 document.location.href="../php/ConsulterFiche.php"
		}
	});
}
	else
	{}	
	}
	else
	{
		alert("Veuiller cliquez sur l'interlocuteur a supprimer.");
	}
}

function ModifierInter(IdInter)
{
Test = confirm("Voulez vous modifier l'interlocuteur ?");

if(Test == true)
{
			Nom =	$("#nomInter").val();
			Prenom = $("#prenomInter").val();
			TelM = $("#TelMobInter").val();
			email = $("#emailInter").val();
	IdFS = $("#FS").text();
	$.ajax({
		url: "ajax/Interlocuteur/ModifierInterlocuteur.php",
		type: "GET",
		data: {IdInter : IdInter , IdFS : IdFS ,  Nom : Nom , Prenom : Prenom , TelM : TelM , email : email },
		success : function(data){
			$("#SelectInterlocuteur").html(data);
			$("#SelectInterlocuteurRA").html(data);
			alert("Vous avez Modifier l'interlocuteur");
			
		}
	});
	}
	else
	{}	
}

$("#AjouterProchaineAction").on("click", function() {

	 DatePA = $("#DatePA").val();
	 ListeTechniongletRappelAction = $("#ListeTechniongletRappelAction").val();
     ListeEPAongletRappelAction = $("#ListeEPAongletRappelAction").val();
	 ListeTypeDemandeongletRappelAction = $("#ListeTypeDemandeongletRappelAction").val();
	NumProchaineAction = $("#NumProchaineAction").val();
	DebutHeurePA = $("#DebutHeurePA").val();
	  DebutMinutePA = $("#DebutMinutePA").val();
	  FinHeurePA = $("#FinHeurePA").val();
    FinMinutePA = $("#FinMinutePA").val();
	 ObjetPA = $("#ObjetPA").val(); 
	 idFicheS = $("#FS").text();
	 idInterlocuteur = $("#SelectInterlocuteurRA").val();
	
	 tinyMCE.triggerSave(true,true);
	CommDescription = $("#DescriptionPA").val();
	 CommSolution = $("#SolutionPA").val();
	 
	$.ajax({
		url: "ajax/ProchaineAction/AjouterProchaineAction.php",
		type: "GET",
		data: {DatePA : DatePA ,ListeTechniongletRappelAction : ListeTechniongletRappelAction ,ListeEPAongletRappelAction : ListeEPAongletRappelAction ,
		ListeTypeDemandeongletRappelAction : ListeTypeDemandeongletRappelAction ,NumProchaineAction : NumProchaineAction ,DebutHeurePA : DebutHeurePA ,DebutMinutePA : DebutMinutePA ,
		FinHeurePA : FinHeurePA ,FinMinutePA : FinMinutePA ,ObjetPA : ObjetPA , CommDescription : CommDescription  ,CommSolution : CommSolution , idFicheS : idFicheS, idInterlocuteur: idInterlocuteur },
		success : function(data){
		
			if(data == "-1")
			{alert("Erreur lors de l'ajout de la prochaine action, Verifier que la date,le numero, le destinataire et l'interlocuteur sont bien remplis.");	}
			else if (data == "1") { alert("Votre action a ete ajoute ! ");}
			
		}
	});
	

});
function ConsulterActions(IdAction,IdFS)
{
Test = confirm("Voulez vous modifier l'action ?");

if(Test == true)
{

	
	   document.location.href="../php/2.php?idaction="+IdAction+"&id="+IdFS;
	}
	else
	{}	
}
function ConsulterActionsVisiteur(IdAction)
{
Test = confirm("Voulez vous Consulter l'action ?");

if(Test == true)
{
	
	IdFS = $("#FicheS").text();

	   document.location.href="../php/ConsulterVisiteur.php?idaction="+IdAction+"&id="+IdFS;
	}
	else
	{}	
	

}
function SupprimerActions(idAction)
{
Test = confirm("Voulez vous supprimer l'action ?");

if(Test == true)
{
	
	IdFS = $("#FicheS").text();
	
	
	nbrAction = $("#NbrActionConsultAction").text();
	nbrAction--;
	$.ajax({
		url: "ajax/consulterAction/SupprimerActions.php",
		type: "GET",
		data: {  idAction : idAction,  IdFS : IdFS},
		success : function(data){
			$("#tbodyConsultActions").html( data);
			 alert("Votre action a ete supprime.");
			 $("#NbrActionConsultAction").html( nbrAction);
		}
	});
	   
	}
	else
	{}	
	

}

function SupprimerActionsPeriode(idAction , etat)
{
Test = confirm("Voulez vous supprimer l'action ?");

if(Test == true)
{
	dateDeb = $("#dateDebConsultAction").val(); 
	dateFin =  $("#dateFinConsultAction").val(); 
	
	if(etat == "EC")
	{
		
	
	$.ajax({
		url: "ajax/RechercheActionPeriode/SupprimerActionsEC.php",
		type: "GET",
		data: {  idAction : idAction , dateDeb : dateDeb , dateFin : dateFin},
		success : function(data){
			$("#tbodyConsultActionsPeriodeEC").html( data);
			 alert("Votre action a ete supprime.");
			
		}
	});
	}
	if(etat == "CL")
	{
	$.ajax({
		url: "ajax/RechercheActionPeriode/SupprimerActionsCL.php",
		type: "GET",
		data: {  idAction : idAction, dateDeb : dateDeb , dateFin : dateFin},
		success : function(data){
			$("#tbodyConsultActionsPeriode").html( data);
			 alert("Votre action a ete supprime.");
			
		}
	});
	}
	   
	}
	else
	{}	
	

}
$("#AjouterNumSerieLogi").on("click", function() {
		IdAction = $("#IdAction").text();
	  NouveauNumSerieLogi = $("#NouveauNumSerieLogi").val();
	  var shOpt = $("#SelectSujet").find('option:selected');
		ListeMotifsLogi = $("#ListeMotifsLogi").val();

	 if( NouveauNumSerieLogi != "" && ListeMotifsLogi != null){
	$.ajax({
		url: "ajax/Logiciel/AjouterLogi.php",
		type: "GET",
		data: {  IdAction : IdAction,  NouveauNumSerieLogi : NouveauNumSerieLogi, ListeMotifsLogi : ListeMotifsLogi},
		success : function(data){
		
		val = $("#tbodyNumeroSerieLogi").html();
		
			$("#tbodyNumeroSerieLogi").html(val + data);
			 $("#NouveauNumSerieLogi").val("");
	$("#ListeMotifsLogi").val("");
	 
		}
	});
	}
	else
	{
		alert("Une erreur est survenu, veuillez remplir tous les champs.");
	}

});

function SupprimerNumSerieLogi(idNumeroSerie)
{
Test = confirm("Voulez vous supprimer le numero de serie ?");
	
if(Test == true)
{
 
IdAction = $("#IdAction").text();
	$.ajax({
		url: "ajax/Logiciel/SupprimerLogi.php",
		type: "GET",
		data: { idNumeroSerie : idNumeroSerie , IdAction : IdAction },
		success : function(data){
			$("#tbodyNumeroSerieLogi").html(data);
			
		}
	});
}
	else
	{}	
}

$("#AjouterNumSerieMater").on("click", function() {
		IdAction = $("#IdAction").text();
	  NouveauNumSerieMater = $("#NouveauNumSerieMater").val();
		ListeMotifsMater = $("#ListeMotifsMater").val();
	 if( NouveauNumSerieMater != "" && ListeMotifsMater != null){
	$.ajax({
		url: "ajax/Materiel/AjouterMater.php",
		type: "GET",
		data: {  IdAction : IdAction,  NouveauNumSerieMater : NouveauNumSerieMater, ListeMotifsMater : ListeMotifsMater},
		success : function(data){
		
		val = $("#tbodyNumeroSerieMater").html();
		
			$("#tbodyNumeroSerieMater").html(val + data);
			 $("#NouveauNumSerieMater").val("");
	$("#ListeMotifsMater").val("");
	 
		}
	});
	}
	else
	{
		alert("Une erreur est survenu, veuillez remplir tous les champs.");
	}

});

function SupprimerNumSerieMater(idNumeroSerie)
{
Test = confirm("Voulez vous supprimer le numero de serie ?");
	
if(Test == true)
{
 
IdAction = $("#IdAction").text();
	$.ajax({
		url: "ajax/Materiel/SupprimerMater.php",
		type: "GET",
		data: { idNumeroSerie : idNumeroSerie , IdAction : IdAction },
		success : function(data){
			$("#tbodyNumeroSerieMater").html(data);
			
		}
	});
}
	else
	{}	
}

function SupprimerEtatProchaineAction(idEtatPA)
{
Test = confirm("Voulez vous supprimer cette Etat ?");
	
if(Test == true)
{
 

	$.ajax({
		url: "ajax/EtatProchaineAction/SupprimerEtatProchaineAction.php",
		type: "GET",
		data: { idEtatPA : idEtatPA },
		success : function(data){
			$("#tbodyEtatPA").html(data);
			
		}
	});
}
	else
	{}	
}

function ModifierInterlocuteurParam(IdInter)
{
Test = confirm("Voulez vous modifier l'interlocuteur ?");

if(Test == true)
{
			Nom =	$("#NomInterlocuteur" +IdInter).val();
			Prenom = $("#PrenomInterlocuteur"+IdInter).val();
			TelM = $("#TelMobileInterlocuteur"+IdInter).val();
			email = $("#EmailInterlocuteur"+IdInter).val();
			Societe = $("#ListeSocieteInterlocuteur"+IdInter).val();
	
	$.ajax({
		url: "ajax/ParametreInterlocuteur/ModifierInterlocuteur.php",
		type: "GET",
		data: {IdInter : IdInter , Nom : Nom , Prenom : Prenom , TelM : TelM , email : email, Societe : Societe },
		success : function(data){
			$("#TbodyInterParam").html(data);
		
			alert("Vous avez Modifier l'interlocuteur");
			
		}
	});
	}
	else
	{}	
}
	
function SupprimerInterlocuteurParam(IdInter)
{
Test = confirm("Voulez vous supprimer cette interlocuteur ?");
	
if(Test == true)
{
	$.ajax({
		url: "ajax/ParametreInterlocuteur/SupprimerInterlocuteur.php",
		type: "GET",
		data: { IdInter : IdInter },
		success : function(data){
			$("#TbodyInterParam").html(data);
			
		}
	});
}
	else
	{}	
}

$("#CheckBoxTrierFicheOrdreCroissant").on("click", function() {
		TrierFicheOrdreCroissant = $('#CheckBoxTrierFicheOrdreCroissant').is(':checked');
		TrierParNbrActions = $('#CheckBoxTrierParNbrActions').is(':checked');
		  $('#tBodyConsulterFiche').html('<img style="margin-left: 600px; box-shadow: none;"src="../images/ajax-loader.gif">')
	if (TrierFicheOrdreCroissant == true && TrierParNbrActions == false)
	{verif = 1;
		$.ajax({
		url: "ajax/ConsulterFiche/TrierParOrdreCroissant.php",
		type: "GET",
		data: { verif : verif },
		success : function(data){
			$("#tBodyConsulterFiche").html(data);
			
		}
	});
	}
	else if (TrierFicheOrdreCroissant == true && TrierParNbrActions == true)
	{
	verif = 1;
		$.ajax({
		url: "ajax/ConsulterFiche/TrierParNbrActionsEtOrdreAlpha.php",
		type: "GET",
		data: { verif : verif },
		success : function(data){
			$("#tBodyConsulterFiche").html(data);
			
		}
	});
	}
	else if (TrierFicheOrdreCroissant == false && TrierParNbrActions == true)
	{verif = 1;
		$.ajax({
		url: "ajax/ConsulterFiche/TrierParNbrActions.php",
		type: "GET",
		data: { verif : verif },
		success : function(data){
			$("#tBodyConsulterFiche").html(data);
			
		}
	});
	}
	else
	{
	verif = 1;
		$.ajax({
		url: "ajax/ConsulterFiche/RemmetreNormal.php",
		type: "GET",
		data: { verif : verif },
		success : function(data){
			$("#tBodyConsulterFiche").html(data);
			
		}
	});
	}

});

$("#CheckBoxTrierParNbrActions").on("click", function() {
		TrierParNbrActions = $('#CheckBoxTrierParNbrActions').is(':checked');
		TrierFicheOrdreCroissant = $('#CheckBoxTrierFicheOrdreCroissant').is(':checked');
		  $('#tBodyConsulterFiche').html('<img style="margin-left: 600px; box-shadow: none;"src="../images/ajax-loader.gif">')
	if (TrierFicheOrdreCroissant == false && TrierParNbrActions == true )
	{verif = 1;
		$.ajax({
		url: "ajax/ConsulterFiche/TrierParNbrActions.php",
		type: "GET",
		data: { verif : verif },
		success : function(data){
			$("#tBodyConsulterFiche").html(data);
			
		}
	});
	}
	else if (TrierFicheOrdreCroissant == true && TrierParNbrActions == true)
	{
	verif = 1;
		$.ajax({
		url: "ajax/ConsulterFiche/TrierParNbrActionsEtOrdreAlpha.php",
		type: "GET",
		data: { verif : verif },
		success : function(data){
			$("#tBodyConsulterFiche").html(data);
			
		}
	});
	}
	else if (TrierFicheOrdreCroissant == true && TrierParNbrActions == false)
	{
	verif = 1;
		$.ajax({
		url: "ajax/ConsulterFiche/TrierParOrdreCroissant.php",
		type: "GET",
		data: { verif : verif },
		success : function(data){
			$("#tBodyConsulterFiche").html(data);
			
		}
	});
	}
	else
	{
	verif = 1;
		$.ajax({
		url: "ajax/ConsulterFiche/RemmetreNormal.php",
		type: "GET",
		data: { verif : verif },
		success : function(data){
			$("#tBodyConsulterFiche").html(data);
			
		}
	});
	}

});
$("#CheckBoxTrierFicheOrdreCroissantVis").on("click", function() {
		TrierFicheOrdreCroissant = $('#CheckBoxTrierFicheOrdreCroissantVis').is(':checked');
		TrierParNbrActions = $('#CheckBoxTrierParNbrActionsVis').is(':checked');
		  $('#tBodyConsulterFiche').html('<img style="margin-left: 600px; box-shadow: none;"src="../images/ajax-loader.gif">')
	if (TrierFicheOrdreCroissant == true && TrierParNbrActions == false)
	{verif = 1;
		$.ajax({
		url: "ajax/ConsulterFicheVisiteur/TrierParOrdreCroissant.php",
		type: "GET",
		data: { verif : verif },
		success : function(data){
			$("#tBodyConsulterFiche").html(data);
			
		}
	});
	}
	else if (TrierFicheOrdreCroissant == true && TrierParNbrActions == true)
	{
	verif = 1;
		$.ajax({
		url: "ajax/ConsulterFicheVisiteur/TrierParNbrActionsEtOrdreAlpha.php",
		type: "GET",
		data: { verif : verif },
		success : function(data){
			$("#tBodyConsulterFiche").html(data);
			
		}
	});
	}
	else if (TrierFicheOrdreCroissant == false && TrierParNbrActions == true)
	{verif = 1;
		$.ajax({
		url: "ajax/ConsulterFicheVisiteur/TrierParNbrActions.php",
		type: "GET",
		data: { verif : verif },
		success : function(data){
			$("#tBodyConsulterFiche").html(data);
			
		}
	});
	}
	else
	{
	verif = 1;
		$.ajax({
		url: "ajax/ConsulterFicheVisiteur/RemmetreNormal.php",
		type: "GET",
		data: { verif : verif },
		success : function(data){
			$("#tBodyConsulterFiche").html(data);
			
		}
	});
	}

});
$("#CheckBoxTrierParNbrActionsVis").on("click", function() {
		TrierParNbrActions = $('#CheckBoxTrierParNbrActionsVis').is(':checked');
		TrierFicheOrdreCroissant = $('#CheckBoxTrierFicheOrdreCroissantVis').is(':checked');
		  $('#tBodyConsulterFiche').html('<img style="margin-left: 600px; box-shadow: none;"src="../images/ajax-loader.gif">')
	if (TrierFicheOrdreCroissant == false && TrierParNbrActions == true )
	{verif = 1;
		$.ajax({
		url: "ajax/ConsulterFicheVisiteur/TrierParNbrActions.php",
		type: "GET",
		data: { verif : verif },
		success : function(data){
			$("#tBodyConsulterFiche").html(data);
			
		}
	});
	}
	else if (TrierFicheOrdreCroissant == true && TrierParNbrActions == true)
	{
	verif = 1;
		$.ajax({
		url: "ajax/ConsulterFicheVisiteur/TrierParNbrActionsEtOrdreAlpha.php",
		type: "GET",
		data: { verif : verif },
		success : function(data){
			$("#tBodyConsulterFiche").html(data);
			
		}
	});
	}
	else if (TrierFicheOrdreCroissant == true && TrierParNbrActions == false)
	{
	verif = 1;
		$.ajax({
		url: "ajax/ConsulterFicheVisiteur/TrierParOrdreCroissant.php",
		type: "GET",
		data: { verif : verif },
		success : function(data){
			$("#tBodyConsulterFiche").html(data);
			
		}
	});
	}
	else
	{
	verif = 1;
		$.ajax({
		url: "ajax/ConsulterFicheVisiteur/RemmetreNormal.php",
		type: "GET",
		data: { verif : verif },
		success : function(data){
			$("#tBodyConsulterFiche").html(data);
			
		}
	});
	}

});

$("#CheckBoxTrierInterParSociete").on("click", function() {
		TrierFicheOrdreCroissant = $('#CheckBoxTrierInterParSociete').is(':checked');
		  $('#TbodyInterParam').html('<img style="margin-left: 600px; box-shadow: none;"src="../images/ajax-loader.gif">')
	if (TrierFicheOrdreCroissant)
	{verif = 1;
		$.ajax({
		url: "ajax/ParametreInterlocuteur/TrierParSociete.php",
		type: "GET",
		data: { verif : verif },
		success : function(data){
			$("#TbodyInterParam").html(data);
			
		}
	});
	}
	else
	{
	verif = 1;
		$.ajax({
		url: "ajax/ParametreInterlocuteur/RemmetreNormal.php",
		type: "GET",
		data: { verif : verif },
		success : function(data){
			$("#TbodyInterParam").html(data);
			
		}
	});
	}

});



$("#AjouterSujet").on("click", function() {

	 NouveauNomSujet = $("#NouveauNomSujet").val();
	 
	tinyMCE.triggerSave(true,true);
	commSujet = $("#TASujetBaseDeConnaissance").val();	
	 
	$.ajax({
		url: "ajax/Sujet/AjouterSujet.php",
		type: "GET",
		data: {NouveauNomSujet : NouveauNomSujet, commSujet : commSujet },
		success : function(data){
		if(data != "-1"){
			val = $("#SelectSujet").html();
			
			$("#SelectSujet").html(val + data);
			
			alert("Vous avez ajouter un sujet dans la base de connaissance.");
			tinyMCE.execCommand('mceSetContent',false,"");
			  $("#NouveauNomSujet").val("");
			}
			else
			{
				alert("Vous avez oubliez de remplie le nom du sujet ou la solution. Ressayez.");
			}
			
			
		}
	});
	

});

$("#SupprimerSujet").on("click", function() {

	Test = confirm("Voulez vous supprimer ce sujet de la base de connaissance ?");
	
if(Test == true)
{
	 var shOpt = $("#SelectSujet").find('option:selected');
	IdSujet = shOpt.val();
	
		$.ajax({
		url: "ajax/Sujet/SupprimerSujet.php",
		type: "GET",
		data: {IdSujet : IdSujet },
		success : function(data){
	
			$("#SelectSujet").html( data);
			
			alert("Vous avez supprimer le sujet de la base de connaissance.");
			tinyMCE.execCommand('mceSetContent',false,"");
								}
	});
	}
	else{}

});

$("#AjouterSujetDecription").on("click", function() {

	
	 
	tinyMCE.triggerSave(true,true);
	commSujet = $("#TASujetBaseDeConnaissance").val();
	
	
	tinyMCE.get('ContenuTextSolution').setContent(commSujet);


	 alert("Le Sujet de la base de connaissance a ete ajoute dans la solution de l'action.");
	change_onglet('descript');
	

});

$("#BouttonRechercheConsultDate").on("click", function() {

	dateDeb = $("#dateDebConsultAction").val(); 
	dateFin =  $("#dateFinConsultAction").val(); 
	
	$.ajax({
		url: "ajax/RechercheActionPeriode/recherche.php",
		type: "GET",
		data: {dateDeb : dateDeb , dateFin : dateFin },
		success : function(data){
	
			$("#tbodyConsultActionsPeriode").html( data);
			
								}
	});

	

});



$("#ButCocherCheckBox").on("click", function() {
if( $('#ButCocherCheckBox').is(':checked')){
var checkboxes = document.getElementById("FormConsutActionPeriode").getElementsByTagName("input");
for (var i = 0, iMax = checkboxes.length; i < iMax; ++i) {


   var check = checkboxes[i];
   if (check.type == "checkbox") {

 checkboxes[i].checked = true;
   }
														}
}
if (!$('#ButCocherCheckBox').is(':checked')){

var checkboxes = document.getElementById("FormConsutActionPeriode").getElementsByTagName("input");
for (var i = 0, iMax = checkboxes.length; i < iMax; ++i) {


   var check = checkboxes[i];
   if (check.type == "checkbox") {

 checkboxes[i].checked = false;;
   }
}
}
});
$("#ButDecocherCheckBox").on("click", function() {


});