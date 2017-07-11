<?php

require_once 'Modeles/BD/ClasseBD.php';
require_once 'Modeles/BD/DevoirBD.php';
require_once 'Modeles/BD/FormatBD.php';
require_once 'Modeles/BD/EtudiantBD.php';
require_once 'Modeles/BD/TravailBD.php';


	if(isset($_SESSION['id_classe'])){

	$etudiant = new EtudiantBD();
	$objetEtudiant=$etudiant ->getEtudiantObject($_SESSION['CNE']);

	$classe = new ClasseBD();

	$objetClasse=$classe->getClasseObject($_SESSION['id_classe']);
	$devoirs= new DevoirBD();
	$lesDevoirs=$devoirs->AfficherDevoir($_SESSION['id_classe']);



	if(isset($_GET['idDev'])){

		if(!($_FILES['fichier']['error'] > 0)){

		$travail = new TravailBD();
		$ajou=$travail->addTravail($_GET['idDev'],$_SESSION['CNE'],'fichier');
		if($ajou==true)
        {
            header('location:./index.php?page=EtudiantDevoirs');
		}else{?>
			  <script> 
   			window.alert('Format ou Deadline non respecté!');
  			</script>
  			<?php
		}

	}

	}




	require_once 'Vues/Etudiant_Devoirs.php';

	}





?>