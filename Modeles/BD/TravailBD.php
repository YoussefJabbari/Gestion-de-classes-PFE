<?php
require_once 'Connexion.php';

require_once 'Modeles/Classe/Travail.php';

class  TravailBD
{
	private $_nom="Travail";//Le nom de la classe
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

	public function getTravail($id_devoir , $CNE)
 	{
	    $id = (int) $id;
	    $req = $this->_db->query('SELECT * FROM Travail WHERE id_devoir = '.$id_devoir.' AND cne ='.$CNE);
	    $donnees = $req->fetch(PDO::FETCH_ASSOC);

	    return $donnees;
  	}

	public function getTravailObject($id_devoir , $CNE)
	{

		$req = $this->_db->query('SELECT * FROM Travail WHERE id_devoir = '.$id_devoir.' AND cne ='.$CNE);
		$donnees = $req->fetchObject('Travail');

		return $donnees;

	}

	public function addTravail($id_devoir,$cne,$URL_travail)
{
		
	$sql = "SELECT * FROM devoir d JOIN format f WHERE f.ID_DEVOIR = d.ID_DEVOIR AND f.ID_DEVOIR = $id_devoir";
	$req = $this->_db->query($sql);
	$resulta =$req->fetch();

	if(date("Y-m-d")<$resulta['DEADLINE']){

		$extension_upload = strtolower(  substr(  strrchr($_FILES[$URL_travail]['name'], '.')  ,1)  );
		if($extension_upload==$resulta['TYPE_FORMAT']){

		$sql="INSERT INTO travail (id_devoir ,CNE) VALUES(?,?)";
		$req = $this->_db->prepare($sql);
		$req->execute(array($id_devoir,$cne));

		$sql="SELECT ID_TRAVAIL FROM travail ORDER BY ID_TRAVAIL DESC ";
		$req = $this->_db->prepare($sql);
		$req->execute();
		$idtravail=$req->fetch();

		$extension_upload = strtolower(  substr(  strrchr($_FILES[$URL_travail]['name'], '.')  ,1)  );

		$id=(string)$idtravail['ID_TRAVAIL'];
		

		$nom = "Telechargement/Travail/Travail{$id}.{$extension_upload}";
		move_uploaded_file($_FILES[$URL_travail]['tmp_name'],$nom);  

		$sql="UPDATE  travail SET URL_TRAVAIL = ? WHERE ID_TRAVAIL = ?";

		$req=$this->_db->prepare($sql);
		$req->execute(array($nom ,$idtravail['ID_TRAVAIL']));

								return true;

								}else{
								
								return false;
								}
								}else{
									
								return false;

			}


	}

	public function update($id_travail ,$id_devoir ,$CNE ,$num_version ,$titreTravail)
	{
		$sql="UPDATE ? SET id_devoir = ? ,CNE = ? ,num_version = ? ,titreTravail = ?  WHERE id_travail = ? ";
		$req = $this->_db->prepare($sql);
		$req->execute(array($this->_nom ,$id_devoir ,$CNE ,$num_version ,$titreTravail ,$id_travail));

	}

	public function delete($id_devoir)
	{
		$sql="DELETE FROM Travail WHERE id_devoir = ? ";
		$req = $this->_db->prepare($sql);
		$req->execute(array($id_devoir));

	}

	
	public function afficherTravail($id_devoir,$idclasse)
	{
		$sql="SELECT * FROM etudiant e JOIN evaluation v ON v.CNE=e.CNE WHERE v.ID_CLASSE=? ";
		$req=$this->_db->prepare($sql);
		$req->execute(array($idclasse));
		return $req;

	}
	public function afficher($id_devoir,$CNE)
	{
		$sql = "SELECT * FROM travail WHERE ID_DEVOIR=$id_devoir AND CNE=$CNE";
		$req1=$this->_db->prepare($sql);
		$req1->execute(array());
		return $req1;
	}

	public function afficherpersonne($cne)
	{
		$sql = "SELECT * FROM etudiant WHERE CNE=$cne";
		$req1=$this->_db->query($sql);
		$personne = $req1->fetch();
		return $personne;

	}

	public function saisirNote($note_devoir,$id_devoir,$CNE)
	{
		$sql="UPDATE travail  SET Note_Devoir = ? WHERE ID_DEVOIR = ? AND CNE = ?";
		$req = $this->_db->prepare($sql);
		$req->execute(array($note_devoir,$id_devoir,$CNE));
	}
    
    
    public function afficherNoteTravail($cne)
    {
        $sql = "SELECT ID_DEVOIR , AVG(Note_Devoir) AS NOTE_DEVOIR FROM travail WHERE CNE=?
                GROUP BY ID_DEVOIR";
		$req=$this->_db->prepare($sql);
		$req->execute(array($cne));
        $data = $req->fetchAll();
		return $data;
    }
	
	
	
}



?>