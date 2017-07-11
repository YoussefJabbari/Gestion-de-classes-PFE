<?php
require_once 'Modeles/BD/DocumentBD.php';
require_once 'Modeles/BD/VersiondocumentBD.php';
require_once "Modeles/BD/EnseignantBD.php";
require_once 'Modeles/BD/ClasseBD.php';

$classe = new ClasseBD();
$enseignant = new EnseignantBD();
$objetEnseignant=$enseignant ->getEnseignantObject($_SESSION['id_enseignant']);
$objetClasse=$classe->getClasseObject($_SESSION['id_classe']);



if(isset($_GET['idDoc']))
{
	if (isset($_FILES['fichier'])){

			
			$documentver = new VersiondocumentBD();
			$documentver->addVersion($_GET['idDoc'], 'fichier');

			header('location:./index.php?page=Documentselect&idDoc='.$_GET['idDoc']);

			
	


	}

	$document = new DocumentBD();
	$document1=$document->afficherDocumentselect($_GET['idDoc']);
	$version = new VersiondocumentBD();
	$versions = $version->afficherVersion($_GET['idDoc']);


}






require_once 'Vues/Enseignant_Document_selectionne.php';
?>