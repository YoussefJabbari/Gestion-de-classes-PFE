<?php

require_once 'Modeles/BD/DocumentBD.php';

require_once 'Modeles/BD/ClasseBD.php';
$classe = new ClasseBD();
$objetClasse=$classe->getClasseObject($_SESSION['id_classe']);



if(isset($_POST['titre_document']) AND isset($_POST['categorie']) AND isset($_POST['Description']))
{
	if(!($_FILES['fichier']['error'] > 0)){

	$_POST['categorie']=(int)$_POST['categorie'];
	$document = new DocumentBD();
	$document->add($_POST['categorie'],$_SESSION['id_classe'],$_POST['titre_document'],$_POST['Description'],'fichier');
	header('location:./index.php?page=ClasseDocument');

}

}

$document = new DocumentBD();
$documents=$document->afficherDocument($_SESSION['id_classe']);
$statiquecour=$document->countCours($_SESSION['id_classe']);
$statiquexercice=$document->countExercice($_SESSION['id_classe']);
$statiquautre=$document->countAutre($_SESSION['id_classe']);


require_once 'Vues/Enseignant_Documents.php';

?>