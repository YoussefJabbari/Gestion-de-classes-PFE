<?php

class Devoirs
{
    public $ID_DEVOIR;
    public $ID_CLASSE;
    public $TITRE_DEVOIR;
    public $ENONCE;
    public $DEADLINE;
    public $DATE_DEVOIR;
    
    public function __construct($titre=NULL , $ennonce=NULL , $deadline=NULL , $format=NULL)
    {
        $this->_titre = $titre;
        $this->_ennonce = $ennonce;
        $this->_deadline = $deadline;
        $this->_format_demandee = $format;
    }
    
    public function getTitre()
    {
        return $this->TITRE_DEVOIR;
    }
    
   
    
    public function getEnonce()
    {
        return $this->ENONCE;
    }
    
   
    public function getDeadLine()
    {
        return $this->DEADLINE;
    }
    
    public function getDateDevoir()
    {
        return $this->DATE_DEVOIR;
    }
    





    public function setdeadline($deadline)
    {
        $this->_deadline = $deadline;
    }
    
    
    
    public function set($format)
    {
        $this->_format_demandee = $format;
    }
    
    public function envoyermail()
    {}
    
    public function bloquer()
    {}
    
    public function formatacceptee()
    {}

     public function settitre($titre)
    {
        $this->_titre = $titre;
    }
     public function setennonce($ennonce)
    {
        $this->_ennonce = $ennonce;
    }


}

?>