<?php
//##############################################################################
//          récupération des données
//##############################################################################
include("../lib/lib.php");

session_start();
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
$messageEnCours = $messageComplete = "";

//##############################################################################
//         sélection de la vue
//##############################################################################
if($authOK){
	include("../view/accueil.view.php");
}else{
	//include("../index.php");
	header("Location: ../logout.php");
}
?>
