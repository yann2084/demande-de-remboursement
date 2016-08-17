<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Remboursement mission</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="../../img/logoForm.png" type="image/x-icon" />
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../view/stylesheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    
<body>
<?php
include("../../view/template/menu.view.php");
include("../../view/template/boutons.view.php");

//si l'uilisateur figure dans la table des responsable , on affiche les boutons d'administration
if($_SESSION['droit'] == 'Rsb'){
	include("../../view/template/boutonsAdmin.view.php");
}
if($_SESSION['droit'] == 'Adm'){
	include("../../view/template/boutonsAdmin.view.php");
	include("../../view/template/boutonsAdminSup.view.php");
}
?>
    </div>
</div>
</body>
</html>
