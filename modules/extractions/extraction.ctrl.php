
 <?php
  include("../../configPAGORAodm.php");
 // le delimiter du fichier CSV
 define('DELIMITER', ';');

 // connexion à la base de donnée avec PDO, mysql_* étant déprécié
 $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'');
 $pdo = new PDO("mysql:host=$sqlserveur;dbname=$sqlbd", $sqluti, $sqlmdp, $options);

 // la requète
 $rqst = $pdo->query('SELECT * FROM deplacement');

 // une variable pour la sortie
 $list = null;

 // une variable pour avoir une entete au fichier
 $firstRow = true;

 // la boucle principale
 while($data = $rqst->fetch(PDO::FETCH_ASSOC)) {

     // si c'est la première ligne, on récupère l'entete
     if($firstRow) {
         foreach($data as $key => $value) {
             // un array contenant la liste des clés du tableau
             $listKeys[] = $key;
         }
         // on forme l'entete en fusionnant les clés avec notre delimiter
         $list = implode(DELIMITER, $listKeys)."\n";
         // la première ligne du fichier est passée, on l'indique à php
         $firstRow = false;
     }

     // parcours des valeurs de la table
     foreach($data as $key => $value) {
         // un array contenant la liste des valeurs
         $listValues[] = $value;
     }
     // pareil que toute à l'heure, on forme les lignes
     $list .= implode(DELIMITER, $listValues)."\n";
     // effacement des variables, pour ne pas avoir de doublons.
     unset($listValues);
     unset($listKeys);
 }

 // un petit plus pour gérer le téléchargement. Je n'ai pas utilisé plus de header que toi
 // peut etre que dans les paramètres de ton navigateur tu as un truc à régler.
 if(isset($_GET['download']) AND $_GET['download'] == 1) {
     header('Content-Type: text/csv;');
     header('Content-Disposition: attachment; filename="classe.csv"');
     // on affiche notre fichier
     echo $list;
 } else {
 // une simple page HTML
 ?>
 <!doctype HTML>
 <html>
     <head>
         <meta charset="utf8" />
         <title>Download CSV</title>
     </head>
     <body>
         <p><a href="?download=1">Télécharger le fichier</a></p>
     </body>
 </html>
 <?php
 // fin du fichier php
 } ?>
