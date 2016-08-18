<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Document sans titre</title>
</head>

<body>

<?php
include_once("../../model/DAO.class.php");
include '../../lib/lib.php';

$test = $dao->insertDistanceAvion();
pre($test);

?>
</body>
</html>