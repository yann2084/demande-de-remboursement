jQuery( document ).ready(function() {
	// validate the comment form when it is submitted 
	jQuery("#odmForm").validate({
		rules: {
			statut_user: {
			 	required: true,
			 },
			cadreDeplacement:{
				required: true,
			},
			debut_depl:{
				required: true,
				dateFr: true,
				//date:true,
			},
			fin_depl:{
				required: true,
				dateFr: true,
			},
			lieu_depl:{
				required: true,
			},
			objet_depl:{
				required: true,
			},
			montantHotel: {
				number: true,
			},
			montantRepas: {
				number: true,
			},
			radioMode: {
				required: true,
			},
			depart1: {
				required: true,
			},
			destination1: {
				required: true,
			},



		},
		messages: {
			 statut_user: {
			 	required: "Vous devez préciser votre statut",
			 },
			radioEtudiant: {
				required: "Vous devez préciser votre année",
			},
			autre:{
				required: "Ce champ est requis.",
			},
			debut_depl:{
				required: "Ce champ est requis.",
				//dateFr: true,
				//date:"Merci de saisir une date valide.",
			},
			fin_depl:{
				required: "Ce champ est requis.",
				//dateFr: true,
				//date:"Merci de saisir une date valide.",
				
			},
			lieu_depl:{
				required: "Ce champ est requis.",
				//dateFr: true,
				//date:"Merci de saisir une date valide.",
				
			},
			objet_depl:{
				required: "Ce champ est requis.",
			},
			montantHotel: {
				number: "Seuls les caractères numérique sont autorisés ",
				min: "Merci de saisir un nombre au moins égal à 0.00",

			},
			montantRepas: {
				min: "Merci de saisir un nombre au moins égal à 0.00",
				number: "Seuls les caractères numérique sont autorisés ",
			},
			radioMode: {
				required: "Le mode de transport doit être précisé.",
			},
			depart1: {
				required: "La ville ou l'adresse de départ est requise.",
			},
			destination1: {
				required: "La ville ou l'adresse de destination est requise.",
			},



		},
		invalidHandler: function(form, validator) {
			var errors = validator.numberOfInvalids();
			if (errors) {
				var page = jQuery('h1');
				jQuery('html, body').animate( { scrollTop: jQuery(page).offset().top }, 400 );
			}
		}

	});
	$.validator.addMethod(
		"dateFr",
		function(value, element) {
			//on donne la structure du format attendu
			return value.match(/^\d\d?\/\d\d?\/\d\d\d\d$/);
		},
		"Merci de saisir une date eu format jj/mm/aaaa."
	);

});


function reinitialiser() {
    // var r = confirm("Etes-vous sûr de vouloir effacer les informations saisies?");
    // if (r == true) {
		// var validator = $( "#odmForm" ).validate();
		// validator.resetForm();
    //     alert("Les données ont bien été effacées.");
    // } else {
    //     alert("Les valeurs saisies n'ont pas été effacées");
    // }
}
