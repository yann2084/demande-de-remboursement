<?php
//méta données formulaire
$majForm = "04/02/2015";
$indiceRevision = "004";
$redacteur = 'Stéphane VERNAC';
$approbateur = 'B. PINEAUX';
$pilote = 'S. Leclerc';
if($infosDepl['annee_cfa'] != ""){
	$trAnneeCfa = "<tr> 
					<td colspan=\"4\">(Année CFA) : ".$infosDepl['annee_cfa']."</td>
				   </tr>";
}else{
	$trAnneeCfa = "";
}

if($test = $infosDepl['autre_depl'] != ""){
	$trDplAutre = "<tr> 
					<td colspan=\"4\">Cadre déplacement - autre : <strong>".$infosDepl['autre_depl']."</strong></td>
				   </tr>";
}else{
	$trDplAutre = "";
}
//var_dump($test);

if($infosDepl['motif_multiple'] != ""){
	$trMotifMultiple = "<tr> 
					<td colspan=\"4\">Motif multiple : <strong>".$infosDepl['motif_multiple']."</strong></td>
				   </tr>";
}else{
	$trMotifMultiple = "";
}

if($infosDepl['id_cadre_sub_depl'] == 1){
	$dsCadreCFA = " dans le cadre du <span class=\"cfa\">CFA</span>";
}

$etapes = '';
foreach($tabEtapes as $etape){
	$etapes .= $etape->displayEtapeHTML();
}


$html = '

<!DOCTYPE html>
<html lang="fr">
<head>
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
    <td colspan="3" class="bordure">Formulaire de demande de remboursement<br> de frais de déplacement' . $dsCadreCFA . '</td>
  </tr>
  <tr>
    <th>Champ d\'application</th>
    <td colspan="3" class="bordure">Toute personne s\'étant déplacée</td>
  </tr>
  <tr> 
    <th colspan="4">Identification du demandeur</th>
  </tr>
  
  <tr> 
    <td colspan="2">Nom :  <strong>'.$nom_user.'</strong></td>
    <td colspan="2">Prénom :  <strong>'.$prenom_user.'</strong></td>
  </tr>
  
  <tr> 
    <td colspan="4">Date de la demande : <strong>'.date("d-m-Y").'</strong></td>
  </tr>
  <tr> 
    <td colspan="4">Statut :  <strong>'.$infosDepl['statut_user'].' - '.$infosDepl['lib_statut_sub_user'] . $infosDepl['annee_user'].'</strong></td>
  </tr>
  <tr> 
    <td colspan="4">Cadre du déplacement :  <strong>'.$infosDepl['cadre_depl'].' - '.$infosDepl['lib_cadre_sub_depl'].'</strong></td>
  </tr>
  
  '.$trDplAutre.'
  
  '.$trMotifMultiple.'
  
  <tr> 
    <td colspan="4">Objet du déplacement :  <strong>'.$infosDepl['objet_depl'].'</strong></td>
  </tr>
  <tr> 
    <td colspan="4">Dates du déplacement : du  <strong>'.$debut_depl.'</strong>  au  <strong>'.$fin_depl.'</strong></td>
  </tr>
  <tr> 
    <td colspan="4">Lieu du déplacement :  <strong>'.$infosDepl['lieu_depl'].'</strong></td>
  </tr>
  <tr> 
    <th colspan="4">FRAIS ENGAGÉS</th>
  </tr>
  <tr> 
    <th colspan="4">Frais de déplacement</th>
  </tr>
  <tr> 
    <td colspan="2">Voiture personnelle - puissance fiscale :   <strong>'.$infosDepl['puisFisc'].'</strong></td>
	<td colspan="2">Distance parcourue (en km):   <strong>'.$distVoitPerso.'</strong></td>
  </tr>
  <tr> 
    <td colspan="4">Voiture location - Volume carburant (en litres) :<strong>'.$infosDepl['carburant_vol'].'</strong>  - Type carburant :  <strong>'.$infosDepl['carburant_type'].'</strong></td>
  </tr>
  <tr> 
    <td colspan="3">Dépense :  </td>
	<td colspan="1">en euros</td>
  </tr>
  <tr> 
    <td colspan="3">Voiture location :  </td>
	<td colspan="1"> <strong>'.number_format($infosDepl['carburant_euro'], 2, ',', ' ').'</strong></td>
  </tr>
  <tr> 
    <td colspan="3">Train : </td>
	<td colspan="1"> <strong>'.number_format($infosDepl['train_euro'], 2, ',', ' ').'</strong></td>
  </tr>
  <tr> 
    <td colspan="3">Avion :</td>
	<td colspan="1"> <strong>'.number_format($infosDepl['avion_euro'], 2, ',', ' ').'</strong></td>
  </tr>
  <tr> 
    <td colspan="3">Parking :  </td>
	<td colspan="1"> <strong>'.number_format($infosDepl['parking_euro'], 2, ',', ' ').'</strong></td>
  </tr>
  <tr> 
    <td colspan="3">Autoroute/péage :  </td>
	<td colspan="1"> <strong>'.number_format($infosDepl['autoroute_euro'], 2, ',', ' ').'</strong></td>
  </tr>
  <tr> 
    <td colspan="3">Taxi :  </td>
	<td colspan="1"> <strong>'.number_format($infosDepl['taxi_euro'], 2, ',', ' ').'</strong></td>
  </tr>          
  <tr> 
    <td colspan="3">RER / Bus / Tram :  </td>
	<td colspan="1"> <strong>'.number_format($infosDepl['rer_euro'], 2, ',', ' ').'</strong></td>
  </tr>          
  <tr> 
    <td colspan="3">Navette :  </td>
	<td colspan="1"> <strong>'.number_format($infosDepl['navette_euro'], 2, ',', ' ').'</strong></td>
  </tr>
  <tr> 
    <th colspan="4">Frais de séjour</th>
  </tr>
  <tr> 
    <td colspan="2">Frais d\'hôtel :   <strong>'.number_format($infosDepl['hotel_euro'], 2, ',', ' ').'</strong></td>
	<td colspan="2">Nuitées :   <strong>'.$infosDepl['nuitees'].'</strong></td>
  </tr>
  <tr> 
    <td colspan="2">Montant total des repas (invités compris) :   <strong>'.number_format($infosDepl['repas_euro'], 2, ',', ' ').'</strong></td>
	<td colspan="2">Nombre de repas (invités compris) :   <strong>'.$infosDepl['repas_nb'].'</strong></td>
  </tr>
  <tr> 
    <th colspan="4"><br>Montant à rembourser (valeurs saisies en euros):  <strong>'.$sommeRembours.'</strong> Euros<br><br>
	Joindre impérativement tous les justificatifs<br>.</th>
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

<pagebreak />

<table class="testtable">
	<tr>
		<th>depart</th>
		<th>destination</th>
		<th>mode</th>
		<th>distance</th>
	</tr>'.$etapes.'

</table>



    </body>
    </html>

';
?>