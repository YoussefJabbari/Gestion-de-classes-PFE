<?php

require_once 'Modeles/BD/ClasseBD.php';
require_once 'Modeles/BD/DevoirBD.php';
require_once 'Modeles/BD/FormatBD.php';
require_once 'Modeles/BD/TravailBD.php';



$travail= new TravailBD();
$classe = new ClasseBD();
$devoirs= new DevoirBD();
$format= new FormatBD();
$objetClasse=$classe->getClasseObject($_SESSION['id_classe']);




if(isset($_GET['ide']) and $devoirs->existedevoir($_GET['ide'],$_SESSION['id_classe']))
{

	$etudiantTravail = $travail->afficherTravail($_GET['ide'],$_SESSION['id_classe']);
	$objetDevoir = $devoirs->getDevoirObject($_GET['ide']);
	$objetFormat = $format->getFormatObject($_GET['ide']);
	if(isset($_GET['CNE'])){
		if(isset($_POST['note_devoir'])){
		 $travail->saisirNote($_POST['note_devoir'],$_GET['ide'],$_GET['CNE']);
	}

		$travailcne= $travail->afficher($_GET['ide'],$_GET['CNE']);
		$mr = $travail->afficherpersonne($_GET['CNE']);
}

	
}else{


header("location:./index.php?page=ClasseDevoir");


}


require_once './Vues/Enseignant_Devoirs rendus.php';


?>