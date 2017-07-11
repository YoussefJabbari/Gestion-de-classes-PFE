
<?php
require_once 'Connexion.php';

require_once 'Modeles/Classe/Etudiant.php';


class  EtudiantBD
{
	
	private $_nom = "Etudiant";
	private $_db;


	public function setDb(PDO $db)
	{
	    $this->_db = $db;
	}

	public function __construct()
    {
    	$db = new Connexion();
	    $this->setDb($db->getPDO());
	}


	public function getEtudiant($CNE)
	{
		
	}

	public function getEtudiantObject($CNE)
	{
		$req = $this->_db->query('SELECT * FROM Etudiant WHERE CNE = '.$CNE);
		$donnees = $req->fetchObject('Etudiant');

		return $donnees;
	}
	

	//insert un etudiant avec nombre d'assisuite egale 0
	public function add($CNE,$nom,$prenom,$mdp,$email,$dnn,$photo)
	{
		$sql="INSERT INTO etudiant (CNE,nom_etudiant ,prenom_etudiant ,mdp_etudiant ,email_etudiant ,date_etudiant ,DATE_INSCRIPTION,nbr_heures) VALUES(?,?,?,?,?,?,NOW(),?)";
		$req = $this->_db->prepare($sql);
		$req->execute(array($CNE ,$nom ,$prenom ,$mdp ,$email ,$dnn,0));
		$extension_upload = strtolower(  substr(  strrchr($_FILES['photo']['name'], '.')  ,1)  );
		$id=(string)$CNE;
		$nom = "Telechargement/ImageEtudiant/{$id}.{$extension_upload}";
		move_uploaded_file($_FILES[$photo]['tmp_name'],$nom);
		$sql="UPDATE  etudiant SET photo_etudiant = ? WHERE CNE = ?";
		$req=$this->_db->prepare($sql);
		$req->execute(array($nom ,$CNE));

	}

	public function update($CNE ,$nom ,$prenom ,$mdp ,$email ,$dnn ,$photo ,$nbrh)
	{
		$sql="UPDATE  ? SET nom_etudiant = ? ,prenom_etudiant = ? ,mdp_etudiant = ? ,email_etudiant = ? ,date_etudiant = ? ,photo_etudiant = ? ,nbr_heure = ?  WHERE CNE = ? ";
		$req = $this->_db->prepare($sql);
		$req->execute(array($this->_nom ,$nom ,$prenom ,$mdp ,$email ,$dnn ,$photo ,$nbrh ,$CNE));

	}

	public function delete($CNE)
	{
		$sql="DELETE FROM ? WHERE CNE = ? ";
		$req = $this->_db->prepare($sql);
		$req->execute(array($this->_nom,$CNE));

		
	}


	public function existe($cne)
	{
		$sql =  "SELECT * FROM etudiant WHERE CNE = $cne";
		$resulta = $this->_db->query($sql);
		if($req=$resulta->fetch())
		{
			return true;
		}else
		{
			return false;
		}
	}

	public function dejaExiste($cne,$id_classe)
	{
		$sql =  "SELECT * FROM evaluation WHERE CNE = $cne AND ID_CLASSE = $id_classe";
		$resulta = $this->_db->query($sql);
		if($req=$resulta->fetch())
		{
			return true;
		}else
		{
			return false;
		}
		


	}

	public function valide($email,$mdp)
	{	
			$sql="SELECT * FROM etudiant WHERE EMAIL_ETUDIANT='$email' AND MDP_ETUDIANT='$mdp'";
			$req=$this->_db->query($sql);

			if($data = $req->fetch()){

				return $data['CNE'];

			}else{

				return false;
			}
	}



	public function afficherLesEtudiants($idclasse)
	{
		$sql="SELECT * FROM evaluation v JOIN etudiant e ON e.CNE=v.CNE WHERE ID_CLASSE=?";
		$req=$this->_db->prepare($sql);
		$req->execute(array($idclasse));
		return $req;

	}
	
	
}



?>