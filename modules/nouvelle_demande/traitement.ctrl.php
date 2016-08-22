<?php
include_once("../../model/DAO.class.php");
include("../../lib/lib.php");
session_start();
extract($_SESSION);
//echo "<pre>";
//var_dump($_SESSION);
//echo "</pre>";
$authOK = false;
if(isset($_SESSION['prenom_user'])){
	$authOK = true ;
}else{
	$authOK = false;
}


//##############################################################################
//          déclaration et initialisation des variables
//##############################################################################

//on récupère les noms des champs de la table deplacement dans un tableau indexé
//on transforme ce dernier en tableau associatif en initialisant chaque valeur = ""
$temp = $dao->getNomChampsTableDeplacement();
$tabDepl= array();
foreach($temp as $k => $v){
	$tabDepl[$v] = "";
}

//on définie les variables et on les initialise à vide
$id_depl = "";

$distanceVoiturePerso = $puisFisc =0;

$stack = array(0.00);
$stackDepart = $stackDest = $stackMode = $stackDist = $stackDistVoitPerso = array();
$formOK = false;

for($i=1; $i <9; $i++){ $destination[$i]=''; } 
for($i=1; $i <9; $i++) { $depart[$i]=''; } 
for($i=1; $i <9; $i++) { $mode[$i]=''; } 
for($i=1; $i <9; $i++) { $distance[$i]=''; } 

//##############################################################################
//          RECUPERATION DES DONNEES
//##############################################################################

//##########    Début données du déplacement     ######################################################

$id_depl = $tabDepl['id_depl'] = $_SESSION['id_depl'];

$tabDepl['date_demande']  = date("Y-m-d H:i:s");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);
	
//	echo "<pre>";
//	var_dump($_POST);
//	echo "</pre>";
	$tabDepl['etat_depl'] = $_POST["etat_depl"];
	
	
	if(isset($_POST["statut_user"])){
		$tabDepl['statut_user'] = $_POST["statut_user"];
	
		switch ($_POST["statut_user"]) {
			case "Personnel":
				if(isset($_POST["radioPersonnel"])) $tabDepl['id_statut_sub_user'] = (int)$_POST["radioPersonnel"];
				break;
			case "Apprenti":
				if(isset($_POST["radioApprenti"])) $tabDepl['id_statut_sub_user'] = (int)$_POST["radioApprenti"];
				break;
			case "Etudiant":
				if(isset($_POST["radioEtudiant"])) $tabDepl['id_statut_sub_user'] = (int)$_POST["radioEtudiant"];
				break;
			default:
				echo  $tabDepl['id_statut_sub_user'] = NULL;
		}
	}
	
	if(isset($_POST["radioCycle3"])) $tabDepl['annee_user'] = ' - ' . str_replace('_', ' ', $_POST["radioCycle3"]);
	if(isset($_POST["radioCycle2"])) $tabDepl['annee_user'] = ' - ' . str_replace('_', ' ', $_POST["radioCycle2"]);

	
	if(isset($_POST["cadre_depl"])){
		$tabDepl['cadre_depl'] = $_POST["cadre_depl"];
	
		switch ($_POST["cadre_depl"]) {
			case "Formation":
				if(isset($_POST["radioFormation"])) $tabDepl['id_cadre_sub_depl'] = (int)$_POST["radioFormation"];
				break;
			case "Recherche":
				if(isset($_POST["radioRecherche"])) $tabDepl['id_cadre_sub_depl'] = (int)$_POST["radioRecherche"];
				break;
			case "Fonctionnement":
				if(isset($_POST["radioAdministration"])) $tabDepl['id_cadre_sub_depl'] = (int)$_POST["radioAdministration"];
				break;
			default:
				echo  $tabDepl['id_cadre_sub_depl'] = NULL;
		}
	}
	
	if(isset($_POST["text_motif_multiple"])) $tabDepl['motif_multiple'] = test_input($_POST["text_motif_multiple"]);
	
	if(isset($_POST["textAutre"])) $tabDepl['autre_depl'] = test_input($_POST["textAutre"]);
	
	if(isset($_POST["nomApprenti"])) $tabDepl['nom_apprenti'] = test_input($_POST["nomApprenti"]);

	if(isset($_POST["radioApprenticfa"])) $tabDepl['annee_cfa'] = ' - ' . str_replace('_', ' ', $_POST["radioApprenticfa"]);
	if(isset($_POST["radioCycle3cfa"])) $tabDepl['annee_cfa'] .= ' - ' . str_replace('_', ' ', $_POST["radioCycle3cfa"]);
	if(isset($_POST["radioCycle2cfa"])) $tabDepl['annee_cfa'] .= ' - ' . str_replace('_', ' ', $_POST["radioCycle2cfa"]);
	
	if(isset($_POST["debut_depl"]) && !empty($_POST["debut_depl"])) $tabDepl['debut_depl'] = dateTodatetime(test_input($_POST["debut_depl"]));
	if(isset($_POST["fin_depl"]) && !empty($_POST["fin_depl"])) $tabDepl['fin_depl'] = dateTodatetime(test_input($_POST["fin_depl"]));
	
	if(isset($_POST["lieu_depl"])) $tabDepl['lieu_depl'] = test_input($_POST["lieu_depl"]);
	
	if(isset($_POST["objet_depl"])) $tabDepl['objet_depl'] = test_input($_POST["objet_depl"]);

	if(isset($_POST["lig_budget_depl"])) $tabDepl['lig_budget_depl'] = test_input($_POST["lig_budget_depl"]);

	if(isset($_POST["parking_euro"]))$tabDepl['parking_euro'] = (float)test_input($_POST["parking_euro"]);
	if(isset($_POST["autoroute_euro"]))$tabDepl['autoroute_euro'] = (float)test_input($_POST["autoroute_euro"]);
	if(isset($_POST["taxi_euro"]))$tabDepl['taxi_euro'] = (float)test_input($_POST["taxi_euro"]);
	if(isset($_POST["rer_euro"]))$tabDepl['rer_euro'] = (float)test_input($_POST["rer_euro"]);
	if(isset($_POST["train_euro"]))$tabDepl['train_euro'] = (float)test_input($_POST["train_euro"]);
	if(isset($_POST["avion_euro"]))$tabDepl['avion_euro'] = (float)test_input($_POST["avion_euro"]);
	if(isset($_POST["navette_euro"]))$tabDepl['navette_euro'] = (float)test_input($_POST["navette_euro"]);
	if(isset($_POST["carburant_euro"]))$tabDepl['carburant_euro'] = (float)test_input($_POST["carburant_euro"]);
	if(isset($_POST["carburant_vol"]))$tabDepl['carburant_vol'] = (float)test_input($_POST["carburant_vol"]);
	if(isset($_POST["carburant_type"]))$tabDepl['carburant_type'] = test_input($_POST["carburant_type"]);
	if(isset($_POST["hotel_euro"]))$tabDepl['hotel_euro'] = (float)test_input($_POST["hotel_euro"]);
	if(isset($_POST["nuitees"]))$tabDepl['nuitees'] = (int)test_input($_POST["nuitees"]);
	if(isset($_POST["repas_euro"]))$tabDepl['repas_euro'] = (float)test_input($_POST["repas_euro"]);
	if(isset($_POST["repas_nb"]))$tabDepl['repas_nb'] = (int)test_input($_POST["repas_nb"]);

//##########    Fin données du déplacement     ######################################################


//##########    Début données des étapes       ######################################################

	$nbEtape = 0;
	foreach($_POST as $key => $value){
		
		//pour chaque clé de POST contenant la chaine 'depart', on incrémente le nombre d'étape
		if(substr($key, 0,-1) == 'depart'){
			
			$nbEtape++;
			
			if(isset($_POST["radioMode".$nbEtape])){
				$mode[$nbEtape] = $_POST["radioMode".$nbEtape];
				//si pour cette étape le mode voiture personnelle a été électionné, on récupère la puissance fiscale
				if($mode[$nbEtape] == "modeVoitPerso" && isset($_POST["puisFisc".$nbEtape])){
					//var_dump($test);
					$puisFisc = (int)$_POST["puisFisc".$nbEtape];
					//var_dump($puisFisc);
				}
			}
			
			if(isset($_POST["depart".$nbEtape])) $depart[$nbEtape] = test_input($_POST["depart".$nbEtape]);
			if(isset($_POST["destination".$nbEtape])) $destination[$nbEtape] = $_POST["destination".$nbEtape];
			if(isset($_POST["distance".$nbEtape])) $distance[$nbEtape] = test_input($_POST["distance".$nbEtape]);
			//on vérifie si la distance calculée comporte la chaine " km"
			if( $test = substr( ($distance[$nbEtape]) , -3) == " km" ) {
				//si oui, on supprime la chaine " km" et on caste la valeur en entier
				$distance[$nbEtape] = (int)substr($distance[$nbEtape], 0, -3);
				//si la distance n'est pas numérique on met la variable à 0
				if(!is_numeric($distance[$nbEtape])) $distance[$nbEtape] = 0;
				
				//on stocke les distance 
				array_push($stackDist,(float)$distance[$nbEtape]);
				
				//on stocke les distance dans un tableau si le mode de transport est Voiture Perso
				if($mode[$nbEtape] == "modeVoitPerso") array_push($stackDistVoitPerso,(float)$distance[$nbEtape]);
			}else{
				if(!is_numeric($distance[$nbEtape])) $distance[$nbEtape] = 0;
			}
		}
	}
	
	//on fait la somme des distance parcourue en voiture perso
	$distanceVoiturePerso = (int)array_sum($stackDistVoitPerso);
	//var_dump($distanceVoiturePerso);
//##############################################################################
//          traitement, accès au modèle
//##############################################################################

	//on stocke les données comptables dans un tableau pour en calculer la somme
	foreach($_POST as $key => $value){
		if(substr($key, -5) == 'money'){
			//var_dump($value);
			array_push($stack,(float)$value);
		}
	}
	//var_dump($stack);
	$sommeRembours = array_sum($stack);
	//var_dump($sommeRembours);

//##############################################################################
	//sous certaines conditions on insère les données	
	//if($statut_user != "" && $cadre_depl != "" && $lieu_depl != ""){
		
		//on vérifie si l'utilisateur est déjà présent dans la base de donnée
		//s'il existe, on récupère l'id_user sinon valeur retournée = -1
		$id_user = $dao->check_If_User_Exist($prenom_user, $nom_user);
			
		//##############################################################################
		// s'il n'existe pas on l'ajoute à la base de données
		if($id_user == -1){
			$id_user = $dao->ajouterUser($prenom_user, $nom_user);
		}
		$tabDepl['id_user'] = $id_user;
		pre($tabDepl);
		//##############################################################################
		//update  du déplacement
		$dao->updateDeplacement($tabDepl, $id_depl);
		
		//si l'etat_depl est égal à  2 alors, le deplacement est complet : on efface le fichier.JSON
		//if($_POST["etat_depl"] == 2){
			$folder = 'tmp/';	
			if(file_exists($path = $folder.$_SESSION['id_depl'].'.json')){
				unlink($path);
			}
		//}
		unset($_SESSION['id_depl']);
		

		
		//##############################################################################
		// ajout des étapes
		//on compte combien d'étapes sont passées dans le post et pour chaque étape on initialise un tableau par variable relative à une étape
		
		$dao->ajoutEtapes($nbEtape, $id_depl, $mode, $depart, $destination, $distance);
	
		//##############################################################################

		$formOK = true;
		//pre($tabDepl);
		if($tabDepl['etat_depl'] == 1){
			$messageEnCours = "<div><h2></h2></div><div class=\"alert alert-success\"><strong>Votre déplacement est enregistré, vous pouvez le modifier <br>en cliquant ci-dessus</strong></div>";
		}else{
			$messageEnCours = "";
		}
		
		if($tabDepl['etat_depl'] == 2){
			$messageComplete = "<div><h2></h2></div><div class=\"alert alert-success\"><strong>Votre déplacement est complet, vous pouvez le consulter <br>en cliquant ci-dessus</strong></div>";
		}else{
			$messageComplete = "";
		}
}
	



//##############################################################################
//         sélection de la vue
//##############################################################################

if($formOK){
	include("../accueil/accueil.view.php");
}else{
	include("newdemandeTEST.view.php");
}

	


?>
