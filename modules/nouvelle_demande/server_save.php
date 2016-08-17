<?php
//on récupère la chaine au format JSON créée avec la fonction JS save()
$str=$_POST['data'];

//on définie le chemin
$folder = '../view/tmp/';

//on définie l'extension du fichier à modifier
$type_of_file = '.json';

//var_dump($_POST['data']);
//$fich=fopen('etat.json','w');


//on récupère le nom du fichier
$obj_json = json_decode($_POST['data']);
$id_depl = $obj_json->{'id_depl'};

//on ouvre le fichier en écriture
$fich=fopen($folder . $id_depl . $type_of_file,'w');

//on écrit les données puis on ferme le fichier
fputs($fich,$str);
fclose($fich);
?>