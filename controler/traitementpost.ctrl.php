<?php
//##############################################################################
//          récupération des données
//##############################################################################

$distTotale=0;
$chaine="distance";
extract($_POST);
var_dump($_POST);

//##############################################################################
//          traitement, , accès au modèle
//##############################################################################

foreach( $_POST as $cle=>$value )
{
    echo $cle." = ".$value."<br>";
    if( strstr($cle, $chaine)) {
        $bodytag = str_replace(" km (estimation à partir de Google Maps,
        corriger si nécessaire)", "", $value);
        $distTotale += $bodytag;
    }
}


//
echo "<br>" . $distTotale;

//##############################################################################
//         sélection de la vue
//##############################################################################


?>

<a href="../view/newdemande.view.html">retour accueil</a>
