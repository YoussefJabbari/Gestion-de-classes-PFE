<?php

require_once "Modeles/BD/EnseignantBD.php";
require_once "Modeles/BD/EtudiantBD.php";
require_once "Modeles/BD/ClasseBD.php";

//la verification pour l'utilisateur

if(isset($_POST['email']) AND isset($_POST['password'])){



	$enseignant = new EnseignantBD();
	$_SESSION['id_enseignant']=$enseignant->valide($_POST['email'],$_POST['password']);
	if($_SESSION['id_enseignant']!=0)
	{
		
	header('location:./index.php?page=CreerClasseControlleur');


	}else{
		session_destroy();
		session_start();
		$etudiant = new EtudiantBD();
		$_SESSION['CNE']=$etudiant->valide($_POST['email'],$_POST['password']);
		if($_SESSION['CNE']!=0){

			header('location:./index.php?page=EtudiantClasse');

		}else{

			session_destroy();
			header('location:./index.php?page=HomeControlleur');
		}
	}
}else{

	session_destroy();
	header('location:./index.php?page=HomeControlleur');


}


?>