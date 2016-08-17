<?php
class deplacement {
	public $id_depl;
	public $id_user;
	public $date_demande;
	public $etat_depl;
	public $statut_user;
	public $id_statut_sub_user;
	public $annee_user;
	public $cadre_depl;
	public $id_cadre_sub_depl;
	public $motif_multiple;
	public $autre_depl;
	public $nom_apprenti;
	public $annee_cfa;
	public $debut_depl;
	public $fin_depl;
	public $lieu_depl;
	public $objet_depl;
	public $lig_budget_depl;
	public $sommeRembours;
	public $puisFisc;
	public $parking_euro;
	public $autoroute_euro;
	public $taxi_euro;
	public $rer_euro;
	public $train_euro;
	public $avion_euro;
	public $navette_euro;
	public $carburant_euro;
	public $carburant_vol;
	public $carburant_type;
	public $hotel_euro;
	public $repas_euro;
	public $nuitees;
	public $repas_nb;

	
	public function id_depl(){ return $this->id_depl; }
	public function id_user(){ return $this->id_user; }
	public function date_demande(){ return $this->date_demande; }
	public function etat_depl(){ return $this->etat_depl; }
	public function statut_user(){ return $this->statut_user; }
	public function id_statut_sub_user(){ return $this->id_statut_sub_user; }
	public function annee_user(){ return $this->annee_user; }
	public function cadre_depl(){ return $this->cadre_depl; }
	public function id_cadre_sub_depl(){ return $this->id_cadre_sub_depl; }
	public function motif_multiple(){ return $this->motif_multiple; }
	public function autre_depl(){ return $this->autre_depl; }
	public function nom_apprenti(){ return $this->nom_apprenti; }
	public function annee_cfa(){ return $this->annee_cfa; }
	public function debut_depl(){ return $this->debut_depl; }
	public function fin_depl(){ return $this->fin_depl; }
	public function lieu_depl(){ return $this->lieu_depl; }
	public function objet_depl(){ return $this->objet_depl; }
	public function lig_budget_depl(){ return $this->lig_budget_depl; }
	public function sommeRembours(){ return $this->sommeRembours; }
	public function puisFisc(){ return $this->puisFisc; }
	public function parking_euro(){ return $this->parking_euro; }
	public function autoroute_euro(){ return $this->autoroute_euro; }
	public function taxi_euro(){ return $this->taxi_euro; }
	public function rer_euro(){ return $this->rer_euro; }
	public function train_euro(){ return $this->train_euro; }
	public function avion_euro(){ return $this->avion_euro; }
	public function navette_euro(){ return $this->navette_euro; }
	public function carburant_euro(){ return $this->carburant_euro; }
	public function carburant_vol(){ return $this->carburant_vol; }
	public function carburant_type(){ return $this->carburant_type; }
	public function hotel_euro(){ return $this->hotel_euro; }
	public function repas_euro(){ return $this->repas_euro; }
	public function nuitees(){ return $this->nuitees; }
	public function repas_nb(){ return $this->repas_nb; }
	
	public function getAttr($attr){
		return $this->$attr;
	}
	


	
	// public $listeEtapes;//tableaux des étapes du déplacement

}
  
  


  //compter nb etape, acceder num etape

?>
