<?php

require_once 'Connexion.php';

require_once 'Modeles/Classe/Demande.php';

class  DemandeBD
{
	private $_nom="Demande";//Le nom de la classe
	private $_db;//Instance de PDO

	public function __construct()//Lorsque declarer un objet de la classe alors il est connecte a bd
    {
    	$db = new Connexion();
	    $this->setDb($db->getPDO());
	}

	public function setDb(PDO $db)
	{
	    $this->_db = $db;
	}


	public function getDemandeObject($CNE , $id_classe)//tous les demandes
	{
		$req = $this->_db->query('SELECT * FROM Demande WHERE CNE = '.$CNE. ' AND ID_CLASSE = '.$id_classe);
		$donnees = $req->fetchObject("Demande");

		return $donnees;
	}


	public function add($id_classe , $CNE)
	{
		$sql="INSERT INTO ? VALUES(?,?,?)";
		$req=$this->_db->prepare($sql);
		$req->execute(array($this->_nom ,$id_classe , $CNE ,NOW()));

		
	}


	public function delete($id_classe , $CNE)
	{
		$sql="DELETE FROM demande WHERE id_classe = ? AND CNE = ?";
		$req=$this->_db->prepare($sql);
		$req->execute(array($id_classe , $CNE));

	}


	public function deleteClasse($id_classe){
		$sql="DELETE FROM demande WHERE ID_CLASSE = ? ";
		$req=$this->_db->prepare($sql);
		$req->execute(array($id_classe));
	}

	public function afficherdemande($id_enseignant)
	{
		$demandes = array();
		$sql = "SELECT  * 
		FROM classe c
		JOIN demande d
		ON d.id_classe = c.id_classe 
		JOIN etudiant e 
		ON e.CNE = d.CNE
		WHERE c.id_enseignant = '$id_enseignant'";
		$req = $this->_db->query($sql);
		while($data = $req->fetch()){
				$demandes[]=$data;
			}
			return $demandes;
	}
    
    public function envoyerdemande($cne, $id_classe)
    {
        $sql = "INSERT INTO demande VALUES (?,?,NOW())";
		$req = $this->_db->prepare($sql);
		$req->execute(array($cne, $id_classe));
    }
	
	
}



?>