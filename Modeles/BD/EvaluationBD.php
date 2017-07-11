
<?php
require_once 'Connexion.php';

require_once 'Modeles/Classe/Evaluation.php';

class  EvaluationBD
{
	
	private $_nom = "Evaluation";
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

	public function getEvaluation($id_classe , $CNE) //afficher tous les info d'un etudiant dans une classe
	{
		$req = $this->_db->prepare('SELECT * FROM Evaluation WHERE id_classe = ? AND CNE = ? ');
		$req->execute(array($id_classe , $CNE));
		$donnees = $req->fetch(PDO::FETCH_ASSOC);

		return $donnees;
	}

	public function getEvaluationObject($id_classe , $CNE) //afficher tous les info d'un etudiant dans une classe
	{
		$req = $this->_db->prepare('SELECT * FROM Evaluation WHERE id_classe = ? AND CNE = ? ');
		$req->execute(array($id_classe , $CNE));
		$donnees = $req->fetchObject('Evaluation');

		return $donnees;
	}

	public function add_etudiant($id_classe , $CNE) 
	{
		$sql="INSERT INTO evaluation VALUES(?,0,?,0,0,0,0,0,0)";
		$req=$this->_db->prepare($sql);
		$req->execute(array($id_classe , $CNE));

	}
    public function remove_etudiant($id_classe , $CNE) 
	{
		$sql="DELETE FROM evaluation WHERE ID_CLASSE = ? AND CNE = ?";
		$req=$this->_db->prepare($sql);
		$req->execute(array($id_classe , $CNE));

	}
    

	public function delete($id_classe )
	{
		$sql="DELETE FROM Evaluation WHERE ID_CLASSE = ? ";
		$req=$this->_db->prepare($sql);
		$req->execute(array($id_classe ));

	}



	public function updateNormal($id_classe, $CNE ,$note)//ajoute la note pour l'etudiant
	{
		$sql="UPDATE evaluation SET NOTE_NORMAL = ? WHERE ID_CLASSE = ? AND CNE = ?";
		$req = $this->_db->prepare($sql);
		$req->execute(array($note, $id_classe, $CNE));
	}

	public function updateRatt($id_classe , $CNE ,$note)//ajoute la note pour l'etudiant
	{
		$sql="UPDATE evaluation SET NOTE_RATTRAPAGE = ? WHERE ID_CLASSE = ? AND CNE = ?";
		$req = $this->_db->prepare($sql);
		$req->execute(array($note, $id_classe, $CNE));
	}

    public function updatecontrole($id_classe , $CNE, $note)
    {
        $sql="UPDATE evaluation SET NOTE_CONTROLE = ? WHERE ID_CLASSE = ? AND CNE = ?";
		$req = $this->_db->prepare($sql);
		$req->execute(array($note, $id_classe, $CNE));
    }
    
    public function afficherpersonne($cne)
	{
		$sql = "SELECT * FROM etudiant WHERE CNE=$cne";
		$req1=$this->_db->query($sql);
		$personne = $req1->fetch();
		return $personne;

	}
    
	public function afficherEvaluation($id_classe)
	{
		$sql="SELECT * FROM evaluation v JOIN etudiant e on v.CNE=e.CNE where ID_CLASSE = ?";
		$req=$this->_db->prepare($sql);
		$req->execute(array($id_classe));
        $data = $req->fetchAll();
		return $data;
	}
    
    public function NotesGlobalesExcel($id_classe)
    {
        $sql="SELECT v.CNE, NOM_ETUDIANT, PRENOM_ETUDIANT, EMAIL_ETUDIANT, NOTE_GLOBALE FROM evaluation v JOIN etudiant e on v.CNE=e.CNE where ID_CLASSE = ? ORDER BY NOM_ETUDIANT";
		$req=$this->_db->prepare($sql);
		$req->execute(array($id_classe));
        $data = $req->fetchAll();
		return $data;
    }
    
    public function NotesDetailleesExcel($id_classe)
    {
        $sql="SELECT v.CNE, NOM_ETUDIANT, PRENOM_ETUDIANT, EMAIL_ETUDIANT, PRESENCE, NOTE_DEVOIR, NOTE_CONTROLE, NOTE_NORMAL, NOTE_RATTRAPAGE, NOTE_GLOBALE FROM evaluation v JOIN etudiant e on v.CNE=e.CNE where ID_CLASSE = ? ORDER BY NOM_ETUDIANT";
		$req=$this->_db->prepare($sql);
		$req->execute(array($id_classe));
        $data = $req->fetchAll();
		return $data;
    }
    
    public function EtudiantsVExcel($id_classe)
    {
        $sql="SELECT v.CNE, NOM_ETUDIANT, PRENOM_ETUDIANT, EMAIL_ETUDIANT FROM evaluation v JOIN etudiant e on v.CNE=e.CNE where ID_CLASSE = ? AND NOTE_GLOBALE >= 10 ORDER BY NOM_ETUDIANT";
		$req=$this->_db->prepare($sql);
		$req->execute(array($id_classe));
        $data = $req->fetchAll();
		return $data;
    }
        
    public function EtudiantsRattExcel($id_classe)
    {
        $sql="SELECT v.CNE, NOM_ETUDIANT, PRENOM_ETUDIANT, EMAIL_ETUDIANT FROM evaluation v JOIN etudiant e on v.CNE=e.CNE where ID_CLASSE = ? AND NOTE_NORMAL < 10 ORDER BY NOM_ETUDIANT";
		$req=$this->_db->prepare($sql);
		$req->execute(array($id_classe));
        $data = $req->fetchAll();
		return $data;
    }
    
    public function EtudiantsNVExcel($id_classe)
    {
        $sql="SELECT v.CNE, NOM_ETUDIANT, PRENOM_ETUDIANT, EMAIL_ETUDIANT FROM evaluation v JOIN etudiant e on v.CNE=e.CNE where ID_CLASSE = ? AND NOTE_GLOBALE < 10 ORDER BY NOM_ETUDIANT";
		$req=$this->_db->prepare($sql);
		$req->execute(array($id_classe));
        $data = $req->fetchAll();
		return $data;
    }
    
    public function insertPresence($idclasse, $cne, $note)
    {
        $sql="UPDATE evaluation SET PRESENCE = ? WHERE ID_CLASSE = ? AND CNE = ?";
		$req = $this->_db->prepare($sql);
		$req->execute(array($note, $idclasse, $cne));
    }
    
    public function insertNoteDevoir($idclasse, $cne, $note)
    {
        $sql="UPDATE evaluation SET NOTE_DEVOIR = ? WHERE ID_CLASSE = ? AND CNE = ?";
		$req = $this->_db->prepare($sql);
		$req->execute(array($note, $idclasse, $cne));
    }
    
    public function insertNoteGlobale($idclasse, $cne, $note)
    {
        $sql="UPDATE evaluation SET NOTE_GLOBALE = ? WHERE ID_CLASSE = ? AND CNE = ?";
		$req = $this->_db->prepare($sql);
		$req->execute(array($note, $idclasse, $cne));
    }
    
	public function afficherNbreAbsence($CNE,$idclasse)
	{
		$sql="SELECT NBRE_ABSENCE FROM evaluation where CNE=? AND ID_CLASSE=?";
		$req=$this->_db->prepare($sql);
		$req->execute(array($CNE,$idclasse));
		$nbr=$req->fetch();
		return $nbr['NBRE_ABSENCE'];
	}
    
    public function afficherEtudiant($CNE,$idclasse)
	{
		$sql="SELECT * FROM evaluation where CNE=? AND ID_CLASSE=?";
		$req=$this->_db->prepare($sql);
		$req->execute(array($CNE,$idclasse));
		$nbr=$req->fetch();
		return $nbr;
	}

	public function updateNbreAbsence($id_clase , $CNE ,$nbr)//ajoute la note pour l'etudiant
	{
		//$nbr = settype($nbr, 'Integer');
		//$id_clase = settype($id_clase, 'Integer');
		$sql="UPDATE evaluation  SET NBRE_ABSENCE = ? WHERE ID_CLASSE = ? AND CNE = ?";
		$req = $this->_db->prepare($sql);
		$req->execute(array($nbr, $id_clase, $CNE));
	}
	
}
	
	
?>