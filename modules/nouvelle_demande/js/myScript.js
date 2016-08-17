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


function maj_en_cours(o)
{
	var x = JSON.parse(o);
	var name  = "";
	var value = "";
	var test 
	
	var limit = x.radio.length;
	for(i=0 ; i<limit ; i++)
	{
		name = x.radio[i].name
		value = x.radio[i].value
		if(value != ""){
			$("[name="+name+"][value="+value+"]").prop('checked', true);
//
//			$("[name="+name+"][value="+value+"]").parent().parent().show();
//			$("[name="+name+"][value="+value+"]").parent().parent().parent().show();
		}
//		if($('input[type=radio][name=radioPersonnel]:checked').length == 1) $('#divPersonnelSub').show()
//		if(test = $('input[type=radio][name=radioPersonnel]:checked').length == 1) alert(test)

//		if($('input[type=radio][name=radioApprenti]:checked').length == 1) $('#divApprentiSub').show()
//		if($('input[type=radio][name=radioPersonnel]:checked').length == 1) $('#divPersonnelSub').show()
//		if($('input[type=radio][name=radioPersonnel]:checked').length == 1) $('#divPersonnelSub').show()
//		if($('input[type=radio][name=radioPersonnel]:checked').length == 1) $('#divPersonnelSub').show()
//		if($('input[type=radio][name=radioPersonnel]:checked').length == 1) $('#divPersonnelSub').show()
//		if($('input[type=radio][name=radioPersonnel]:checked').length == 1) $('#divPersonnelSub').show()

	}
	test = $('input[type=radio][name=radioPersonnel]:checked').length
	alert(test)
	
	
	var limit = x.text.length;
	//alert(limit);
	for(i=0 ; i<limit ; i++)
	{
		name = x.text[i].name
		value = x.text[i].value
		$("[name="+name+"]").val(value);
		
	}
	
	$('#statutDiv, #fraisDiv, #etape, #carburantDiv, #hotelDiv, #repasDiv').slideDown()
	$(".btn1, .btn2, .btn3, .btn4").hide();
}

/////////////////////////////////////////////////////////////////////////////////
//       FONCTIONS AJOUT ET SUPPRESSION DES ETAPES
/////////////////////////////////////////////////////////////////////////////////

jQuery( document ).ready(function() {
    if(jQuery(".number-list .fields").length >= 8){
        jQuery(".add-number").prop('disabled', 'disabled');
    }else{
        jQuery(".add-number").prop('disabled', false);
    }

    // add number
    //tant que le nombre d'étape est inférieur à 8, on ajoute les champs concernant une étape et pour chaque étape, on ajoute bouton pour la supprimer
    var count = 0;
    jQuery(".add-number").click(function() {
        count = jQuery(".number-list .fields").length;
        count++;
        if(count <= 8){
            var i;
            for (i = 1; i <= 8; i++) {
                if(!jQuery('input[name=depart-input'+i+']').length){
                    jQuery(".number-list").append('<li class="fields field-number-'+ count +' list-group-item"><h4>Etape '+count+'</h4><div class="field" id="field'+ count +'"></div></li>');

                    jQuery("#field"+count+"").append('<div class="form-group well well-sm" id="mode'+ count +'"></div>');
                    jQuery("#mode"+ count +"").append('<label>Choisir le mode approprié</label>');
                    jQuery("#mode"+ count +"").append('<div class="radio"><label  for="modeTrain'+ count +'"><input type="radio" id="modeTrain'+ count +'" value="modeTrain" name="radioMode'+ count +'">Train / R.E.R</label></div>');
                    jQuery("#mode"+ count +"").append('<div class="radio"><label  for="modeAvion'+ count +'"><input type="radio" id="modeAvion'+ count +'" value="modeAvion" name="radioMode'+ count +'">Avion</label></div>');
                    jQuery("#mode"+ count +"").append('<div class="radio"><label  for="modeTaxi'+ count +'"><input type="radio" id="modeTaxi'+ count +'" value="modeTaxi" name="radioMode'+ count +'">Taxi</label></div>');
                    jQuery("#mode"+ count +"").append('<div class="radio"><label  for="modeNavetteCar'+ count +'"><input type="radio" id="modeNavetteCar'+ count +'" value="modeNavetteCar" name="radioMode'+ count +'">Navette / Car</label></div>');
                    jQuery("#mode"+ count +"").append('<div class="radio"><label  for="modeVoitLoc'+ count +'"><input type="radio" id="modeVoitLoc'+ count +'" value="modeVoitLoc" name="radioMode'+ count +'">Voiture de location</label></div>');
                    jQuery("#mode"+ count +"").append('<div class="radio"><label  for="modeVoitPerso'+ count +'"><input type="radio" id="modeVoitPerso'+ count +'" value="modeVoitPerso" name="radioMode'+ count +'" data-toggle="collapse" data-target="#voitPersoDiv'+ count +'">Voiture personnelle</label></div>');
                    jQuery("#mode"+ count +"").append('<div id="voitPersoDiv'+ count +'" class="collapse"><label class="sr-only" for="puisFisc'+ count +'">Puissance fiscale du véhicule</label><input type="number" class="form-control" id="puisFisc'+ count +'"  value="" placeholder="Entrez le nombre de CV figurant sur la carte grise" name="puisFisc'+ count +'"></div>');

                    jQuery("#field"+count+"").append('<div class="field"><div class="form-group" id="depart-div'+count+'"><label  for="depart-input'+count+'">Ville de départ '+count+'</label><input type="text" class="form-control" id="depart-input'+count+'" placeholder="Entrez la ville de départ" name="depart'+count+'" value="" required></div></div>');

                    jQuery("#field"+count+"").append('<div class="form-group" id="destination-div'+count+'"><label for="destination-input'+count+'">Ville de destination '+count+'</label><input type="text" class="form-control floating-box" id="destination-input'+count+'" placeholder="Entrez la ville de destination" name="destination'+count+'" value="" required></div>');

                    jQuery("#field"+count+"").append('<div class="form-group" id="verifDist'+ count +'"></div>');
                    jQuery("#verifDist"+ count +"").append('<button type="button" class="btn btn-info" onclick="calcDist(\'depart-input'+count+'\',\'destination-input'+count+'\',\'distance'+count+'\')" data-toggle="collapse" data-target="#dist'+count+'">Vérifier distance</button>');
                    jQuery("#verifDist"+ count +"").append('<div id="dist'+count+'" class="collapse"><div class="form-group"><label  for="distance'+count+'">Kilométrage</label><input type="text" class="form-control distance" id="distance'+count+'" name="distance'+count+'" placeholder=""></div>');
                    jQuery("#verifDist"+ count +"").append('<div class="form-group"><label class="radio-inline" for="allersimple'+count+'"><input type="radio" name="radioAllerRetour'+count+'" id="allersimple'+count+'" onClick="allerSimple(\'distance'+count+'\')" checked>Aller simple</label><label class="radio-inline" for="allerretour'+count+'"><input type="radio" name="radioAllerRetour'+count+'" id="allerretour'+count+'" onClick="allerRetour(\'distance'+count+'\')">Aller et retour</label></div>');
                    jQuery("#verifDist"+ count +"").append('<div><span onclick="remove_number(this)" data-remove="'+count+'" class="remove-number floating-box glyphicon glyphicon-trash" title="Supprimer étape"></span><label id="destination-div'+count+'-error" class="error" for="destination-div'+count+'"></label></div>');
                    initMap(count);
                    break;
                }
            }
            if(count >= 8){
                jQuery(".add-number").attr( "disabled", "disabled" );
            }
        }
    });
	
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
	
	$(document).ready(function() {
	  $(window).keydown(function(event){
		if(event.keyCode == 13) {
		  event.preventDefault();
		  return false;
		}
	  });
	});	

	
});

//supprime la div de la classe 'field number + numero'(numéro récupéré par la valeur de l'attribut data-remove de la balise span passée en parametre) et son contenu
function remove_number(that){
    var id = jQuery(that).attr('data-remove');
    jQuery(".field-number-"+id).remove();

    count = jQuery(".number-list .fields").length;
    if(count < 8){
        jQuery(".add-number").prop('disabled', false);
    }
}


/////////////////////////////////////////////////////////////////////////////////
//       FONCTIONS aller  retour
/////////////////////////////////////////////////////////////////////////////////

//si coché, double la distance calculée précédemment
function allerRetour(x){
    var e = document.getElementById(x);
    jQuery(e).val(($(e).val().replace(" km","") * 2) + " km");
}

//si coché, divise par 2 la distance calculée précédemment
function allerSimple(x){
    var e = document.getElementById(x);
    jQuery(e).val(($(e).val().replace(" km","") / 2) + " km");
}

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

/////////////////////////////////////////////////////////////////////////////////
//       FONCTIONS API GOOGLE MAP
/////////////////////////////////////////////////////////////////////////////////

//au lancement de la page, rend les champs ville de départ et d'arrivée avec l'autocomplétion via l'API Google Map
function initMap(count) {
    var depart2 = (document.getElementById("depart-input1"));
    var destination2 = document.getElementById('destination-input1');

    var autocomplete = new google.maps.places.Autocomplete(depart2);
    var autocomplete2 = new google.maps.places.Autocomplete(destination2);

    var depart = (document.getElementById("depart-input"+count));
    var destination = document.getElementById('destination-input'+count);

    var autocomplete = new google.maps.places.Autocomplete(depart);
    var autocomplete2 = new google.maps.places.Autocomplete(destination);
}

//prend en parametres x et y les id des input où sont présentes les adresses de départ et de destination, prend z en paramètre qui est l'input pour afficher la distance calculée
function calcDist(x,y,z){
    var count = z.charAt(8);
    //alert(count);
    var markersArray = [];
    var depart = (document.getElementById(x).value);

    var destination = document.getElementById(y).value;
    //alert(depart);
    if(depart=="" || destination==""){
        alert("la ville / l'adresse de départ ET de destination doivent être saisis.");
        //jQuery("#distDiv").slideUp();
    }else {
        jQuery("#distDiv"+count).slideDown();
        jQuery("#occurence").slideDown();

        var service = new google.maps.DistanceMatrixService;

        service.getDistanceMatrix({
            origins: [depart],
            destinations: [destination],
            travelMode: google.maps.TravelMode.DRIVING,
            unitSystem: google.maps.UnitSystem.METRIC,
            avoidHighways: false,
            avoidTolls: false
        }, function(response, status) {
            if (status !== google.maps.DistanceMatrixStatus.OK) {
                alert('Error was: ' + status);
            } else {
                var inputDistance = document.getElementById(z);
                inputDistance.value = "";
                var results = response.rows[0].elements;
                inputDistance.value += results[0].distance.text;
            }
        });
    }
}


	
function calcDistAllMode(x,y,z){
	//on récupère le numéro d'étape
	var count = y.substring(17);
	var depart = (document.getElementById(x).value);
	var destination = document.getElementById(y).value;
    if(depart=="" || destination==""){
        alert("la ville / l'adresse de départ ET de destination doivent être saisis.");
        //jQuery("#distDiv").slideUp();
    }else {
		if($('#modeTrain'+count).prop(checked)){
			var strJSON = {"ville_depart":depart,"ville_destination":destination}
			
			$.post('distance-train.php',strJSON,
			function(data){
				$('#'+z).val(data)
			});
		}
	}
}