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


if(isset($_POST['acne'])){


if($etud->existe($_POST['acne']))
{
	if(!$etud->dejaExiste($_POST['acne'],$_SESSION['id_classe']))
	{

		$evaluation-> add_etudiant($_SESSION['id_classe'], $_POST['acne']);
		header('location:./index.php?page=ClasseEtudiant');

	}else{
?>
	<script type="text/javascript"> window.alert("Cet étudiant est déjà ajouté à cette classe! ");
	</script>
<?php
	}

}else{

?>
	<script type="text/javascript"> window.alert("Ce CNE n'existe pas!");
	</script>

<?php

}

}


if(isset($_POST['scne'])){


if($etud->existe($_POST['scne']))
{
	if($etud->dejaExiste($_POST['scne'],$_SESSION['id_classe']))
	{

		$evaluation-> remove_etudiant($_SESSION['id_classe'], $_POST['scne']);
		header('location:./index.php?page=ClasseEtudiant');

	}else{
?>
	<script type="text/javascript"> window.alert("Cet étudiant n'appartient pas à cette classe! ");
	</script>
<?php
	}

}else{

?>
	<script type="text/javascript"> window.alert("Ce CNE n'existe pas!");
	</script>

<?php

}


}



require_once 'Vues/Enseignant_Etudiants.php';

?>