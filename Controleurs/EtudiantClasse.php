<?php

require_once 'Modeles/BD/EtudiantBD.php';
require_once 'Modeles/BD/ClasseBD.php';


$etudiant = new EtudiantBD();
$objetEtudiant=$etudiant ->getEtudiantObject($_SESSION['CNE']);

$classe = new ClasseBD();
$mesClasses = $classe->lesCLassesEtudiant($_SESSION['CNE']);
$lesClasses = $classe->lesCLassesEtudiant($_SESSION['CNE']);

require_once 'Vues/Etudiant_Classes.php';

?>