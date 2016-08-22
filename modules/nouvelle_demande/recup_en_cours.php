<?php
include_once("../../model/DAO.class.php");
include("../../lib/lib.php");

session_start();
$tabRadio = $dao->getRadioValuesDepl($_SESSION['id_depl']);
$tabText = $dao->getTextValuesDepl($_SESSION['id_depl']);
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
?> 