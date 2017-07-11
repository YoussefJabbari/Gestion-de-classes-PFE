
<?php
require_once 'Connexion.php';

require_once 'Modeles/Classe/Format.php';

class  FormatBD
{
	private $_nom="Format";//Le nom de la classe
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
	public function getFormat($id_format)
 	{
	    $req = $this->_db->query('SELECT * FROM Format WHERE id_format = '.$id_format);
	    $donnees = $req->fetch(PDO::FETCH_ASSOC);

	    return $donnees;
  	}

	public function getFormatObject($id_devoir)
	{
	    $req = $this->_db->query('SELECT * FROM Format WHERE id_devoir = '.$id_devoir);
	    $donnees = $req->fetchObject('Format');

	    return $donnees;
	}

	public function add($id_devoir,$type_format)
	{
		$sql="INSERT INTO format (ID_DEVOIR ,TYPE_FORMAT) VALUES(?,?)";
		$req = $this->_db->prepare($sql);
		$req->execute(array($id_devoir ,$type_format));
	}

	public function update($id_format,$id_devoir,$type_format){
		$sql="UPDATE ? SET id_devoir = ? , type_format = ? WHERE id_format = ?";
		$req = $this->_db->prepare($sql);
		$req->execute(array($this->_nom,$id_devoir,$type_format,$id_format));

	}

	public function delete($id_devoir)
	{
		$sql="DELETE FROM Format WHERE id_devoir = ?";
		$req = $this->_db->prepare($sql);
		$req->execute(array($id_devoir));
		
	}
	
	
}



?>