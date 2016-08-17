<?php
include("../../configPAGORAodm.php");

function dateTodatetime($date){
	$tab = explode('/',$date);
	$formatSql = $tab[2].'-'.$tab[1].'-'.$tab[0];
	return $formatSql;
}

function connexion($sqlserveur,$sqlbd, $sqluti, $sqlmdp){
	//on récupère l' id_statut_sub_user d'après la chaine récupérée dans le POST
	try {
		$conn = new PDO("mysql:host=$sqlserveur;dbname=$sqlbd", $sqluti, $sqlmdp);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	return $conn;
}

function pre($var){
	echo "<pre>";
	var_dump($var);
	echo "</pre>";
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}





?>