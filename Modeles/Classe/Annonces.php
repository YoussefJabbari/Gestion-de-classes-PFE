<?php

class Annonces
{
    private $_titre;
    private $_annonce;
    public $ID_ANNONCE;
    public $ID_ENSEIGNANT;
    public $TITRE_ANNONCE;
    public $ANNONCE;
    public $DATE_ANNONCE;
    
    public function __construct($titre=NULL , $annonce=NULL)
    {
        $this->_titre = $titre;
        $this->_annonce = $annonce;
    }
    
    public function gettitre()
    {
        return $this->_titre;
    }
    
    public function settitre($titre)
    {
        $this->_titre = $titre;
    }
    
    public function getannonce()
    {
        return $this->_annonce;
    }
    
    public function setannonce($annonce)
    {
        $this->_annonce = $annonce;
    }
    
}

?>