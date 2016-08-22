<?php
include_once("../../model/DAO.class.php");

$term = "";
if(isset($_GET['term'])) $term = $_GET['term'];

$dao->getVillesAvion($term);


?>