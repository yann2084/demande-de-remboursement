<?php
include_once("../model/DAO.class.php");
include '../lib/lib.php';
//##############################################################################
//          récupération des données
//##############################################################################
session_start();

$dsCadreCFA = "";
$distVoitPerso = 0;
extract($_SESSION);
if(isset($_POST))
{
	extract($_POST);
}
//##############################################################################
//          traitement, accès au modèle
//##############################################################################
$user = $dao->getUser($prenom_user, $nom_user);
$id_user = (int)$user[0]->id_user;


$infosDepl = $dao->getInfoPdf($id_depl);

$date = new DateTime($infosDepl['debut_depl']);
$debut_depl = $date->format('d-m-Y');
$date = new DateTime($infosDepl['fin_depl']);
$fin_depl = $date->format('d-m-Y');

$temp = (int)$dao->sumKmVoitPerso($id_depl);
if($temp != NULL) $distVoitPerso = $temp;

$sommeRembours = $dao->sumArembourser($id_depl);
$sommeRembours = number_format($sommeRembours, 2, ',', ' ');


$tabInfosEtapes = $dao->displayEtapeHTML($id_depl);
//#######################################################
include("../lib/mpdf/mpdf60/mpdf.php");
include("formulairePdf.php");
$mpdf=new mPDF('');
$mpdf->SetDisplayMode('fullpage');
// LOAD a stylesheet
$stylesheet = file_get_contents('mpdfstyletables.css');
$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
$mpdf->WriteHTML($html,2);
$mpdf->Output('mpdf.pdf','D');
exit;

//##############################################################################
//         sélection de la vue
//##############################################################################

include("../view/traitementPdf.view.php")




?>