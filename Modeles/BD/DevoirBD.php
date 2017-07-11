<?php

require_once 'Connexion.php';

require_once 'Modeles/Classe/Devoirs.php';
require_once 'Modeles/BD/TravailBD.php';

class DevoirBD
{
	private $_nom="Devoir";//Le nom de la classe
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

	public function getDevoir($id_devoir)
 	{
	    //$id = (int) $id;
	    $req = $this->_db->query('SELECT * FROM Devoir WHERE id_devoir = '.$id_devoir);
	    $donnees = $req->fetch(PDO::FETCH_ASSOC);

	    return $donnees;
  	}

	public function getDevoirObject($id_devoir)
	{
		//$id = (int) $id;
	    $req = $this->_db->query('SELECT * FROM Devoir WHERE id_devoir = '.$id_devoir);
	    $donnees = $req->fetchObject('Devoirs');

	    return $donnees;

//return un objet
	}

	public function add($id_classe ,$titre_devoir ,$enonce ,$deadline)
	{
		$sql="INSERT INTO ? (id_classe ,titre_devoir ,enonce ,deadline) VALUES(?,?,?,?)";
		 $req = $this->_db->prepare($sql);
		$req->execute(array($this->_nom ,$id_classe ,$titre_devoir ,$enonce ,$deadline));

	}

	public function update($id_devoir ,$id_classe ,$titre_devoir ,$enonce ,$deadline)
	{
		$sql="UPDATE ? SET id_classe = ? ,titre_devoir = ? ,enonce = ? ,deadline = ? WHERE id_devoir = ?";
		$req = $this->_db->prepare($sql);
		$req->execute(array($this->_nom ,$id_classe ,$titre_devoir ,$enonce ,$deadline ,$id_devoir));

		
	}

	public function delete($id_devoir)
	{

		$travail = new TravailBD();
		$travail->delete($id_devoir);
		$format = new FormatBD();
		$format->delete($id_devoir);
		$sql="DELETE FROM Devoir WHERE id_devoir = ? ";
		$req = $this->_db->prepare($sql);
		$req->execute(array($id_devoir));

	}

	public function AfficherDevoir($id_classe)
	{
		$devoirs = array();
		$sql = "SELECT  * 
		FROM devoir d
		JOIN format f
		ON d.ID_DEVOIR = f.ID_DEVOIR 
		WHERE d.ID_CLASSE = '$id_classe' ORDER BY d.ID_DEVOIR DESC ";
		$req = $this->_db->query($sql);
		while($data = $req->fetch()){

		$devoirs[]=$data;

		}
		return $devoirs;

	}

	public function addDevoir($id_classe,$titre_devoir,$enonce,$deadline)
	{
		
		$sql="INSERT INTO devoir (ID_CLASSE,TITRE_DEVOIR,ENONCE,DEADLINE,DATE_DEVOIR) VALUES(?,?,?,?,NOW()) ";
		$req = $this->_db->prepare($sql);
		$req->execute(array($id_classe, $titre_devoir, $enonce,$deadline));



		$sql="SELECT ID_DEVOIR FROM devoir ORDER BY ID_DEVOIR DESC LIMIT 0,1 ";
		$req = $this->_db->query($sql);
		$iddevoir = $req->fetch();

		return $iddevoir['ID_DEVOIR'];
	}
	public function existedevoir($id_devoir,$id_classe)
	{
		$sql = "SELECT * FROM devoir WHERE id_devoir='$id_devoir' AND id_classe ='$id_classe' ";
		$req = $this->_db->query($sql);
		if($data = $req->fetch()){
			return true;
		}else{
			return false;
		}
	}

	
	
}



?>