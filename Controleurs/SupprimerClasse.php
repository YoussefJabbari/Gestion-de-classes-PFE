<?php
require_once "Modeles/BD/EnseignantBD.php";
require_once 'Modeles/BD/ClasseBD.php';


$classe = new ClasseBD();
$enseignant = new EnseignantBD();
$objetEnseignant=$enseignant ->getEnseignantObject($_SESSION['id_enseignant']);

if(isset($_GET['idClasse'])){

$classe->delete($_GET['idClasse']);

header('location:./index.php?page=SupprimerClasse');

}


$les_Classes = $classe->lesClasses($objetEnseignant->getIdEnseignant());
require_once 'Vues/Enseignant_Classes.php';



?>