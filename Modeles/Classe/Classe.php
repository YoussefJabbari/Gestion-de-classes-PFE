<?php
require_once('Documents.php');
require_once('Annonces.php');

class classe
{
  
    public $ID_CLASSE;
    public $ID_ENSEIGNANT;
    public $NOM_COURS;
    public $SEMESTRE;
    public $ANNEE_UNIV;
    public $NOM_FORMATION;
    public $NOTE_REFERENCE;
    public $POURCENT_DEVOIR;
    public $POURCENT_EXAM;
    public $POURCENT_ASSDUITE;
    public $POURCENT_CONTROLE;
    
    
    public function __counstruct($nom_cours=NULL , $semestre=NULL , $annee=NULL , $nom_formation=NULL , $note_reference=NULL)
    {
        $this->_nom_cours = $nom_cours;
        $this->_semestre = $semestre;
        $this->_annee_univ = $annee;
        $this->_nom_formation = $nom_formation;
        $this->_note_reference = $note_reference;
        $this->_document = new Documents();
        $this->_annonce = new Annonces();
        $this->_devoir = new Devoirs();
        $this->_pourcentage = new Pourcentages();
    }
    public function getIdClasse()
    {
        return $this->ID_CLASSE;
    }
    
    public function getNomCours()
    {
        return $this->NOM_COURS;
    }
    public function getSemestre()
    {
        return $this->SEMESTRE;
    }
     public function getNomFormation()
    {
        return $this->NOM_FORMATION;
    }
        
    public function getAnnee_Univ()
    {
        return $this->ANNEE_UNIV;
    }
    










    public function setannee_univ($annee)
    {
        $this->_annee_univ = $annee;
    }
    
    public function setnom_formation($nom_formation)
    {
        $this->_nom_formation = $nom_formation;
    }
    
    public function getnote_reference()
    {
        return $this->_note_reference;
    }
    
    public function setnote_reference($note_reference)
    {
        $this->_note_reference = $note_reference;
    }
     public function setnom_cours($nom_cours)
    {
        $this->_nom_cours = $nom_cours;
    }
    public function setsemestre($semestre)
    {
        $this->_semestre = $semestre;
    }
}

?>