<?php

require_once 'Connexion.php';

require_once 'Modeles/Classe/Absence.php';

class  AbsenceBD
{
	private $_nom = "Absence";
	private $_db;

	public function __construct()//Lorsqu'on déclare un objer de la classe alors il est déjà connecté à la BD
    {
    	$db = new Connexion();
	    $this->setDb($db->getPDO());
	}

	public function setDb(PDO $db)
	{
	    $this->_db = $db;
	}

	public function getAbsence($CNE)//Toutes les absences d'un étudiant
	{
		$req = $this->_db->query('SELECT * FROM Absence WHERE CNE = '.$CNE);
		$donnees = $req->fetchAll();

		return $donnees;
	}

	public function getAbsenceClasse($id_classe ,$date_seance)
	{
		$req = $this->_db->prepare("SELECT * FROM Absence WHERE id_classe = ? AND date_seance = ?");
		$req->execute(array($id_classe ,$date_seance));
		$donnees = $req->fetchAll();

		//Récupère les absences des étudiants d'une classe dans une date precisée
		return $donnees;
	}

	
	public function getAbsenceObject($CNE)//Toutes les absences d'un étudiant
	{
		$req = $this->_db->query('SELECT * FROM Absence WHERE CNE = '.$CNE);
		$donnees = $req->fetchAll(PDO::FETCH_CLASS, "Absence");

		return $donnees;
	}

	public function getAbsenceClasseObject($id_classe ,$date_seance)
	{
		$req = $this->_db->prepare("SELECT * FROM Absence WHERE id_classe = ? AND date_seance = ?");
		$req->execute(array($id_classe ,$date_seance));
		$donnees = $req->fetchAll(PDO::FETCH_CLASS, "Absence");

		//recupere tous les etudiants absence dans ce date par rapport un classe
		return $donnees;
	}

	public function add($CNE ,$id_classe ,$dateseance) //ajouter un absence dans une classe dans un date p
	{
		$sql="INSERT INTO absence (CNE ,ID_CLASSE ,DATE_SEANCE) VALUES(?,?,?)";
		$req = $this->_db->prepare($sql);
		$req->execute(array($CNE,$id_classe,$dateseance));

	}

	public function delete($id_classe)
	{
		$sql="DELETE FROM Absence WHERE ID_CLASSE = ? ";
		$req = $this->_db->prepare($sql);
        $req->execute(array($id_classe));
	}
	
	
}



?>