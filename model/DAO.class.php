<?php
	
require_once("deplacement.class.php");
require_once("etape.class.php");
require_once("user.class.php");

include("../../configPAGORAodm.php");

// Definition de l'unique objet de DAO
$dao = new DAO($sqlserveur,$sqlbd, $sqluti, $sqlmdp);

// Le Data Access Object
// Il représente la base de donnée
class DAO {

	private $conn;

	function __construct($sqlserveur,$sqlbd, $sqluti, $sqlmdp) {
		try {
			$this->conn = new PDO("mysql:host=$sqlserveur;dbname=$sqlbd", $sqluti, $sqlmdp);
			// set the PDO error mode to exception
			if (!$this->conn) {die ("Database error");}
			//echo "Connected successfully";
		}
		catch(PDOException $e)
		{
			echo "Connection failed: " . $e->getMessage();
		}
	}


	function getIdUser(){
		try
		{
			$r = $this->conn->query("SELECT * FROM user");
			$res = $r->fetchAll(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e){
			die("PDO Error :".$e->getMessage());
		}
		return $res;
	}


	function check_If_User_Exist($prenom_user, $nom_user){
		try {
			$r = $this->conn->query("SELECT * FROM user WHERE nom_user = '$nom_user' AND prenom_user = '$prenom_user'");
			$res = $r->fetchAll(PDO::FETCH_CLASS,'user');
		}catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		if(sizeof($res) == 0){ return -1;}
		return $res[0]->id_user;
	}

	function ajouterUser($prenom_user, $nom_user){
		try{
			$sql = "INSERT INTO user (prenom_user, nom_user)
				VALUES ('$prenom_user', '$nom_user')";
			$r = $this->conn->exec($sql);
						$id_user = $this->conn->lastInsertId();
			echo "New record created successfully USER. Last inserted ID USER is: " . $id_user;
			return $id_user ;
		}catch(PDOException $e) {
			echo $sql ."<br>" . $e->getMessage();
		}
	}




	function ajoutEtapes($nbEtape, $id_depl, $mode, $depart, $destination, $distance){
		try {
			$r = $this->conn->beginTransaction();
			for ($i = 1 ; $i < $nbEtape+1 ; $i++){
				$this->conn->exec("INSERT INTO etape_depl (id_depl, mode, depart, destination, distance)
				VALUES ('$id_depl', '$mode[$i]', '$depart[$i]', '$destination[$i]', '$distance[$i]')");
			}

			$this->conn->commit();
			//echo "New records created successfully ETAPES";
		}
		catch(PDOException $e){
			$this->conn->rollBack();
			echo "Error: " . $e->getMessage();
		}
	}

	function getUser($prenom_user, $nom_user){
		try
		{
			$r = $this->conn->query("SELECT * FROM user WHERE nom_user = '$nom_user' AND prenom_user = '$prenom_user'");
			$res = $r->fetchAll(PDO::FETCH_CLASS,'user');
		}
		catch (PDOException $e)
		{
			die("PDO Error :".$e->getMessage());
		}
		return $res;
	}

	function getTabObjDeplacements($id_user, $etat_depl){
		try
		{
			$r = $this->conn->query("SELECT * FROM deplacement WHERE id_user = '$id_user' AND etat_depl = '$etat_depl' ORDER BY date_demande DESC");
			$res = $r->fetchAll(PDO::FETCH_CLASS,'deplacement');
		}
		catch (PDOException $e)
		{
			die("PDO Error :".$e->getMessage());
		}
		return $res;
	}

	function getDeplacementAll(){
	try
		{
			$r = $this->conn->query("SELECT * FROM deplacement, user WHERE user.id_user = deplacement.id_user ORDER BY nom_user ASC, debut_depl DESC");
			$res = $r->fetchAll(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e)
		{
			die("PDO Error :".$e->getMessage());
		}
		return $res;
	}



	function getDeplByIdDepl($id_depl){
	try
		{
			$r = $this->conn->query("SELECT * FROM deplacement WHERE id_depl = '$id_depl'");
			$res = $r->fetchAll(PDO::FETCH_CLASS,'deplacement');
		}
		catch (PDOException $e)
		{
			die("PDO Error :".$e->getMessage());
		}
		return $res;
	}


	function getEtapes($deplacement){
	try
		{
			$r = $this->conn->query("SELECT * FROM etape WHERE id_depl = '$deplacement->id_depl");
			$res = $r->fetchAll(PDO::FETCH_CLASS,'etape');
		}
		catch (PDOException $e)
		{
			die("PDO Error :".$e->getMessage());
		}
		return $res;
	}

	function getInfoPdf($id_depl){
		try
		{
			$r = $this->conn->query("
			SELECT * FROM deplacement, cadre_sub_depl, statut_sub_user
			WHERE deplacement.id_depl = '$id_depl'
			AND deplacement.id_statut_sub_user = statut_sub_user.id_statut_sub_user
			AND deplacement.id_cadre_sub_depl = cadre_sub_depl.id_cadre_sub_depl
			" );
			$res = $r->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e)
		{
			die("PDO Error :".$e->getMessage());
		}
		return $res;
	}
	
	

	function getTest(){
		try
		{
			$r = $this->conn->query("
			SELECT * FROM test
			" );
			$res = $r->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e)
		{
			die("PDO Error :".$e->getMessage());
		}
		return $res;
	}
	
	function sumKmVoitPerso($id_depl){
		try
		{
			$r = $this->conn->query("SELECT SUM(distance) 
									FROM etape_depl
									WHERE id_depl ='$id_depl'
									AND mode = 'modeVoitPerso'
									");
			$res = $r->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e){
			die("PDO Error :".$e->getMessage());
		}
		return $res['SUM(distance)'];
	}
	
	function sumArembourser($id_depl){
		try
		{
			$r = $this->conn->query("SELECT parking_euro + parking_euro + taxi_euro + rer_euro + train_euro + avion_euro + navette_euro + carburant_euro + hotel_euro + repas_euro AS total
									FROM deplacement
									WHERE id_depl ='$id_depl'
									");
			$res = $r->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e){
			die("PDO Error :".$e->getMessage());
		}
		return $res['total'];
	}

	
	function getVilleAvion($term){
		try
		{
			$requete = $this->conn->prepare("SELECT * FROM villeAvion WHERE nom_ville LIKE :term");
			
			$requete->execute(array('term' => '%'.$term.'%'));
			
			$array = array(); // on créé le tableau

			while($donnee = $requete->fetch()) // on effectue une boucle pour obtenir les données
			{
				array_push($array, $donnee['nom_ville']); // et on ajoute celles-ci à notre tableau
			}
			
			echo json_encode($array); // il n'y a plus qu'à convertir en JSON
		}
		catch (PDOException $e){
			die("PDO Error :".$e->getMessage());
		}
	}
	//teste l'existence de la ville passée en paramètre dans la bdd, l'insère sinon
//	function insert_ville($ville){
//		try
//		{	
//			
//			$r = $this->conn->query("
//			SELECT * FROM villeAvion WHERE nom_ville = '$ville'
//			" );
//			var_dump($r);
//			$result = $r->fetch(PDO::FETCH_ASSOC);
//			if($result->rowCount() > 0){
//				return -1;
//			}
//			else{
//				try{
//					$sql = "INSERT INTO villeAvion (nom_ville) VALUES ('$ville')";
//					$this->conn->exec($sql);
//					echo "New record created successfully VILLE.";
//				}catch(PDOException $e) {
//					echo $sql ."<br>" . $e->getMessage();
//				}
//			}
//		}
//		catch (PDOException $e)	{
//			die("PDO Error :".$e->getMessage());
//		}
//	}


	
	//retourne un tableau comportant les noms de colonnes de la table deplacement
	//utilisé pour passer ce tableau en paramètre d'une fonction qui insére un déplacement
	function getNomChampsTableDeplacement(){
		try
		{
			$r = $this->conn->prepare("DESCRIBE deplacement");
			$r->execute();
			$res = $r->fetchAll(PDO::FETCH_COLUMN);
			return $res;

		}
		catch (PDOException $e){
			die("PDO Error :".$e->getMessage());
		}
	}

	//au clic 'nouvelle demande', on ajoute un deplacement vide et renvoie 'last ID'
	function ajouterDeplacementVide(){
		$tab = $this->getNomChampsTableDeplacement();
		$strChampbdd = $strValues = "";
		foreach($tab as $v){
			$strChampbdd .= $v . ", ";
			$strValues .=  ":" . $v . ", ";
		}
		$strChampbdd = substr($strChampbdd, 0, -2);
		$strValues = substr($strValues, 0, -2);
		//echo $strValues;
		
		try{
			$stmt = $this->conn->prepare("INSERT INTO deplacement ($strChampbdd)

			VALUES ($strValues)");
			foreach($tab as $v){
				$stmt->bindValue(':'.$v.'', '');
			}

			$stmt->execute();

			$id_depl = $this->conn->lastInsertId();
			echo "New record created successfully DEPLACEMENT. Last inserted ID DEPLACEMENT is: " . $id_depl;
			return $id_depl ;
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}
	}
	
	
	//UPDATE déplacement
	function updateDeplacement($tab, $id_depl){
		$sql = 'UPDATE deplacement SET ';
		foreach($tab as $k =>$v){
			if($v != ""){
				if((gettype($v) == 'integer') || (gettype($v) == 'double') ){			
					$sql .= $k . "=" . $v . ", ";
				} else {
					$sql .= $k . "='$v', ";
				}
			}
		}
		$sql = substr($sql, 0, -2);
		
		$sql .= ' WHERE id_depl='.$id_depl.''; 
		//echo $sql;
		try {
			
			$stmt = $this->conn->prepare($sql);

			$stmt->execute();

			echo $stmt->rowCount() . " records UPDATED successfully";
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}
	}
	
	
	
	//retourne les valeurs correspondantes aux input text
	function getTextValuesDepl($id_depl){
		try
		{
			$r = $this->conn->query("
				SELECT annee_user, motif_multiple, autre_depl, nom_apprenti, debut_depl, fin_depl, lieu_depl, objet_depl, lig_budget_depl, sommeRembours, puisFisc, parking_euro, autoroute_euro, taxi_euro, rer_euro, train_euro, avion_euro, navette_euro, carburant_euro, carburant_vol, carburant_type, hotel_euro, repas_euro, nuitees, repas_nb
				FROM deplacement
				WHERE id_depl='$id_depl'
				");
			$res = $r->fetchAll(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e){
			die("PDO Error :".$e->getMessage());
		}
		return $res;
	}

	//retourne les valeurs correspondantes aux input radio
	function getRadioValuesDepl($id_depl){
		try
		{
			$r = $this->conn->query("
				SELECT statut_user, id_statut_sub_user, cadre_depl, id_cadre_sub_depl
				FROM deplacement
				WHERE id_depl='$id_depl'
				");
			$res = $r->fetchAll(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e){
			die("PDO Error :".$e->getMessage());
		}
		return $res;
	}
	
//	function getRadioValuesEtapes($id_depl){
//		try
//		{
//			$r = $this->conn->query("
//				SELECT id_etape, mode
//				FROM etape_depl
//				WHERE id_depl='$id_depl'
//				");
//			$res = $r->fetchAll(PDO::FETCH_ASSOC);
//		}
//		catch (PDOException $e){
//			die("PDO Error :".$e->getMessage());
//		}
//		return $res;
//	}
	
	function getEtapesPdf($id_depl){
		try
		{
			$r = $this->conn->query("
				SELECT *
				FROM etape_depl
				WHERE id_depl='$id_depl'
				");
			$res = $r->fetchAll(PDO::FETCH_CLASS, 'etape_depl');
		}
		catch (PDOException $e){
			die("PDO Error :".$e->getMessage());
		}
		return $res;
	}
		
	function getDistTrain($depart,$destination){
		try
		{
			$r = $this->conn->query("
				SELECT *
				FROM dist_train
				WHERE depart='$depart' AND destination='$destination'
				");
			$res = $r->fetchAll(PDO::FETCH_CLASS, 'etape_depl');
		}
		catch (PDOException $e){
			die("PDO Error :".$e->getMessage());
		}
		return $res;
	}




}
?>
