<?php
include_once("../model/DAO.class.php");
include("../lib/lib.php");

//on récupère la chaine au format JSON créée avec la fonction calcDistAllMode()

$obj_json = json_decode($_POST['data']);
$depart = $obj_json->depart;
$destination = $obj_json->destination;
$data = $dao->getDistTrain($depart,$destination);

?>