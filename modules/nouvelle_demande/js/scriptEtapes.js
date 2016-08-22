// JavaScript Document

/////////////////////////////////////////////////////////////////////////////////
//       FONCTIONS AJOUT ET SUPPRESSION DES ETAPES
/////////////////////////////////////////////////////////////////////////////////

//si le nombre d'étapes = 8 ou plus, on désactive la fonction ajouter étape
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

                    jQuery("#field"+count+"").append('<div class="form-group well well-sm" id="mode'+ count +'" nb-etape="'+ count +'"></div>');
                    jQuery("#mode"+ count +"").append('<label>Choisir le mode approprié</label>');
                    jQuery("#mode"+ count +"").append('<div class="radio"><label  for="modeTrain'+ count +'"><input type="radio" id="modeTrain'+ count +'" value="modeTrain" name="radioMode'+ count +'" onclick="autocompTrain(this)">Train / R.E.R</label></div>');
                    jQuery("#mode"+ count +"").append('<div class="radio"><label  for="modeAvion'+ count +'"><input type="radio" id="modeAvion'+ count +'" value="modeAvion" name="radioMode'+ count +'" onclick="autocompAvion(this	)">Avion</label></div>');
                    jQuery("#mode"+ count +"").append('<div class="radio"><label  for="modeTaxi'+ count +'"><input type="radio" id="modeTaxi'+ count +'" onClick="autocompRoute(this)" value="modeTaxi" name="radioMode'+ count +'">Taxi</label></div>');
                    jQuery("#mode"+ count +"").append('<div class="radio"><label  for="modeNavetteCar'+ count +'"><input type="radio" id="modeNavetteCar'+ count +'" onClick="autocompRoute(this)" value="modeNavetteCar" name="radioMode'+ count +'">Navette / Car</label></div>');
                    jQuery("#mode"+ count +"").append('<div class="radio"><label  for="modeVoitLoc'+ count +'"><input type="radio" id="modeVoitLoc'+ count +'" onClick="autocompRoute(this)" value="modeVoitLoc" name="radioMode'+ count +'">Voiture de location</label></div>');
                    jQuery("#mode"+ count +"").append('<div class="radio"><label  for="modeVoitPerso'+ count +'"><input type="radio" id="modeVoitPerso'+ count +'" onClick="autocompRoute(this)" value="modeVoitPerso" name="radioMode'+ count +'" data-toggle="collapse" data-target="#voitPersoDiv'+ count +'">Voiture personnelle</label></div>');
                    jQuery("#mode"+ count +"").append('<div id="voitPersoDiv'+ count +'" class="collapse"><label class="sr-only" for="puisFisc'+ count +'">Puissance fiscale du véhicule</label><input type="number" class="form-control" id="puisFisc'+ count +'"  value="" placeholder="Entrez le nombre de CV figurant sur la carte grise" name="puisFisc'+ count +'"></div>');

                    jQuery("#field"+count+"").append('<div class="field"><div class="form-group" id="depart-div'+count+'"><label  for="depart-input'+count+'">Ville de départ '+count+'</label><input type="text" class="form-control" id="depart-input'+count+'" placeholder="Entrez la ville de départ" name="depart'+count+'" value="" required></div></div>');

                    jQuery("#field"+count+"").append('<div class="form-group" id="destination-div'+count+'"><label for="destination-input'+count+'">Ville de destination '+count+'</label><input type="text" class="form-control floating-box" id="destination-input'+count+'" placeholder="Entrez la ville de destination" name="destination'+count+'" value="" required></div>');

                    jQuery("#field"+count+"").append('<div class="form-group" id="verifDist'+ count +'"></div>');
                    jQuery("#verifDist"+ count +"").append('<button type="button" class="btn btn-info" nb-etape="'+count+'" onClick="calcDistAllMode(this)" data-toggle="collapse" data-target="#dist'+count+'">Vérifier distance</button>');
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
//       FONCTIONS AUTOCOMPLETION
/////////////////////////////////////////////////////////////////////////////////



function autocompTrain(that){
	var count = jQuery(that).parent().parent().parent().attr("nb-etape");
	//alert(count)
	$("#depart-input"+count).val("")
	$("#depart-input"+count).autocomplete({
//		source: [ "Grenoble, France", "Lyon, France", "Chambery, France", "Paris, France", "Valence, France", "Bordeaux, France", "Gières, France" ],
		source: [ "Grenoble", "Lyon", "Chambery", "Paris", "Valence", "Bordeaux", "Gieres" ],
		
		response: function(event, ui)
		{
			if (ui.content.length === 0)
			{
				$("#depart-input"+count).autocomplete({
					source : 'source_train.php',
				});
			}
		}
	});
	$("#destination-input"+count).val("")
	$("#destination-input"+count).autocomplete({
//		source: [ "Grenoble, France", "Lyon, France", "Chambery, France", "Paris, France", "Valence, France", "Bordeaux, France", "Gières, France" ],
		source: [ "Grenoble", "Lyon", "Chambery", "Paris", "Valence", "Bordeaux", "Gieres" ],
		response: function(event, ui)
		{
			if (ui.content.length === 0)
			{
				$("#destination-input"+count).autocomplete({
					source : 'source_train.php',
				});
			}
		}
	});	
}

function autocompAvion(that){
	var count = jQuery(that).parent().parent().parent().attr("nb-etape");
	//alert(count)
	$("#depart-input"+count).val("")
	$("#depart-input"+count).autocomplete({
		source: [ "Lyon, France", "Paris, France", "Toulouse, France", "Bordeaux, France", "Geneve, Suisse" ],
		response: function(event, ui)
		{
			if (ui.content.length === 0)
			{
				$("#depart-input"+count).autocomplete({
					source : 'source_avion.php',
				});
			}
		}
	});
	$("#destination-input"+count).val("")
	$("#destination-input"+count).autocomplete({
		source: [ "Lyon, France", "Paris, France", "Toulouse, France", "Bordeaux, France", "Geneve, Suisse" ],
		response: function(event, ui)
		{
			if (ui.content.length === 0)
			{
				$("#destination-input"+count).autocomplete({
					source : 'source_avion.php',
				});
			}
		}
	});	
}


function completion(id){
	var depart1 = document.getElementById(id);
	var autocomplete = new google.maps.places.Autocomplete(depart1);
}

function autocompRoute(that){
	var count = jQuery(that).parent().parent().parent().attr("nb-etape");
	//alert(count)
	$("#depart-input"+count).val("")
	$("#depart-input"+count).autocomplete({
		source: [ "Lyon, France", "Paris, France", "Toulouse, France", "Bordeaux, France", "Geneve, Suisse" ],
		response: function(event, ui)
		{
			// ui.content is the array that's about to be sent to the response callback.
			//document.getElementById('testtaxi').innerHTML = ui.content.length;
			if (ui.content.length === 0)
			{
				$("#depart-input"+count).autocomplete({
					source : 'source_route.php',
					response: function(event, ui)
					{
						if (ui.content.length === 0)
						{
							completion("depart-input"+count);
						}
					}
				});
			}
		}
	});
	$("#destination-input"+count).val("")
	$("#destination-input"+count).autocomplete({
		source: [ "Lyon, France", "Paris, France", "Toulouse, France", "Bordeaux, France", "Geneve, Suisse" ],
		response: function(event, ui)
		{
			// ui.content is the array that's about to be sent to the response callback.
			//document.getElementById('testtaxi').innerHTML = ui.content.length;
			if (ui.content.length === 0)
			{
				$("#destination-input"+count).autocomplete({
					source : 'source_route.php',
					response: function(event, ui)
					{
						if (ui.content.length === 0)
						{
							completion("destination-input"+count);
						}
					}
				});
			}
		}
	});
	
}



/////////////////////////////////////////////////////////////////////////////////
//       FONCTIONS API GOOGLE MAP
/////////////////////////////////////////////////////////////////////////////////

//au lancement de la page, rend les champs ville de départ et d'arrivée avec l'autocomplétion via l'API Google Map
function initMap(count) {
//	var depart2 = (document.getElementById("ghost"));
//    var autocomplete = new google.maps.places.Autocomplete(depart2);
}


/////////////////////////////////////////////////////////////////////////////////
//       FONCTIONS RECUPERE DISTANCE
/////////////////////////////////////////////////////////////////////////////////
	
function calcDistAllMode(that){
	//on récupère le numéro d'étape
	var count = $(that).attr("nb-etape");
	//alert(count)
	$("#distDiv"+count).slideDown();
	$("#occurence").slideDown();
	var depart = $("#depart-input"+count).val();
	var destination = $("#destination-input"+count).val();
    if(depart=="" || destination==""){
        alert("la ville / l'adresse de départ ET de destination doivent être saisis.");
    }else {
		//var coche = document.getElementById('modeTrain'+count).checked
		//alert(coche)
		var mode = ""
		var fichierPhp = ""
		
		mode = $('input[name=radioMode'+count+']:checked').val()
		//alert(mode)
		var strJSON = {"ville_depart":depart, "ville_destination":destination,"mode":mode}
		var x = JSON.stringify(strJSON)
		x = "data="+x;
		$.post('distance.php',x,
			function(data){
				//alert("donnees:"+data)
				if(data == "-1"){
					if(mode.slice(0,9) != 'modeTrain' || mode.slice(0,9) != 'modeAvion'){
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
							var inputDistance = document.getElementById('distance'+count);
							inputDistance.value = "";
							var results = response.rows[0].elements;
							inputDistance.value += results[0].distance.text;
						}
					});
					}else{
						$('#distance'+count).val('la distance ne figure pas dans la base données, l\'administration se chargera de compléter ce champ')
					}
				}else{
					$('#distance'+count).val(data+" km")
				}
			});
	}
}

/////////////////////////////////////////////////////////////////////////////////
//       FONCTIONS aller  retour
/////////////////////////////////////////////////////////////////////////////////

//si coché, double la distance calculée précédemment
//avant de multiplier par 2, on supprime les espaces et caractères blancs, la chaine "km"
//et on remplace la virgule par un point pour le calcul
function allerRetour(x){
	var e = document.getElementById(x);
	jQuery(e).val($(e).val().replace(/\s/g,""));
	jQuery(e).val($(e).val().replace("km",""));
	jQuery(e).val($(e).val().replace(",","."));
    jQuery(e).val(($(e).val() * 2) + " km");
}

//si coché, divise par 2 la distance calculée précédemment
function allerSimple(x){
    var e = document.getElementById(x);
    jQuery(e).val(($(e).val().replace(" km","") / 2) + " km");
}

