<?php

$majForm = "04/02/2015";
$indiceRevision = "004";
$redacteur = 'Stéphane VERNAC';
$approbateur = 'B. PINEAUX';
$pilote = 'S. Leclerc';

//$html = '
//<p>'.$lib_test.'</p>
//';

echo "<pre>";
var_dump($infosDepl);
echo "</pre>";



$html = '
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">

</head>
<body>

<table class="testtable">

  <tr>
    <td class="small">FOR-203-GR</td>
    <td class="small">Date dernière mise à jour : '.$majForm.'</td>
    <td class="small">Indice révision : '.$indiceRevision.'</td>
    <td class="small">Grenoble INP-Pagora</td>
  </tr>
  <tr> 
    <td class="testTD" colspan="4">Destinataires : personnel de Grenoble INP-Pagora</td>
  </tr>
   <tr>
    <td colspan="4"></td>
  </tr>
  <tr>
    <th>Objet</th>
    <td colspan="3">Formulaire de demande de remboursement de frais de déplacement <strong>' . $dsCadreCFA . '</strong></td>
  </tr>
  <tr>
    <th>Champ d\'application</th>
    <td colspan="3">Toute personne s\'étant déplacée</td>
  </tr>
  <tr> 
    <td colspan="4">Joindre impérativement tous les justificatifs</td>
  </tr>
  <tr> 
    <td colspan="2">Nom :  <strong>'.$nom_user.'</strong></td>
    <td colspan="2">Prénom :  <strong>'.$prenom_user.'</strong></td>
  </tr>
  
  <tr> 
    <td colspan="4">Date de la demande : '.date("d-m-Y").'</td>
  </tr>
  <tr> 
    <td colspan="4">Identification du demandeur</td>
  </tr>
  <tr> 
    <td colspan="4">Statut :  <strong>'.$infosDepl['statut_user'].' - '.$infosDepl['lib_statut_sub_user'] . $infosDepl['annee_user'].'</strong></td>
  </tr>
  <tr> 
    <td colspan="4">Cadre du déplacement :  <strong>'.$infosDepl['cadre_depl'].' - '.$infosDepl['lib_cadre_sub_depl'].'</strong></td>
  </tr>
  <tr> 
    <td colspan="4">Cadre déplacement autre :  <strong>'.$infosDepl['autre_depl'].'</strong></td>
  </tr>
  <tr> 
    <td colspan="4">Motif multiple :  <strong>'.$infosDepl['motif_multiple'].'</strong></td>
  </tr>
  <tr> 
    <td colspan="4">Objet du déplacement :  <strong>'.$infosDepl['objet_depl'].'</strong></td>
  </tr>
  <tr> 
    <td colspan="4">Dates du déplacement : du  <strong>'.$debut_depl.' au '.$fin_depl.'</strong></td>
  </tr>
  <tr> 
    <td colspan="4">Lieu du déplacement :  <strong>'.$infosDepl['lieu_depl'].'</strong></td>
  </tr>
  <tr> 
    <th colspan="4">FRAIS ENGAGÉS (en Euros)</th>
  </tr>
  <tr> 
    <th colspan="4">Frais de déplacement</th>
  </tr>
  <tr> 
    <td colspan="2">Voiture personnelle - puissance fiscale :   <strong>'.$infosDepl['puisFisc'].'</strong></td>
	<td colspan="2">Distance parcourue (en km):   <strong>'.$distVoitPerso.'</strong></td>
  </tr>
  <tr> 
    <td colspan="2">Voiture location :  </td>
	<td colspan="1"> <strong>'.$infosDepl['carburant'].'</strong></td>
	<td colspan="1"> <strong>'.$infosDepl['carburant'].'</strong></td>
  </tr>
  <tr> 
    <td colspan="2">Volume carburant :  <strong>'.$infosDepl['carburant_vol'].'</strong></td>
    <td colspan="2">Type carburant :  <strong>'.$infosDepl['carburant_type'].'</strong></td>
  </tr>
  <tr> 
    <td colspan="3">Train : </td>
	<td colspan="1"> <strong>'.$infosDepl['train_euro'].'</strong></td>
  </tr>
  <tr> 
    <td colspan="3">Avion :</td>
	<td colspan="1"> <strong>'.$infosDepl['avion_euro'].'</strong></td>
  </tr>
  <tr> 
    <td colspan="3">Parking :  </td>
	<td colspan="1"> <strong>'.$infosDepl['parking_euro'].'</strong></td>
  </tr>
  <tr> 
    <td colspan="3">Autoroute/péage :  </td>
	<td colspan="1"> <strong>'.$infosDepl['autoroute_euro'].'</strong></td>
  </tr>
  <tr> 
    <td colspan="3">Taxi :  </td>
	<td colspan="1"> <strong>'.$infosDepl['taxi_euro'].'</strong></td>
  </tr>          
  <tr> 
    <td colspan="3">RER / Bus / Tram :  </td>
	<td colspan="1"> <strong>'.$infosDepl['rer_euro'].'</strong></td>
  </tr>          
  <tr> 
    <td colspan="3">Navette :  </td>
	<td colspan="1"> <strong>'.$infosDepl['navette_euro'].'</strong></td>
  </tr>
  <tr> 
    <th colspan="4">Frais de séjour</th>
  </tr>
  <tr> 
    <td colspan="2">Frais d\'hôtel :   <strong>'.$infosDepl['hotel_euro'].'</strong></td>
	<td colspan="2">Nuitées :   <strong>'.$infosDepl['nuitees'].'</strong></td>
  </tr>
  <tr> 
    <td colspan="2">Montant total des repas (invités compris) :   <strong>'.$infosDepl['repas_euro'].'</strong></td>
	<td colspan="2">Nombre de repas (invités compris) :   <strong>'.$infosDepl['repas_nb'].'</strong></td>
  </tr>
  <tr> 
    <th colspan="4">Montant à rembourser :  <strong>'.$infosDepl['sommeRembours'].'</strong> Euros</th>
  </tr>
  
  <tr>
    <td colspan="2">Signature de l\'intéressé(e)<br><br></td>
    <td colspan="2">Signature du Responsable de la ligne budgétaire<br><br>.</td>
  </tr>
  <tr> 
    <th colspan="4">  </th>
  </tr>
  <tr>
    <td class="small" colspan="2">Chapitre de la norme ISO 9001 concerné (le cas échéant) : 7.1</td>
    <td class="small" colspan="2">Références documentaires : néant</td>
  </tr>
  <tr>
    <td class="small" colspan="2">Archivage : </td>
    <td class="small" colspan="2">Annexes (le cas échéant) : néant</td>
  </tr>
  <tr>
    <td class="small" colspan="2">Rédacteur : '.$redacteur.', <br> Approbateur : '.$approbateur.'</td>
    <td class="small" colspan="2">Pilote '.$pilote.'</td>
  </tr>
  
</table>
    </body>
    </html>
';

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <title>INP - Odm</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="img/logoForm.png" type="image/x-icon" />
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../view/stylesheet.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src='jquery.validate.min.js'></script>
    <script src='additional-methods.min.js'></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<?php

echo $html;

?>


	<script>

    </script>

    <script src="js/myScript.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDprc5sfu1qrH8ChZ18E3q8_xijqIOTJGQ&signed_in=true&libraries=places&callback=initMap" async defer></script>
</body>
</html>
