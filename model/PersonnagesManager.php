<?php
class PersonnagesManager
{
  private $_db; // Instance de PDO

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function add(Personnage $perso)
  {
		try
		{
			  
			$q = $this->_db->prepare('INSERT INTO personnages(nom) VALUES(:nom)');
		
			$q->bindValue(':nom', $perso->nom());
		
			$q->execute();
			$id_perso = $this->_db->lastInsertId();
			return $id_perso;
			
		}
		catch (PDOException $e){
			die("PDO Error :".$e->getMessage());
		}
  }

  public function delete(Personnage $perso)
  {
    $this->_db->exec('DELETE FROM personnages WHERE id = '.$perso->id());
  }

  public function get($id)
  {
    $id = (int) $id;

    $q = $this->_db->query('SELECT id, nom FROM personnages WHERE id = '.$id);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    return new Personnage($donnees);
  }


  public function update(Personnage $perso)
  {
    $q = $this->_db->prepare('UPDATE personnages SET nom = :nom WHERE id = :id');

    $q->bindValue(':nom', $perso->nom(), PDO::PARAM_INT);
    $q->bindValue(':id', $perso->id(), PDO::PARAM_INT);

    $q->execute();
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
  
    public function getList()
  {
    $persos;

    $q = $this->_db->query('SELECT id, nom FROM personnages ORDER BY nom');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $persos[] = new Personnage($donnees);
    }

    return $persos;
  }

  
  public function getListEtapes(Personnage $perso)
  {
    $etapes;
	$id_perso = $perso->id();

    $q = $this->_db->query("SELECT * FROM etapes WHERE id_perso ='$id_perso'");

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $etapes[] = new Etape($donnees);
    }

    return $etapes;
  }
  
}