<?php
include_once("../model/DAO.class.php");



/* veillez bien à vous connecter à votre base de données */
$term = "";
if(isset($_GET['term'])) $term = $_GET['term'];

//$requete = $bdd->prepare('SELECT * FROM membres WHERE pseudo LIKE :term'); // j'effectue ma requête SQL grâce au mot-clé LIKE
//$requete->execute(array('term' => '%'.$term.'%'));



$dao->getVilleAvion($term);


?>