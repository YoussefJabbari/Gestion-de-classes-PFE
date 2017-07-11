
<?php

require_once 'Connexion.php';
require_once 'Modeles/Classe/Enseignant.php';

class EnseignantBD
{
	
	private $_nom = 'enseignant';
	private $_db;

	public function __construct()
    {
    	$base = new Connexion();
	    $this->setDb($base->getPDO());
	}

	public function setDb(PDO $base)
	{
	    $this->_db = $base;
	}

	public function getEnseignant($id_enseignant)
	{
		$req = $this->_db->query('SELECT * FROM Enseignant WHERE id_enseignant = '.$id_enseignant);
		$donnees = $req->fetch(PDO::FETCH_ASSOC);

		return $donnees;
	}

	public function getEnseignantObject($id_enseignant)
	{
		$req = $this->_db->query('SELECT * FROM Enseignant WHERE id_enseignant = '.$id_enseignant);
		$donnees = $req->fetchObject('Enseignant');

		return $donnees;
	}
///inscription insert tout les info d'un prof (verification etudiant ou bien enseignant dans le controle)

	public function add($nom ,$prenom ,$mdp ,$email ,$dnn ,$photo)
	{	

		$sql = "INSERT INTO enseignant (NOM_ENSEIGNANT ,PRENOM_ENSEIGNANT ,MDP_ENSEIGNANT ,EMAIL_ENSEIGNANT ,DATE_ENSEIGNANT,DATE_INSCRIPTION) VALUES (:nom ,:prenom ,:mdp ,:email ,:dnn ,NOW());";
		$req = $this->_db->prepare($sql);
		$req->execute(array('nom'=>$nom,'prenom'=>$prenom,'mdp'=>$mdp,'email'=>$email,'dnn'=>$dnn));
		$sql="SELECT ID_ENSEIGNANT FROM enseignant ORDER BY ID_ENSEIGNANT DESC ";
		$req = $this->_db->prepare($sql);
		$req->execute();
		$idensegnant=$req->fetch();
		$extension_upload = strtolower(  substr(  strrchr($_FILES['photo']['name'], '.')  ,1)  );
		$id=(string)$idensegnant['ID_ENSEIGNANT'];
		$urlPhoto = "Telechargement/ImageEnseignant/{$id}.{$extension_upload}";
		move_uploaded_file($_FILES[$photo]['tmp_name'],$urlPhoto);
		$sql="UPDATE  enseignant SET photo_enseignant = ? WHERE id_enseignant = ?";
		$req=$this->_db->prepare($sql);
		$req->execute(array($urlPhoto ,$idensegnant['ID_ENSEIGNANT']));

		
	}

	public function update($id_enseignant ,$nom ,$prenom ,$mdp ,$email ,$dnn ,$photo)
	{
		$sql="UPDATE  ? SET nom_enseignant = ?,prenom_enseignant = ?,mdp_enseignant = ?,email_enseignant = ?,date_enseignant = ?,photo_enseignant = ? WHERE id_enseignant = ?";
		$req=$this->_db->prepare($sql);
		$req->execute(array($this->_nom ,$nom ,$prenom ,$mdp ,$email ,$dnn ,$photo ,$id_enseignant));

	}

	public function delete($id_enseignant)
	{
		$sql="DELETE FROM ? WHERE id_enseignant = ?";
		$req=$this->_db->prepare($sql);
		$req->execute(array($this->_nom ,$id_enseignant));

	}

	

	public function valide($email,$mdp)
	{	
			$sql="SELECT * FROM enseignant WHERE email_enseignant='$email' AND mdp_enseignant='$mdp'";
			$req=$this->_db->query($sql);

			if($data = $req->fetch()){

				return $data['ID_ENSEIGNANT'];

			}else{

				return false;
			}
	}
}
	
	
?>