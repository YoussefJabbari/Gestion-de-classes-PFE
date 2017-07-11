<?php

require_once 'Modeles/BD/ClasseBD.php';

require_once 'Modeles/BD/EtudiantBD.php';
require_once 'Modeles/BD/ClasseBD.php';


$etudiant = new EtudiantBD();
$objetEtudiant=$etudiant ->getEtudiantObject($_SESSION['CNE']);

$classe = new ClasseBD();
$mesClasses = $classe->lesCLassesEtudiant($_SESSION['CNE']);

if(!empty($_POST['nom_cours']) or !empty($_POST['semestre']) or !empty($_POST['annee_univ']) or !empty($_POST['nom_formation'])){

	$classetrouvee = $classe->rechercherclasse($_SESSION['CNE'],$_POST['nom_cours'],$_POST['semestre'],$_POST['annee_univ'],$_POST['nom_formation']);
    
    require_once ('Vues/Etudiant_Classes_Trouvees.php');
	
}else{

	header('location:./index.php?page=EtudiantClasse');
}



?>