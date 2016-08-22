<?php
include_once("../../model/DAO.class.php");
include("../../lib/lib.php");

//on récupère la chaine au format JSON créée avec la fonction calcDistAllMode()

$obj_json = json_decode($_POST['data']);
$depart = $obj_json->ville_depart;
$destination = $obj_json->ville_destination;
$mode = $obj_json->mode;
$data = $dao->getDistance($depart,$destination,$mode);
echo $data;
?>