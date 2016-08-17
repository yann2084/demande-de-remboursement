<?php
class etape_depl {
	public $id_etape;
	public $id_depl;
	public $mode;
	public $depart;
	public $destination;
	public $distance;
	
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
