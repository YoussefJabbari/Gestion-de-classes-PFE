<?php
require_once "Modeles/BD/EnseignantBD.php";
require_once 'Modeles/BD/ClasseBD.php';

$classe = new ClasseBD();
$enseignant = new EnseignantBD();
$objetEnseignant=$enseignant ->getEnseignantObject($_SESSION['id_enseignant']);



if(isset($_POST['nom_cours']) AND isset($_POST['semstre']) AND isset($_POST['annee_scolaire']) AND isset($_POST['nom_formation'])){
try{
	$classe->ajouterClasse($_SESSION['id_enseignant'],$_POST['nom_cours'],$_POST['semstre'],$_POST['annee_scolaire'],$_POST['nom_formation']);
}catch( PDOException $e ){}
	
	header('location:./index.php?page=CreerClasseControlleur');
}



$les_Classes = $classe->lesClasses($objetEnseignant->getIdEnseignant());
require_once 'Vues/Enseignant_Classes.php';



?>