<?php
include_once("../model/DAO.class.php");
include("../lib/lib.php");

session_start();

//##############################################################################
//          récupération des données
//##############################################################################

extract($_SESSION);
$authOK = false;
if(isset($_SESSION['prenom_user'])){
	$authOK = true ;
}else{
	$authOK = false;
}

//##############################################################################
//          traitement, accès au modèle
//##############################################################################
if($authOK){
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		//si $_POST['ecriture'] == "true", alors l'utilisateur vient de cliquer sur le bouton consulter / modifier 
		//d'un déplacment figurant dans la liste des déplacements en cours de saisie
		if($test = $_POST['ecriture'] == "true"){
			//on place l'id_depl dans la variable de session pour récupérer les infos du déplacement par un appel ajax dans on load
			$_SESSION['id_depl'] = $_POST['id_depl'];
			//on récupère les données depuis la BDD sous forme de 2 tableaux
			
			//un pour les valeur sélectionnées par les boutons radio
			$tabRadio = $dao->getRadioValuesDepl($_SESSION['id_depl'] = $_POST['id_depl']);
			
			//l'autre pour les valeur saisies dans les champs de type text
			$tabText = $dao->getTextValuesDepl($_POST['id_depl']);
			
			$tabRadio = $dao->getRadioValuesDepl($_POST['id_depl']);
			$tabText = $dao->getTextValuesDepl($_POST['id_depl']);
			pre($tabRadio);
			pre($tabText);
			$strJSON = '{"radio":[';
			foreach($tabRadio[0] as $k=>$v){
				$strJSON .= '{"name":"'.$k.'","value":"'.$v.'"},';
			}
			$strJSON = substr($strJSON, 0, -1);
			$strJSON .= '],"text":[';
			foreach($tabText[0] as $k=>$v){
				$strJSON .= '{"name":"'.$k.'","value":"'.$v.'"},';
			}
			$strJSON = substr($strJSON, 0, -1);
			$strJSON .= ']}';
			
			echo $strJSON;
			
			
			$mode = "old";
			
		}
		
	}else{
		//on ajoute un déplacement vide à la bdd
		//on récupère de last ID qu'on affecter à la variable de session 'id_depl'
		if(!isset($_SESSION['id_depl'])){
			$_SESSION['id_depl'] = $dao->ajouterDeplacementVide();
			
			//on crée un fichier vide de type JSON dont le nom est la valeur de la varaible 'id_depl'
			//ce fichier va servir à sauvegarder les données saisies par l'utilisateur chaque fois qu'un champ du formulaire perd le focus(on considère que l'utilisateur à rentré des données). 
			//Si la page est actualisée, les données seront insérée dans les champs ad-hoc 
			$monfichier = fopen('../view/tmp/'.$_SESSION['id_depl'].'.json', 'a+');
			fclose($monfichier);
			
		}
		$mode = "new";
	}
	//pre($test);

}


//##############################################################################
//         sélection de la vue
//##############################################################################
if($authOK){
	include("../view/newdemandeTEST.view.php");
}else{
	header("Location: ../logout.php");
}

?>
