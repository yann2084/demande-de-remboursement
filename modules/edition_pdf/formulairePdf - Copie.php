<?php
//méta données formulaire
$majForm = "04/02/2015";
$indiceRevision = "004";
$redacteur = 'Stéphane VERNAC';
$approbateur = 'B. PINEAUX';
$pilote = 'S. Leclerc';

$html = '
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
    <td colspan="3">Formulaire de demande de remboursement de frais de déplacement&#160;&#160;&#160;&#160;</td>
  </tr>
  <tr>
    <th>Champ d\'application</th>
    <td colspan="3">Toute personne s\'étant déplacée</td>
  </tr>
  <tr> 
    <td colspan="4">Joindre impérativement tous les justificatifs</td>
  </tr>
  <tr> 
    <td colspan="4">Date de la demande de remboursement : '.date("d-m-Y").'</td>
  </tr>
  <tr> 
    <td colspan="4">Identification du demandeur</td>
  </tr>
  <tr> 
    <td colspan="4">Statut : '.$infosDepl['statut_user'].' - '.$infosDepl['lib_statut_sub_user'] . $infosDepl['annee_user'].'</td>
  </tr>
  <tr> 
    <td colspan="4">Cadre du déplacement : '.$infosDepl['cadre_depl'].' - '.$infosDepl['lib_cadre_sub_depl'].'</td>
  </tr>
  <tr> 
    <td colspan="4">(Année CFA) : '.$infosDepl['annee_cfa'].'</td>
  </tr>
  <tr> 
    <td colspan="4">Cadre déplacement autre : '.$infosDepl['autre_depl'].'</td>
  </tr>
  <tr> 
    <td colspan="4">Motif multiple : '.$infosDepl['motif_multiple'].'</td>
  </tr>
  <tr> 
    <td colspan="2">Nom : '.$nom_user.'</td>
    <td colspan="2">Prénom : '.$prenom_user.'</td>
  </tr>
  
  <tr> 
    <td colspan="4">Objet du déplacement : '.$infosDepl['objet_depl'].'</td>
  </tr>
  
  <tr> 
    <td colspan="4">Dates du déplacement : du '.$infosDepl['debut_depl'].' au '.$infosDepl['fin_depl'].'</td>
  </tr>
  
  <tr> 
    <td colspan="4">Lieu du déplacement : '.$infosDepl['lieu_depl'].'</td>
  </tr>
  
  <tr> 
    <th colspan="4">FRAIS ENGAGÉS</th>
  </tr>
  <tr> 
    <th colspan="4">Frais de déplacement</th>
  </tr>
  <tr> 
    <td colspan="4">Train : '.$infosDepl['train_euro'].'</td>
  </tr>
  <tr> 
    <td colspan="4">Avion :  '.$infosDepl['avion_euro'].'</td>
  </tr>
  <tr> 
    <td colspan="4">Voiture location :  '.$infosDepl['statut_user'].'</td>
  </tr>
  <tr> 
    <td colspan="4">Voiture personnelle - puissance fiscale :  '.$infosDepl['statut_user'].'</td>
  </tr>
  <tr> 
    <td colspan="4">Parking :  '.$infosDepl['parking_euro'].'</td>
  </tr>
  <tr> 
    <td colspan="4">Autoroute/péage :  '.$infosDepl['autoroute_euro'].'</td>
  </tr>
  <tr> 
    <td colspan="4">Taxi :  '.$infosDepl['taxi_euro'].'</td>
  </tr>          
  <tr> 
    <td colspan="4">RER / Bus / Tram :  '.$infosDepl['rer_euro'].'</td>
  </tr>          
  <tr> 
    <td colspan="4">Navette :  '.$infosDepl['navette_euro'].'</td>
  </tr>
  <tr> 
    <th colspan="4">Frais de séjour</th>
  </tr>
  <tr> 
    <td colspan="2">Frais d\'hôtel :  '.$infosDepl['hotel_euro'].'</td>
	<td colspan="2">Nuitées :  '.$infosDepl['nuitees'].'</td>
  </tr>
  <tr> 
    <td colspan="2">Montant total des repas (invités compris) :  '.$infosDepl['repas_euro'].'</td>
	<td colspan="2">Nombre de repas (invités compris) :  '.$infosDepl['repas_nb'].'</td>
  </tr>
  <tr> 
    <th colspan="4">Montant à rembourser : '.$infosDepl['sommeRembours'].' Euros</th>
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
';
?>