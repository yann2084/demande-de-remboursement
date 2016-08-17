<?php

//avant de détruire la session, on s'assure de supprimer le fichier JSON s'il existe
if(!empty($_SESSION['id_depl'])){
	$folder = '../view/tmp/';	
	if(file_exists($path = $folder.$_SESSION['id_depl'].'.json')){
		unlink($path);
	}
}

// Détruit toutes les variables de session
$_SESSION = array();

// Si vous voulez détruire complètement la session, effacez également
// le cookie de session.
// Note : cela détruira la session et pas seulement les données de session !
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalement, on détruit la session.
session_destroy();
header("Location: index.php");
?>