<?php
require_once "Modeles/BD/EnseignantBD.php";
require_once 'Modeles/BD/DemandeBD.php';
require_once 'Modeles/BD/EvaluationBD.php';


$enseignant = new EnseignantBD();
$objetEnseignant=$enseignant ->getEnseignantObject($_SESSION['id_enseignant']);

$demand = new DemandeBD();
if(isset($_GET['CNE']) AND isset($_GET['classeid']))
{
	if($_GET['etat']=='Ajouter'){

	$ajoute = new EvaluationBD();
	$ajoute->add_etudiant($_GET['classeid'],$_GET['CNE']);
	}
	$demand->delete($_GET['classeid'],$_GET['CNE']);
	header('location:./index.php?page=DemandeDesEtudiant');
}

	$demand = new DemandeBD();
	$lesdemandes=$demand->afficherdemande($_SESSION['id_enseignant']);
	require_once 'Vues/Enseignant_Demandes.php';


?>