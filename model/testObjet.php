<?php

require_once("../test/model/DAO.class.php");
require_once("PersonnagesManager.php");
require_once("EtapesManager.php");
require_once("../model/Etape.php");
require_once("../model/Personnage.php");

include("../configPAGORAodm.php");

$db= new PDO("mysql:host=$sqlserveur;dbname=$sqlbd", $sqluti, $sqlmdp);



//$arrayPerso =array(
//	'nom' => 'trop'
//);
//$perso = new Personnage($arrayPerso);
////echo "<pre>";
////var_dump($perso);
////echo "<pre>";
//
//$managerPerso = new PersonnagesManager($db);
////    
//$id_perso = $managerPerso->add($perso);
////echo "<pre>";
////var_dump($id_perso);
////echo "<pre>";
//
//$perso = $managerPerso->get($id_perso);
//
//$tabEtapes = array();
//
//
//
//$arrayEtape1 =array(
//	'nom' => 'tete'
//);
//
//$arrayEtape2 =array(
//	'nom' => 'fafa'
//);
//
//
//$tabEtapes[0] = new Etape($arrayEtape1);
//$tabEtapes[1] = new Etape($arrayEtape2);
//
//$managerEtape = new EtapesManager($db);
//
//
//foreach($tabEtapes as $etape){
//	$managerEtape->add($etape, $perso);
//	$perso->addEtape($etape);
//}






$managerPerso = new PersonnagesManager($db);
$perso = $managerPerso->get(11);
echo "<pre>";
var_dump($perso);
echo "<pre>";

$tab = $managerPerso->getListEtapes($perso);
echo "<pre>";
var_dump($tab);
echo "<pre>";

foreach($tab as $etape){
	$perso->addEtape($etape);
}



$str = json_encode($perso);
echo $str;
echo "<pre>";
var_dump($perso);
echo "<pre>";







?>