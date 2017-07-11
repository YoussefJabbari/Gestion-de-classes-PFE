
<?php
require_once 'Connexion.php';

require_once 'Modeles/Classe/Publier.php';

class  PublierBD
{
	private $_nom="publier_annonce";//Le nom de la classe
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

	public function getPublierObject($id_annonce, $id_classe)
	{
		$req = $this->_db->query('SELECT * FROM publier_annonce WHERE ID_ANNONCE = '.$id_annonce. ' AND ID_CLASSE = '.$id_classe);
		$donnees = $req->fetchObject("Publier");

		return $donnees;
	}



	public function add($id_classe , $id_annonce)
	{
		
		
		$sql="INSERT INTO publier_annonce (ID_ANNONCE,ID_CLASSE) VALUES(?,?)";
		$req=$this->_db->prepare($sql);
		$req->execute(array($id_annonce , $id_classe));
		
	}


	public function delete($id_annonce,$id_classe)
	{


		$sql="DELETE FROM publier_annonce WHERE id_classe = ?";
		$req=$this->_db->prepare($sql);
		$req->execute(array($id_classe));

	}
	
	
}



?>