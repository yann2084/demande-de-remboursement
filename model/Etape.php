<?php
class Etape
{
	private $_id;
	private $_nom;
	
	public function __construct(array $donnees)
		{
		// N'oubliez pas qu'il faut assigner la valeur d'un attribut uniquement depuis son setter !
		$this->hydrate($donnees);
	}	

	
	public function id() { return $this->_id; }
	public function nom() { return $this->_nom; }
	
	public function setId($id)
	{
		// L'identifiant du personnage sera, quoi qu'il arrive, un nombre entier.
		$this->_id = (int) $id;
	}
	
	public function setNom($nom)
	{
		// On vérifie qu'il s'agit bien d'une chaîne de caractères.
		// Dont la longueur est inférieure à 30 caractères.
		if (is_string($nom) && strlen($nom) <= 30)
		{
			$this->_nom = $nom;
		}
	}


	public function hydrate(array $donnees)
	{
		foreach ($donnees as $key => $value)
		{
			// On récupère le nom du setter correspondant à l'attribut.
			$method = 'set'.ucfirst($key);
			
			// Si le setter correspondant existe.
			if (method_exists($this, $method))
			{
				// On appelle le setter.
				$this->$method($value);
			}
		}
	}

}
?>