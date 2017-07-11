<?php


class Enseignant
{

    private $ID_ENSEIGNANT;
    private $NOM_ENSEIGNANT;
    private $PRENOM_ENSEIGNANT;
    private $MDP_ENSEIGNANT;
    private $EMAIL_ENSEIGNANT;
    private $DATE_ENSEIGNANT;
    private $DATE_INSCRIPTION;
    private $PHOTO_ENSEIGNANT;

public function getIdEnseignant(){

	return $this->ID_ENSEIGNANT;
}


public function getNomEnseignant(){

	return $this->NOM_ENSEIGNANT;
}



public function getPrenomEnseignant(){

	return $this->PRENOM_ENSEIGNANT;
}



public function getMdpEnseignant(){

	return $this->MDP_ENSEIGNANT;
}


public function getEmailEnseignant(){

	return $this->EMAIL_ENSEIGNANT;
}



public function getDateEnseignant(){

	return $this->DATE_ENSEIGNANT;
}



public function getDateInscription(){

	return $this->DATE_INSCRIPTION;
}


public function getPhotoEnseignant(){

	return $this->PHOTO_ENSEIGNANT;
}

}

?>