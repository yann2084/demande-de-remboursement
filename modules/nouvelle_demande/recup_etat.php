<?php
session_start();
$fich=fopen($_SESSION['id_depl'] . '.json','r');
$data = fgets($fich);
echo($data);
fclose($fich);
?> 