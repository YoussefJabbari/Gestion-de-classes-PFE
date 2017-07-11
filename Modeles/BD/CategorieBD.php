
<?php
require_once 'Connexion.php';

require_once 'Modeles/Classe/Categorie.php';

class  CategorieBD
{
	private $_nom = "Categorie";
	private $_db;

	public function __construct()//Lorsque declarer un objet de la classe alors il est connecte a bd
    {
    	$db = new Connexion();
	    $this->setDb($db->getPDO());
	}

	public function setDb(PDO $db)
	{
	    $this->_db = $db;
	}

	public function getCategorie($id_categorie)
	{
		$req = $this->_db->query('SELECT * FROM Categorie WHERE id_categorie = '.$id_categorie);
		$donnees = $req->fetch(PDO::FETCH_ASSOC);

		return $donnees;
	}

	public function getCategorieObject($id_categorie)
	{
		$req = $this->_db->query('SELECT * FROM Categorie WHERE id_categorie = '.$id_categorie);
		$donnees = $req->fetchObject('Categorie');

		return $donnees;
	}

	public function add($nom_categorie)
	{
		$sql="INSERT INTO ? (nom_categorie) VALUES(?,?)";
		$req = $this->_db->prepare($sql);
		$req->execute(array($this->_nom,$nom_categorie));

	}

	public function update($id_categorie, $nom_categorie)
	{
		$sql="UPDATE ? SET nom_categorie = ? WHERE id_categorie = ?";
		$req = $this->_db->prepare($sql);
		$req->execute(array($this->_nom ,$nom_categorie ,$id_categorie));

	
	}

	public function delete($id_categorie){

		$sql="DELETE FROM ? WHERE id_categorie = ?";
		$req= $this->_db->prepare($sql);
		$req->execute(array($this->_nom,$id_categorie));
	}
	
	
}



?>