<?php
include_once("../model/DAO.class.php");
include '../lib/lib.php';


$test = $dao->getNomChampsTableDeplacement();
//$array = array(1, 1, 1, 1,  1, 8 => 1,  4 => 1, 19, 3 => 15);
//foreach($test as $k=>$v){
//	$v = array("toto") ;
//}

//$tab =  array_values($test);
//$tab[0] = array("toto");

//foreach($test as $v){
//	array_push($tab, $v) ;
//}

$testTabAssoc = array();
foreach($test as $k => $v){
	//$testTabAssoc = array($v => "toto");
	
	$testTabAssoc[$v] = "";
	//echo $v . ", ";
}
$testTabAssoc['id_depl'] = "chiiiii";
pre($testTabAssoc);

//echo "<pre>";
//var_dump($test);
//echo "</pre>";

?>
