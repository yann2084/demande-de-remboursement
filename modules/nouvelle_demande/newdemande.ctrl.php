<?php
include_once("../../model/DAO.class.php");
include("../../lib/lib.php");

session_start();


//##############################################################################
//          déclaration et initialisation des variables
##############################################################################

//##############################################################################
//          récupération des données
//##############################################################################

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
//          traitement, accès au modèle
//##############################################################################
if($authOK){
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if($_POST['ecriture'] == "true"){
			//$objDepl = $dao->getDeplByIdDepl($_SESSION['id_depl'] = $_POST['id_depl']);
			//pre($objDepl);
			//echo json_encode($objDepl);
			//echo $objDepl->id_depl;
			
			$tabRadio = $dao->getRadioValuesDepl($_SESSION['id_depl'] = $_POST['id_depl']);
			$tabText = $dao->getTextValuesDepl($_POST['id_depl']);
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
			
			
		}
		
	}else{
		//on ajoute un déplacement vide à la bdd
		//on récupère de last ID qu'on affecter à la variable de session 'id_depl'
		if(!empty($_SESSION['id_depl'])){
			$_SESSION['id_depl'] = $dao->ajouterDeplacementVide();
		}
		
		//on crée un fichier vide de type JSON dont le nom est la valeur de la varaible 'id_depl'
		// 1 : on ouvre le fichier
		$monfichier = fopen('../view/tmp/'.$_SESSION['id_depl'].'.json', 'a+');
		
		fclose($monfichier);
	}
	//pre($objDepl);
}

	




//echo "<pre>";
//var_dump($tab);
//echo "</pre>";


//##############################################################################
//         sélection de la vue
//##############################################################################
if($authOK){
	include("../view/newdemandeTEST.view.php");
}else{
	include("../index.php");
}

?>
