<?php

require_once 'Modeles/BD/EvaluationBD.php';

require_once "Modeles/BD/EnseignantBD.php";

require_once 'Modeles/BD/ClasseBD.php';

require_once 'Modeles/BD/TravailBD.php';



$classe = new ClasseBD();
$enseignant = new EnseignantBD();
$objetEnseignant=$enseignant->getEnseignantObject($_SESSION['id_enseignant']);
$objetClasse=$classe->getClasseObject($_SESSION['id_classe']);


require_once 'Vues/Enseignant_Notes.php';


?>