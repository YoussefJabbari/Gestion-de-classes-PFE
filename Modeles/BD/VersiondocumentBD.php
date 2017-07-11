
<?php
require_once 'Connexion.php';

require_once 'Modeles/Classe/Versiondocument.php';

class  VersiondocumentBD
{
	private $_nom="Versiondocument";//Le nom de la classe
	private $_db;//Instance de PDO

	public function __construct()
    {
    	$db = new Connexion();
	    $this->setDb($db->getPDO());
	}

	public function setDb(PDO $db)
	{
	    $this->_db = $db;
	}

	public function getVersion($id)
 	{
	    $id = (int) $id;
	    $req = $this->_db->query('SELECT * FROM Versiondocument WHERE id_document = '.$id);
	    $donnees = $req->fetch(PDO::FETCH_ASSOC);

	    return $donnees;
  	}

	public function getVersionObject($id)
	{
		$id = (int) $id;
	    $req = $this->_db->query('SELECT * FROM Versiondocument WHERE id_document = '.$id);
	    $donnees = $req->fetchObject('Versiondocument');

	    return $donnees;
	}

	public function add($id_document, $date_mise, $type)
	{
		$sql="INSERT INTO ? (id_document, date_mise, type) VALUES(?,?,?)";
		$req = $this->_db->prepare($sql);
		$req->execute(array($this->_nom, $id_document, $date_mise, $type));
	}

	public function update($id_version, $id_document, $date_mise, $type)
	{
		$sql="UPDATE ? SET id_document = ?, date_mise = ?, type = ? WHERE id_version = ? ";
		$req = $this->_db->prepare($sql);
		$req->execute(array($this->_nom, $id_document, $date_mise, $type, $id_version));

	}

	public function delete($id_version)
	{
		$sql="DELETE FROM Versiondocument WHERE ID_VERSION = ?";
		$req = $this->_db->prepare($sql);
		$req->execute(array($id_document));

	}
	public function addVersion($id_document,  $URL)
	{
		$sql="INSERT INTO Versiondocument (ID_DOCUMENT, DATE_MISE) VALUES(?,NOW())";
		$req = $this->_db->prepare($sql);
		$req->execute(array($id_document));


		$sql="SELECT ID_VERSION FROM Versiondocument ORDER BY ID_VERSION DESC ";
		$req = $this->_db->prepare($sql);
		$req->execute();
		$idversion=$req->fetch();



		$id=(string)$id_document;
		$idv=(string)$idversion['ID_VERSION'];

		$extension_upload = strtolower(  substr(  strrchr($_FILES[$URL]['name'], '.')  ,1)  );
		$nom = "Telechargement/Document/{$id}Version{$idv}.{$extension_upload}";
		move_uploaded_file($_FILES[$URL]['tmp_name'],$nom);   


		$sql="UPDATE  document SET URL_DOCUMENT = ? WHERE ID_DOCUMENT = ?";
		$req=$this->_db->prepare($sql);
		$req->execute(array($nom ,$id_document));


		$sql="UPDATE  versiondocument SET URL_VERSION = ? WHERE ID_VERSION = ?";
		$req=$this->_db->prepare($sql);
		$req->execute(array($nom ,$idversion['ID_VERSION']));

	

		
	}



public function afficherVersion($idDoc)
	{
		$sql = "SELECT * FROM versiondocument WHERE ID_DOCUMENT = ? ORDER BY id_version DESC";
		$req = $this->_db->prepare($sql);
		$req->execute(array($idDoc));
		if($data=$req->fetch())
		{
			$documents[]=$data;
		}else{
			return false;
		}
		while($data = $req->fetch()){

		$documents[]=$data;

		}

		return $documents;
	}
	
	
}



?>