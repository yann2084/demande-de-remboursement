<?php
include '../model/DAO.class.php';

if(isset($_GET)) extract($_GET);
//var_dump(utf8_decode($ville));

$dao->insert_ville($ville);

 ?>
