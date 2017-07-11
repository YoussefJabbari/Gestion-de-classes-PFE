
<?php
require_once 'Connexion.php';
require_once 'Modeles/Classe/Documents.php';
require_once 'Modeles/BD/VersiondocumentBD.php';

class  DocumentBD
{
	
	private $_nom = "document";
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


	public function getDocument($id_document)
	{
		$req = $this->_db->query('SELECT * FROM Document WHERE id_document = '.$id_document);
		$donnees = $req->fetch(PDO::FETCH_ASSOC);

		return $donnees;
	}

	public function getDocumentObject($id_document){

		$req = $this->_db->query('SELECT * FROM Document WHERE id_document = '.$id_document);
		$donnees = $req->fetchObject('Documents');

		return $donnees;

	}

public function add($id_categorie, $id_classe, $titre_document, $description, $URL_document)
{
		$sql="INSERT INTO document (id_categorie ,id_classe ,titre_document ,description ,Date_Document) VALUES(?,?,?,?,NOW())";
		$req = $this->_db->prepare($sql);
		$req->execute(array($id_categorie ,$id_classe ,$titre_document ,$description));

		$sql="SELECT ID_DOCUMENT FROM document ORDER BY ID_DOCUMENT DESC ";
		$req = $this->_db->prepare($sql);
		$req->execute();
		$iddocument=$req->fetch();


		$sql="SELECT ID_VERSION FROM versiondocument ORDER BY ID_VERSION DESC ";
		$req = $this->_db->prepare($sql);
		$req->execute();
		$idversion=$req->fetch();


		$extension_upload = strtolower(  substr(  strrchr($_FILES[$URL_document]['name'], '.')  ,1)  );

		$id=(string)$iddocument['ID_DOCUMENT'];
		$idv=(string)($idversion['ID_VERSION']+1);


		$nom = "Telechargement/Document/{$id}Version{$idv}.{$extension_upload}";
		move_uploaded_file($_FILES[$URL_document]['tmp_name'],$nom);  

		$sql="UPDATE  document SET URL_DOCUMENT = ? WHERE ID_DOCUMENT = ?";

		$req=$this->_db->prepare($sql);
		$req->execute(array($nom ,$iddocument['ID_DOCUMENT']));


		//stocker la version;

		$sql="INSERT INTO versiondocument (ID_DOCUMENT,DATE_MISE,URL_VERSION) VALUES (?,NOW(),?)";
		$req = $this->_db->prepare($sql);
		$req->execute(array($iddocument['ID_DOCUMENT'],$nom));


	}

	public function update($id_document,$id_categorie,$id_classe,$titre_document,$description,$URL_document)
	{
		$sql="UPDATE ? SET id_categorie = ? ,id_classe = ? ,titre_document = ? ,description = ? ,URL_document = ? WHERE id_document = ?";
		$req = $this->_db->prepare($sql);
		$req->execute(array($this->_nom ,$id_categorie ,$id_classe ,$titre_document ,$description ,$URL_document ,$id_document));
	}

	public function delete($id_document)
	{

		$version = new VersiondocumentBD();
		$version->delete($id_document);
		$sql="DELETE FROM document WHERE id_document = ? ";
		$req = $this->_db->prepare($sql);
		$req->execute(array($id_document));
	}
	

	Public function afficherDocument($id_classe)
	{
		$documents = array();
		$sql = "SELECT * FROM document d Join categorie c on d.ID_CATEGORIE = c.ID_CATEGORIE Where d.ID_CLASSE = ? ORDER BY ID_DOCUMENT DESC ";
		$req = $this->_db->prepare($sql);
		$req->execute(array($id_classe));
		while($data = $req->fetch()){

		$documents[]=$data;

		}
		return $documents;

	}
	public function afficherDocumentselect($idDoc)
	{
		$sql = "SELECT * FROM document WHERE id_document = ?";
		$req = $this->_db->prepare($sql);
		$req->execute(array($idDoc));
		$date=$req->fetch();
		return $date;
	}
	


	public function countCours($id_classe)
	{
		$sql = "SELECT count(*) as N FROM document WHERE ID_CATEGORIE=1 AND ID_CLASSE = '$id_classe' ";
		$req=$this->_db->query($sql);
		$r1=$req->fetch();
		return $r1['N'];

	}
	public function countExercice($id_classe)
	{
		$sql = "SELECT count(*) as N FROM document WHERE ID_CATEGORIE=2 AND ID_CLASSE = '$id_classe' ";
		$req=$this->_db->query($sql);
		$r1=$req->fetch();
		return $r1['N'];

	}
	public function countAutre($id_classe)
	{
		$sql = "SELECT count(*) as N FROM document WHERE ID_CATEGORIE=3 AND ID_CLASSE = '$id_classe' ";
		$req=$this->_db->query($sql);
		$r1=$req->fetch();
		return $r1['N'];
	}
}



?>