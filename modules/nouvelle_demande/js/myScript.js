/////////////////////////////////////////////////////////////////////////////////
//       fonction exécutée au chargement de la page (<body onLoad="init()">)
/////////////////////////////////////////////////////////////////////////////////

//si c'est un nouvelle demande (new), on ajoute l'attribut onblur à chaque input
function init(){
//	if($('#mode').text() == "new"){
//	//mode nouvelle demande save
//		$(":input").attr("onblur","save()")
////		var s =$.post('../view/recup_etat.php',maj_etat);
//	}

	//si c'est un formulaire en cours de saisie, on renseigne les champs avec les valeurs présentes en BDD 
	//mode consulter / modifier
	if($('#mode').text() == "old"){
		var s =$.post('recup_en_cours.php',maj_en_cours);
	}
}

//#####################################################################################################
//			fonctions pour une nouvelle demande
//#####################################################################################################

//envoi la chaine au format JSON vers un scrpit PHP qui va écrire cette chaine dans un fichier
//nommé par l'id_depl dans la variable $_SESSION['id_depl']
function save(){
	var x = toJSON();
	x = "data="+x;
	$.post('../view/server_save.php',x);
}

//récupères les id et value des boutons et chexkboxs cochés ainsi que ceux des inputs de type text
//puis construit et renvoie une chaine au format JSON
function toJSON(){
	var obj = {"id_depl":$('#id_depl').attr('class'),"input_varchar":[],"input_radio":[]};
	//selection de tous les input de type 'text', on remplit le tableau JSON avec l'id et la valeur, saisie par l'utilisateur, de l'input
	$(":text").each(function()
	{
		obj.input_varchar.push(
			{"id":$(this).attr('id'),"val":$(this).val()}
		);
	});
	
	//selection de tous les input de type 'radio' et 'checkbox', on rempli le tableau JSON avec l'id de l'input
	$(":checked").each(function()
	{
		obj.input_radio.push(
			{"id":$(this).attr('id')}
		);
	});
	return JSON.stringify(obj);
}


function maj_etat(o)
{
	var x = JSON.parse(o);
	alert(x)
	var id =  "";
	var bl = null;

	var limit = x.input_varchar.length;
	for(i=0 ; i<limit ; i++)
	{
		id = x.input_varchar[i].id;
		bl  = document.getElementById(id);
		bl.value = x.input_varchar[i].val;
	}

	var limit = x.input_radio.length;
	for(i=0 ; i<limit ; i++)
	{
		id = x.input_radio[i].id;
		$( "#"+id ).prop( "checked", true );
		$( "#"+id ).parent().parent().show();
		$( "#"+id ).parent().parent().parent().show();
	}
}

//#####################################################################################################
//			fonctions pour une consultation / modification
//#####################################################################################################

function toJSON_FORM(){
	//var id_depl = $('#id_depl').attr('class');
	//alert(typeof(id_depl));
	var obj = {"id_depl":$('#id_depl').attr('class'),"input_varchar":[],"input_radio":[]};
	//selection de tous les input de type 'text'
	//on rempli le tableau JSON avec l'id et la valeur saisie par l'utilissateur de l'input
	$(":text").each(function()
	{
		obj.input_varchar.push(
			{"id":$(this).attr('id'),"val":$(this).val()}
		);
	});
	
	//selection de tous les input de type 'radio' et 'checkbox'
	//on rempli le tableau JSON avec l'id de l'input
	$(":checked").each(function()
	{
		obj.input_radio.push(
			{"id":$(this).attr('id')}
		);
	});

	return JSON.stringify(obj);
}

//fonction de callback lorsque les données sont reçues par l'appel AJAX du script recup_en_cours.php
//au chargement de la page lorsque l'utilisateur conslute/modifie une demande en cours de saisie
function maj_en_cours(o)
{
	var x = JSON.parse(o);
	var name  = "";
	var value = "";
	var test 
	
	//pour chaque bouton radio
	var limit = x.radio.length;
	for(i=0 ; i<limit ; i++)
	{
		name = x.radio[i].name
		value = x.radio[i].value
		//si le name d'un champ possède une valeur
		if(value != ""){
			//si on récupère d'id d'un sous statut, selon la valeur du sous statut on affecte à la variable name le name correspondant dans le formulaire HTML
			if(name == "id_statut_sub_user"){
				switch (value){
					case "1":
					case "2":
					case "3":
					case "4":
					case "12":
					default:
						name = "radioPersonnel"
						$('#divPersonnelSub').show()
						break; 
					case "5":
					case "6":
					case "7":
						name = "radioApprenti"
						$('#divApprentiSub').show()
						break;
					case "8":
					case "9":
					case "10":
					case "11":
						name = "radioEtudiant"
						$('#divEtudiantSub').show()
				}
			}
			//si on récupère l'id d'un sous cadre, selon la valeur du sous statut on affecte à la variable name le name correspondant dans le formulaire HTML
			if(name == "id_cadre_sub_depl"){
				switch (value){
					case "1":
					case "2":
					case "3":
					case "4":
					case "5":
					case "6":
					case "7":
					default:
						name = "radioFormation"
						$('#divFormationSub').show()
						break; 
					case "8":
					case "9":
					case "10":
					case "11":
					case "12":
						name = "radioRecherche"
						$('#divRechercheSub').show()
						break;
					case "13":
					case "14":
					case "15":
					case "16":
					case "17":
						name = "radioAdministration"
						$('#divAdministrationSub').show()
				}
			}
			if(name == "cadre_depl"){
				$("[name="+name+"][value="+value+"]").parent().parent().show();
			}
		}
		//on coche le bon bouton radio
		$("[name="+name+"][value="+value+"]").prop('checked', true);
	}
	
	//pour chacun des input de type text, on rapartie la valeur présente en BDD
	var limit = x.text.length;
	//alert(limit);
	for(i=0 ; i<limit ; i++)
	{
		name = x.text[i].name
		value = x.text[i].value
		$("[name="+name+"]").val(value);
		
	}
	// on affiche toutes les div qui sont cachées au chargement de la page pour afficher les valeurs saisies précédement
	// on affiche aussi les div des frais et des étapes
	$('#statutDiv, #fraisDiv, #etape, #carburantDiv, #hotelDiv, #repasDiv').slideDown()
	//on cache les boutons suivant et précédent puisque les div des frais et des étapes sont affichées
	$(".btn1, .btn2, .btn3, .btn4").hide();
}
// JavaScript Document
	
/////////////////////////////////////////////////////////////////////////////////
//       FONCTIONS ACCUEIL.PHP
/////////////////////////////////////////////////////////////////////////////////

//affecte une calculatrice pour les inputs de la classe 'money' et 'distance'
//affecte un calendrier pour les inputs id  = 'debut_depl' et 'fin_depl'

$(document).ready(function(){
		$('.money, .distance').calculator($.calculator.regionalOptions['fr']);
		
		$( "#debut_depl, #fin_depl" ).datepicker({
			inline: true,
			dateFormat: "dd/mm/yy"
		});

});

/////////////////////////////////////////////////////////////////////////////////
//       FONCTIONS DES BOUTONS SUIVANT ET PRECEDENT
/////////////////////////////////////////////////////////////////////////////////

//statut : suivant
$(document).ready(function(){
	$(".btn1").click(function(){
		$("#statutDiv").slideUp();
		$("#fraisDiv").slideDown();
		$("html, body").animate({ scrollTop: 0 }, 500);
	});
});

//frais : précédent
$(document).ready(function(){
	$(".btn2").click(function(){
		$("#statutDiv").slideDown();
		$("#fraisDiv").slideUp();
		$("html, body").animate({ scrollTop: 0 }, 500);
	});
});

//frais : suivant
$(document).ready(function(){
	$(".btn3").click(function(){
		$("#etape").slideDown();
		$("#fraisDiv").slideUp();
		$("html, body").animate({ scrollTop: 0 }, 500);
	});
});

//etapes : précédent
$(document).ready(function(){
	$(".btn4").click(function(){
		$("#fraisDiv").slideDown();
		$("#etape").slideUp();
		$("html, body").animate({ scrollTop: 0 }, 500);
	});
});

//fin du formulaire : toJSON
//affiche dans une div, la chaine au format JSON retournée par la fonction toJSON()
$(document).ready(function(){
	$(".btnsave").click(function(){
		var obj = toJSON();
		document.getElementById("demo").innerHTML = obj;
	});
});


/////////////////////////////////////////////////////////////////////////////////
//       FONCTIONS APPARITION DES sous-menus selon statut
/////////////////////////////////////////////////////////////////////////////////

//radio personnel
$(document).ready(function(){
	$("#personnel").click(function(){
		$("#divPersonnelSub").slideDown();
		$("#divNomApprenti, #divAutre, #divEtudiantSub, #divApprentiSub, #divInge2, #divInge3").slideUp();
		$("#autre, #inge3, #inge3a1, #inge2a2, #e1a").prop('required',false);
		$("#persAgefpi").prop('required',true);
		$("#formation, .cadreAll").show();
		$(".cadreSubAll").hide();
		$(".radioFormation, #formation, .radioApprenti, #lpro, .radioEtudiant, .cadre_depl, .ingeLpro").attr('checked', false);
	});
});

/////////////////////////////////////////////////////////////////////////////////

// radio apprenti
$(document).ready(function(){
	$("#apprenti").click(function(){
		$("#divApprentiSub, #divFormationSub, #divFormation").slideDown();
		$("#divNomApprenti, #divAutre, #divEtudiantSub, #divPersonnelSub, #divLigneBudgetaire, #divApprentiSubCfa").slideUp();
		$("#autre, #persAgefpi, #e1a").prop('required',false);
		$("#inge3").prop('required',true);
		$("#formation, #divRecherche, #divAdministration").hide();
		$(".radioEtudiant, .radioPersonnel, .radioRecherche, .radioAdministration .ingeLprocfa, .radioApprenticfa").attr('checked', false);
		$("#formation").attr('checked', true);
	});
});

			//radio cycle ingénieur 3 ans :
			$(document).ready(function(){
				$("#inge3").click(function(){
					$("#divInge3").slideDown();
					$("#divInge2").slideUp();
					$(".radioInge2").attr('checked', false);
					
				});
			});

			//radio cycle ingénieur 2 ans :
			$(document).ready(function(){
				$("#inge2").click(function(){
					$("#divInge2").slideDown();
					$("#divInge3").slideUp();
					$(".radioInge3").attr('checked', false);
					
				});
			});

			//radio licence pro :
			$(document).ready(function(){
				$("#lpro").click(function(){
					$("#divInge2, #divInge3").slideUp();
					$(".radioInge2, .radioInge3").attr('checked', false);
				});
			});

/////////////////////////////////////////////////////////////////////////////////

//radio etudiant
$(document).ready(function(){
	$("#etudiant").click(function(){
		$("#divEtudiantSub, #divFormationSub, #divFormation").slideDown();
		$("#divNomApprenti, #divAutre, #divApprentiSub, #divPersonnelSub, #divInge2, #divInge3, #divRecherche, #divAdministration, #divLigneBudgetaire, #divApprentiSubCfa").slideUp();
		$("#autre, #persAgefpi, #inge3, #inge3a1, #inge2a2").prop('required',false);
		$("#e1a").prop('required',true);
		$("#formation, #divRecherche, #divAdministration").hide();
		$(".radioApprenti, #lpro, .radioPersonnel, .radioRecherche, .radioAdministration, .ingeLpro .ingeLprocfa, .radioApprenticfa").attr('checked', false);
		$("#formation").attr('checked', true);
	});
});




/////////////////////////////////////////////////////////////////////////////////
//      affiches  radio boutons années si cadre formation >> cfa coché
//////////////////////////////////////////////////////////////////////////////////
				//radio cycle ingénieur 3 ans :
			$(document).ready(function(){
				$("#inge3cfa").click(function(){
					$("#divInge3cfa").slideDown();
					$("#divInge2cfa").slideUp();
					$(".radioInge2cfa").attr('checked', false);
				});
			});

			//radio cycle ingénieur 2 ans :
			$(document).ready(function(){
				$("#inge2cfa").click(function(){
					$("#divInge2cfa").slideDown();
					$("#divInge3cfa").slideUp();
					$(".radioInge3cfa").attr('checked', false);
				});
			});

			//radio licence pro :
			$(document).ready(function(){
				$("#lprocfa").click(function(){
					$("#divInge2cfa, #divInge3cfa").slideUp();
					$(".radioInge2cfa, .radioInge3cfa").attr('checked', false);
				});
			});


/////////////////////////////////////////////////////////////////////////////////
//       FONCTIONS APPARITION DES DIV formation, recherche et administration
/////////////////////////////////////////////////////////////////////////////////

//affiche div les div formation, recherche et administration
$(document).ready(function(){
	$("#personnel").click(function(){
		$(".cadreAll").slideDown();
	});
});


/////////////////////////////////////////////////////////////////////////////////
//       FONCTIONS APPARITION DES DIV formationDiv, rechercheDiv et administrationDiv
/////////////////////////////////////////////////////////////////////////////////
$(document).ready(function(){
	$("#formation").click(function(){
		$("#divFormationSub").slideDown();
		$("#divNomApprenti, #divAutre, #divRechercheSub, #divAdministrationSub, #divLigneBudgetaire").slideUp();
		$("#autre").prop('required',false);
		$(".radioRecherche, .radioAdministration").attr('checked', false);
	});
});

$(document).ready(function(){
	$("#recherche").click(function(){
		$("#divRechercheSub").slideDown();
		$("#divNomApprenti, #divAutre, #divFormationSub, #divApprentiSubCfa, #divAdministrationSub").slideUp();
		$("#autre").prop('required',false);
		$(".radioFormation, .radioAdministration, .ingeLprocfa, .radioApprenticfa").attr('checked', false);
	});
});

$(document).ready(function(){
	$("#administration").click(function(){
		$("#divAdministrationSub").slideDown();
		$("#divNomApprenti, #divAutre, #divFormationSub, #divRechercheSub, #divLigneBudgetaire, #divApprentiSubCfa").slideUp();
		$("#autre").prop('required',false);
		$(".radioFormation, .radioRecherche .ingeLprocfa, .radioApprenticfa").attr('checked', false);
	});
});


/////////////////////////////////////////////////////////////////////////////////
//       FONCTIONS AFFICHE OU CACHE DIV 'AUTRE'
/////////////////////////////////////////////////////////////////////////////////

//affiche l'input 'autre' (deplacement dans le cadre de) si radio 'autre' sélectionné et champ requis
$(document).ready(function(){
	$(".autre").click(function(){
		$("#divAutre").slideDown();
		$("#autre").prop('required',true);
	});
});

//cache l'input 'autre' (deplacement dans le cadre de) si radio sélectionné différent de 'autre' et champ n'est plus requis
$(document).ready(function(){
	$(".other").click(function(){
		
		$("#divAutre").slideUp();
		$(".ingeLprocfa, .radioApprenticfa").attr('checked', false);
		$("#autre").prop('required',false);
	});
});

/////////////////////////////////////////////////////////////////////////////////
//       FONCTIONS AFFICHE OU CACHE DIV nom apprenti
/////////////////////////////////////////////////////////////////////////////////

$(document).ready(function(){
	$(".otherFormation").click(function(){
		$("#divNomApprenti, #divApprentiSubCfa").slideUp();
		$(".ingeLprocfa, .radioApprenticfa").attr('checked', false);
	});
});


//affiche l'input 'ligne budgétaire' (deplacement dans le cadre de) si coché "dans le cadre de la Recherche"
$(document).ready(function(){
	$("#recherche").click(function(){
		$("#divLigneBudgetaire").show();
	});
});


$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});

$(document).ready(function(){
	$(".btn6").click(function(){
		var validator = $( "#odmForm" ).validate();
		validator.resetForm();
	});
});


//Pour l'enregistrement en cours de saisie, on retire la propriété 'required' à tous les input puis 
//on change le bouton de type 'button' en bouton de type 'submit'
//qui déclenche l'appel au fichier.php de l'attribut 'action' du formulaire
//etat_depl prend la valeur 1 (état encours)
$(document).ready(function(){
	$(".btnRecord").click(function(){
		$('#etat_depl').attr('value','1');
		$(':input').prop("required", false);
		$(this).attr("type", "submit");
	});
});

//pour prévenir l'envoi accidentel du formulaire par la touche entrée, on désactive la touche entrée
$(document).ready(function() {
  $(window).keydown(function(event){
	if(event.keyCode == 13) {
	  event.preventDefault();
	  return false;
	}
  });
});
	


//affiche l'input 'nom de l'apprenti' si coché "statut Personnel" ET si coché "dans le cadre de la Formation > CFA"

function afficheNomApprenti(){
    if(document.getElementById('personnel').checked){
        jQuery("#divNomApprenti, #divApprentiSubCfa").slideDown();
    }
}

function afficheAll(){
    $("#fraisDiv, #statutDiv").slideDown();
    $("html, body").animate({ scrollTop: 0 }, 500);
	$(".btn1, .btn2, .btn3, .btn4").hide();
}

