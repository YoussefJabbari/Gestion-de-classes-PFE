<?php
require_once 'Modeles/BD/AbsenceBD.php';
require_once 'Modeles/BD/EvaluationBD.php';
require_once 'Modeles/BD/DocumentBD.php';
require_once 'Modeles/BD/VersiondocumentBD.php';
require_once "Modeles/BD/EnseignantBD.php";
require_once 'Modeles/BD/ClasseBD.php';


$evaluation = new EvaluationBD();
$classe = new ClasseBD();
$enseignant = new EnseignantBD();
$objetEnseignant=$enseignant ->getEnseignantObject($_SESSION['id_enseignant']);
$objetClasse=$classe->getClasseObject($_SESSION['id_classe']);

if(isset($_POST['date_seance']))
{
	foreach ($_POST['absence'] as $key => $value) {
		$absen = new AbsenceBD();
		$absen->add($value,$_SESSION['id_classe'],$_POST['date_seance']);
		$nbr=(int)$evaluation->afficherNbreAbsence($value,$_SESSION['id_classe']);

		$nbr++;

		$evaluation->updateNbreAbsence($_SESSION['id_classe'],$value ,$nbr);
	}

	header('location:./index.php?page=ClasseAssiduite');

}


$evaluation = new EvaluationBD();
$etudiants = $evaluation->afficherEvaluation($_SESSION['id_classe']);


require_once 'Vues/Enseignant_Assiduite.php';






?>