<?php
require_once 'Modeles/BD/EtudiantBD.php';
require_once 'Modeles/BD/EvaluationBD.php';
require_once "Modeles/BD/EnseignantBD.php";
require_once 'Modeles/BD/ClasseBD.php';


$evaluation = new EvaluationBD();
$classe = new ClasseBD();
$enseignant = new EnseignantBD();
$objetEnseignant=$enseignant ->getEnseignantObject($_SESSION['id_enseignant']);
$objetClasse=$classe->getClasseObject($_SESSION['id_classe']);

$etud = new EtudiantBD();
$etudiants=$etud->afficherLesEtudiants($_SESSION['id_classe']);

if(isset($_GET['CNE']))
{
    $eva = $evaluation->afficherEtudiant($_GET['CNE'], $_SESSION['id_classe']);
    
    if(!empty($_POST['note_normale']))
    {
        $evaluation->updateNormal($_SESSION['id_classe'],$_GET['CNE'],$_POST['note_normale']);
	}
    if(!empty($_POST['note_rattrapage']))
    {
        if($eva['NOTE_NORMAL'] < 10)
        {
            $evaluation->updateRatt($_SESSION['id_classe'],$_GET['CNE'],$_POST['note_rattrapage']);
        }
        else
        {?>
            <script type="text/javascript"> window.alert("Cet étudiant a plus que 10 dans la session normale!"); </script>
        <?php }
	}
    if(!empty($_POST['note_controle']))
    {
        $evaluation->updatecontrole($_SESSION['id_classe'],$_GET['CNE'],$_POST['note_controle']);
	}

	$mr = $evaluation->afficherpersonne($_GET['CNE']);
}

require_once 'Vues/Enseignant_Exams_controles.php';

?>