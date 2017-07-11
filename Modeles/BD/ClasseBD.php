<?php

require_once 'Connexion.php';

require_once 'Modeles/Classe/Classe.php';
require_once 'Modeles/BD/DocumentBD.php';
require_once 'Modeles/BD/AbsenceBD.php';
require_once 'Modeles/BD/EvaluationBD.php';
require_once 'Modeles/BD/DemandeBD.php';
require_once 'Modeles/BD/DevoirBD.php';
require_once 'Modeles/BD/PublierBD.php';
require_once 'Modeles/BD/FormatBD.php';


class  ClasseBD
{
	private $_nom="Classe";//Le nom de la classe
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

	public function getClasse($id)
 	{
	    //$id = (int) $id;
	    $req = $this->_db->query('SELECT * FROM Classe WHERE id_classe = '.$id_classe);
	    $donnees = $req->fetch(PDO::FETCH_ASSOC);

	    return $donnees;
  	}


	public function getClasseObject($id_classe)
	{
	    $req = $this->_db->query('SELECT * FROM Classe WHERE id_classe = '.$id_classe);
	    $donnees = $req->fetchObject('Classe');

	    return $donnees;
	}

	public function lesClasses($id_enseignant)
	{
		$classe = array();
		$sql = "SELECT * FROM classe WHERE id_enseignant='$id_enseignant'";
		$req = $this->_db->query($sql);
		while($data = $req->fetch()){
				$classe[]=$data;
			}
			return $classe;
	}
//creer une classe
	public function add($id_enseignant, $nom_cours, $semestre, $annee_univ, $nom_formation, $note_reference, $pourcent_devoir, $pourcent_exam, $pourcent_assduite, $pourcent_controle, $nbr_seance)
	{
		$sql = "INSERT INTO ? (ID_ENSEIGNANT, NOM_COURS, SEMESTRE, ANNEE_UNIV, NOM_FORMATION, NOTE_REFERENCE, POURCENT_DEVOIR, POURCENT_EXAM, POURCENT_ASSDUITE, POURCENT_CONTROLE, NBR_SEANCE ) VALUES(?,?,?,?,?,?,?,?,?,?,?)";

		$req = $this->_db->prepare($sql);
		$req->execute(array($this->_nom, $id_enseignant, $nom_cours, $semestre, $annee_univ, $nom_formation, $note_reference, $pourcent_devoir, $pourcent_exam, $pourcent_assduite, $pourcent_controle, $nbr_seance));

	}

	public function update($id_classe, $id_enseignant, $nom_cours, $semestre, $annee_univ, $nom_formation, $note_reference, $pourcent_devoir, $pourcent_exam, $pourcent_assduite, $pourcent_controle, $nbr_seance)
	{
		$sql="UPDATE ? SET ID_ENSEIGNANT = ?, NOM_COURS = ?, SEMESTRE = ?, ANNEE_UNIV = ?, NOM_FORMATION = ?, NOTE_REFERENCE = ?, POURCENT_DEVOIR = ?, POURCENT_EXAM = ?, POURCENT_ASSDUITE = ?, POURCENT_CONTROLE = ?, NBR_SEANCE = ? WHERE id_classe = ?";

		$req = $this->_db->prepare($sql);

		$req->execute(array($this->_nom, $id_enseignant, $nom_cours, $semestre, $annee_univ, $nom_formation, $note_reference, $pourcent_devoir, $pourcent_exam, $pourcent_assduite, $pourcent_controle, $nbr_seance, $id_classe));
	}

	public function delete($id)
	{

		try {
			$sql="SELECT * FROM Document WHERE ID_CLASSE='$id'";
			$resulta = $this->_db->query($sql);
			$document = new DocumentBD();
			while($value = $resulta->fetch())
			{
				$document->delete($value['ID_DOCUMENT']);
			}
			}catch (Exception $e) {}

		try{
			$absence = new AbsenceBD();
			$absence->delete($id);
			}catch (Exception $e) {}

		try{
			$evaluation = new EvaluationBD();
			$evaluation->delete($id);
			} catch (Exception $e) {}


			try{
			$demande= new DemandeBD();
			$demande->deleteClasse($id);
			} catch (Exception $e) {}

		try{
			$sql="SELECT * FROM Devoir WHERE ID_CLASSE='$id'";
			$resulta = $this->_db->query($sql);
			$devoir = new DevoirBD();

			while($value = $resulta->fetch()){

				$devoir->delete($value['ID_DEVOIR']);
			}
			}catch (Exception $e) {}

		try{
			$sql="SELECT * FROM publier_annonce WHERE ID_CLASSE='$id'";
			$resulta = $this->_db->query($sql);

			$publier = new PublierBD();
			while($value = $resulta->fetch()){
				$publier->delete($value['ID_ANNONCE'],$id);
			}
		    }catch (Exception $e){}

		try{
			$sql="DELETE FROM classe WHERE ID_CLASSE=?";
			$req = $this->_db->prepare($sql);
			$req->execute(array($id));
			}catch (Exception $e) {}

	}

	

	public function ajouterClasse($id_enseignant, $nom_cours, $semestre, $annee_univ, $nom_formation)
	{
		$sql = "INSERT INTO classe (id_enseignant, nom_cours, semestre, annee_univ, nom_formation) VALUES (?,?,?,?,?)";

		$req = $this->_db->prepare($sql);
		$req->execute(array($id_enseignant, $nom_cours, $semestre, $annee_univ, $nom_formation));
	}
	
	public function stockerSession($idClasse)
	{
		$sql = "SELECT * FROM classe WHERE id_classe='$idClasse'";
		$req = $this->_db->query($sql);
		$classe = $req->fetch();
		$_SESSION['ID_CLASSE']=$classe['ID_CLASSE'];
		$_SESSION['NOM_COURS']=$classe['NOM_COURS'];
		$_SESSION['ANNEE_UNIV']=$classe['ANNEE_UNIV'];
		$_SESSION['NOM_FORMATION']=$classe['NOM_FORMATION'];
		$_SESSION['SEMESTRE']=$classe['SEMESTRE'];
	}
	public function insertPourcentage($pourcentdevoir,$pourcentexam,$pourcentassduite,$pourcentcontrole,$idclasse)
	{
		$sql="UPDATE classe SET POURCENT_DEVOIR=? ,POURCENT_EXAM=? ,POURCENT_ASSDUITE=?,POURCENT_CONTROLE=? WHERE ID_CLASSE=?";
		$req=$this->_db->prepare($sql);
		$req->execute(array($pourcentdevoir,$pourcentexam,$pourcentassduite,$pourcentcontrole,$idclasse));

	}
    
    public function insertInfoAssiduite($notereference, $nbrseances, $idclasse)
    {
        $sql="UPDATE classe SET NOTE_REFERENCE=? ,NBR_SEANCE=? WHERE ID_CLASSE=?";
		$req=$this->_db->prepare($sql);
		$req->execute(array($notereference,$nbrseances,$idclasse));
    }
    
	public function lesCLassesEtudiant($CNE)
	{
		$sql="SELECT * FROM classe c JOIN evaluation e ON c.ID_CLASSE = e.ID_CLASSE WHERE e.CNE = ?";
		$req = $this->_db->prepare($sql);
		$req->execute(array($CNE));
		return $req;
	}
    
    public function rechercherclasse($cne, $nom_cours=NULL, $semestre=NULL, $annee_univ=NULL, $nom_formation=NULL)
    {
        $classetrouvee = array();
        $sql = "SELECT *
                FROM classe c
                JOIN enseignant e
                ON c.ID_ENSEIGNANT = e.ID_ENSEIGNANT
                WHERE c.NOM_COURS LIKE '%$nom_cours%' AND c.SEMESTRE LIKE '%$semestre%' AND c.ANNEE_UNIV LIKE '%$annee_univ%' AND c.NOM_FORMATION LIKE '%$nom_formation%' AND c.ID_CLASSE != ALL
                        (SELECT ID_CLASSE
                        FROM evaluation
                        WHERE CNE LIKE '$cne')
                        AND c.ID_CLASSE != ALL
                        (SELECT ID_CLASSE
                        FROM demande
                        WHERE CNE LIKE '$cne');";
        
        $req = $this->_db->query($sql);
        while($data = $req->fetch()){
				$classetrouvee[]=$data;
			}
			return $classetrouvee;
    }
	
}



?>