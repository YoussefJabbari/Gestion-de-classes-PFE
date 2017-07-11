<?php
require_once 'Connexion.php';

require_once 'Modeles/Classe/Annonces.php';

class  AnnonceBD
{
	
	private $_nom = "Annonce";
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

	public function getAnnonce($id_annonce)
	{
		$req = $this->_db->query('SELECT * FROM Annonce WHERE id_annonce = '.$id_annonce);
		$donnees = $req->fetch(PDO::FETCH_ASSOC);

		return $donnees;
	}

	public function getAnnonceObject($id_annonce){

		$req = $this->_db->query('SELECT * FROM Annonce WHERE id_annonce = '.$id_annonce);
		$donnees = $req->fetchObject('Annonces');

		return $donnees;

	}

	public function add($id_enseignant ,$titre_annonce ,$annonce)
	{
		$sql="INSERT INTO ? (id_enseignant ,titre_annonce ,annonce) VALUES(?,?,?)";
		$req = $this->_db->prepare($sql);
		$req->execute(array($this->_nom ,$id_enseignant ,$titre_annonce ,$annonce));

	}

	public function update($id_annonce, $id_enseignant, $titre_annonce, $annonce)
	{
		$sql="UPDATE ? SET id_annonce = ? ,id_enseignant = ? ,titre_annonce = ? ,annonce = ?  WHERE id_annonce = ? ";
		$req = $this->_db->prepare($sql);
		$req->execute(array($this->_nom, $id_enseignant, $titre_annonce, $annonce, $id_annonce));
	}

	public function delete($id_annonce)
	{
		$sql="DELETE FROM ? WHERE id_annonce = ? ";
		$req = $this->_db->prepare($sql);
		$req->execute(array($this->_nom, $id_annonce));

	}

	public function AfficherAnnonce($id_classe)
	{
		$annonces = array();
		$sql = "SELECT  * 
		FROM annonce a
		JOIN publier_annonce p
		ON a.ID_ANNONCE = p.ID_ANNONCE 
		JOIN classe c
		ON p.ID_CLASSE = c.ID_CLASSE
		WHERE c.id_classe = '$id_classe' ORDER BY a.DATE_ANNONCE DESC";
		$req = $this->_db->query($sql);
		while($data = $req->fetch()){

		$annonces[]=$data;

		}
		return $annonces;

	}




	public function addAnnonce($id_classe,$id_enseignant,$annonce,$titre_annonce)
	{
		//pour insert une annonce dans un database il faut ajouter dans 2 tables anonnce etv publier_annonce 
		//alors pour la premier etap il faut ajouter dant le tableau de annonce et retourne le id anonnce pour ajouter dans le tableau publier_annonce
		$sql="INSERT INTO annonce (ID_ENSEIGNANT,TITRE_ANNONCE,ANNONCE,DATE_ANNONCE) VALUES(?,?,?,NOW()) ";
		$req = $this->_db->prepare($sql);
		
		$req->execute(array($id_enseignant, $titre_annonce, $annonce));

		$sql="SELECT ID_ANNONCE FROM annonce ORDER BY ID_ANNONCE DESC";
		$req = $this->_db->query($sql);
		$idannonce = $req->fetch();

		return $idannonce['ID_ANNONCE'];
	}
	
	
}



?>