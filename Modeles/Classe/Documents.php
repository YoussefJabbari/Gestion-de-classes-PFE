<?php

class Documents
{
    private $_titre;
    private $_description;
    private $_date_mise_online;
    private $_type;
    private $_version;
    public $ID_DOCUMENT;
    public $ID_CATEGORIE; 
    public $ID_CLASSE;
    public $TITRE_DOCUMENT; 
    public $DESCRIPTION;
    public $URL_DOCUMENT;
    public $DATE_DOCUMENT;
    
    public function __construct($titre=NULL , $description=NULL , $date=NULL , $type=NULL , $version=NULL)
    {
        $this->_titre = $titre;
        $this->_description = $description;
        $this->_date_mise_online = $date;
        $this->_type = $type;
        $this->_version = $version;
    }
    
    public function gettitre()
    {
        return $this->_titre;
    }
    
    public function settitre($titre)
    {
        $this->_titre = $titre;
    }
    
    public function getdescription()
    {
        return $this->_description;
    }
    
    public function setdescription($description)
    {
        $this->_description = $description;
    }
    
    public function getdate_mise_online()
    {
        return $this->_date_mise_online;
    }
    
    public function setdate_mise_online($date)
    {
        $this->_date_mise_online = $date;
    }
    
    public function get_type()
    {
        return $this->_type;
    }
    
    public function set_type($type)
    {
        $this->_type = $type;
    }
    
    public function getversion()
    {
        return $this->_version;
    }
    
    public function setversion($version)
    {
        $this->_version = $version;
    }
    
    public function affichage()
    {}
}

?>