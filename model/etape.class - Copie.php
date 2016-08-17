<?php
class etape_depl {
	private $id_etape;
	private $id_depl;
	private $mode;
	private $depart;
	private $destination;
	private $distance;
	
	//#############################################################
	//             Constructeur
	//#############################################################
	public function __construct(array $donnees)
		{
		$this->hydrate($donnees);
	}

	//#############################################################
	//             Getters
	//#############################################################
	
	public function id_etape() { return $this->id_etape; }
	public function id_depl() { return $this->id_depl; }
	public function mode() { return $this->mode; }
	public function depart() { return $this->depart; }
	public function destination() { return $this->destination; }
	public function distance() { return $this->distance; }
	
	//#############################################################
	//             Setters
	//#############################################################
	
	public function setId_etape($id_etape)
	{
		// L'identifiant de l'étape sera, quoi qu'il arrive, un nombre entier.
		$this->id_etape = (int) $id_etape;
	}
	
	public function setId_depl($id_depl)
	{
		$this->id_depl = (int) $id_depl;
	}
	
	public function setMode($mode)
	{
		// On vérifie qu'il s'agit bien d'une chaîne de caractères.
		// Dont la longueur est inférieure à 30 caractères.
		if (is_string($mode) && strlen($mode) <= 30)
		{
			$this->mode = $mode;
		}
	}
	
	public function setDepart($depart)
	{
		if (is_string($depart) && strlen($depart) <= 30)
		{
			$this->depart = $depart;
		}
	}
	
	public function setDestination($destination)
	{
		if (is_string($destination) && strlen($destination) <= 30)
		{
			$this->destination = $destination;
		}
	}
	
	public function setDistance($distance)
	{
		$this->distance = (int) $distance;
	}
	
	//#############################################################
	//             Hydrateur
	//#############################################################

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

	//#############################################################
	//             Autres méthodes
	//#############################################################
	
	public function displayEtapeHTML(){
		$str = '<tr>
				<td class="bordure">'.$this->depart.'</td>
				<td class="bordure">'.$this->destination.'</td>
				<td class="bordure">'.$this->mode.'</td>
				<td class="bordure">'.$this->distance.'</td>
			</tr>';
			return $str;
	}
	
	
	
	
	
}

?>
