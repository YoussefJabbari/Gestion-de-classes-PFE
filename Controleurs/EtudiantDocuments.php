<?php

require_once 'Modeles/BD/DocumentBD.php';
require_once 'Modeles/BD/ClasseBD.php';

require_once 'Modeles/BD/EtudiantBD.php';

if(isset($_SESSION['id_classe'])){

	$etudiant = new EtudiantBD();
	$objetEtudiant=$etudiant ->getEtudiantObject($_SESSION['CNE']);

$classe = new ClasseBD();

$objetClasse=$classe->getClasseObject($_SESSION['id_classe']);
$document = new DocumentBD();
$documents=$document->afficherDocument($_SESSION['id_classe']);

$statiquecour=$document->countCours($_SESSION['id_classe']);
$statiquexercice=$document->countExercice($_SESSION['id_classe']);
$statiquautre=$document->countAutre($_SESSION['id_classe']);


require_once 'Vues/Etudiant_Documents.php';

}

?>