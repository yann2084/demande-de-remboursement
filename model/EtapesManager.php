<?php

class EtapesManager
{
	private $_db; // Instance de PDO
	
	public function __construct($db)
	{
		$this->setDb($db);
	}

//  public function add(Etape $etape, Personnage $perso)
//  {
//	$q = $this->_db->prepare('INSERT INTO etapes(nom, id_perso) VALUES(:nom, :id_perso)');
//
//    $q->bindValue(':nom', $etape->nom());
//	$q->bindValue(':id_perso', $perso->id());
//
//
//    $q->execute();
//  }

	public function add(Etape $etape, Deplacement $deplacement){
		try {
			$q = $this->_db->prepare('INSERT INTO etape_depl (id_depl, mode, depart, destination, distance)
			VALUES(:id_depl, :mode, :depart, :destination, :distance)');
			$q->bindValue(':id_depl', $deplacement->id_depl());
			$q->bindValue(':id_depl', $etape->mode());
			$q->bindValue(':id_depl', $etape->depart());
			$q->bindValue(':id_depl', $etape->destination());
			$q->bindValue(':id_depl', $etape->distance());
			$q->execute();
		}
		catch(PDOException $e){
			$this->conn->rollBack();
			echo "Error: " . $e->getMessage();
		}
	}
  

	public function delete(Etape $etape)
	{
		try{
			$this->_db->exec('DELETE FROM etape_depl WHERE id = '.$etape->id_etape());
		}
		catch(PDOException $e){
			$this->conn->rollBack();
			echo "Error: " . $e->getMessage();
		}
	}

	public function get($id_etape)
	{
		$id_etape = (int) $id_etape;
		
		$q = $this->_db->query('SELECT id_etape, id_depl, mode, depart, destination, distance FROM etape_depl WHERE id = '.$id_etape);
		$donnees = $q->fetch(PDO::FETCH_ASSOC);
		
		return new Etape($donnees);
	}

  public function getList()
  {
    $etapes;

    $q = $this->_db->query('SELECT id_etape, id_depl, mode, depart, destination, distance FROM etape_depl ORDER BY id_depl');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $etapes[] = new Etape($donnees);
    }

    return $etapes;
  }

  public function update(Etape $etape)
  {
    $q = $this->_db->prepare('UPDATE etape_depl SET mode = :mode, depart = :depart, destination = :destination, distance = :distance WHERE id_depl = :id_depl');

    $q->bindValue(':mode', $etape->mode(), PDO::PARAM_INT);
    $q->bindValue(':depart', $etape->depart(), PDO::PARAM_INT);
    $q->bindValue(':destination', $etape->destination(), PDO::PARAM_INT);
    $q->bindValue(':distance', $etape->distance(), PDO::PARAM_INT);
    $q->execute();
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}