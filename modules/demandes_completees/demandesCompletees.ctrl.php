<?php
include_once("../../model/DAO.class.php");

//##############################################################################
//          déclaration et initialisation des variables
//##############################################################################
session_start();
extract($_SESSION);

//##############################################################################
//          récupération des données
//##############################################################################

//##############################################################################
//          traitement, accès au modèle
//##############################################################################
$user = $dao->getUser($prenom_user, $nom_user);
$id_user = (int)$user[0]->id_user;
$etat_depl = 2;
$tabObjDeplacements = $dao->getTabObjDeplacements($id_user, $etat_depl);

//##############################################################################
//         sélection de la vue
//##############################################################################
include("demandesCompletees.view.php");
?>

