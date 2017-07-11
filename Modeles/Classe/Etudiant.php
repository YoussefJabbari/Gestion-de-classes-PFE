<?php

require_once('Evaluation.php');

class Etudiant
{
    
    private $CNE;
    private $NOM_ETUDIANT;
    private $PRENOM_ETUDIANT;
    private $MDP_ETUDIANT;
    private $EMAIL_ETUDIANT;
    private $DATE_ETUDIANT;
    private $DATE_INSCRIPTION;
    private $PHOTO_ETUDIANT;
  

public function getCne(){

	return $this->CNE;
}


public function getNomEtudiant(){

	return $this->NOM_ETUDIANT;
}



public function getPrenomEtudiant(){

	return $this->PRENOM_ETUDIANT;
}



public function getMdpEtudiant(){

	return $this->MDP_ETUDIANT;
}


public function getEmailEtudiant(){

	return $this->EMAIL_ETUDIANT;
}



public function getDateEtudiant(){

	return $this->DATE_ETUDIANT;
}



public function getDateInscription(){

	return $this->DATE_INSCRIPTION;
}


public function getPhotoEtudiant(){

	return $this->PHOTO_ETUDIANT;
}


}

?>