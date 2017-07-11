<?php

require_once "Modeles/BD/EnseignantBD.php";
require_once "Modeles/BD/EtudiantBD.php";
require_once 'Modeles/BD/ClasseBD.php';




	if(isset($_POST['nom']) AND isset($_POST['prenom']) AND isset($_POST['dateNaissance']) AND isset($_POST['user']) AND isset($_POST['password']) AND isset($_POST['email']))
	{


		//si l'utilisateur est un enseignant
		if($_POST['user'] == "enseignant" )
		{
			try{

				if(!($_FILES['photo']['error'] > 0)){
				$enseignant = new EnseignantBD();
				$enseignant->add($_POST['nom'],$_POST['prenom'],$_POST['password'],$_POST['email'],$_POST['dateNaissance'],'photo');
				$_SESSION['id_enseignant']=$enseignant->valide($_POST['email'],$_POST['password']);
				
				header('location:./index.php?page=CreerClasseControlleur');
				}

			}
			catch( PDOException $e )
			{
				$erreur = 'email existant';
				require_once 'Vues/Home.php';
			}
		}
		
		else
		{

			try{

				if(!($_FILES['photo']['error'] > 0)){
				$etudiant = new EtudiantBD();
				$etudiant->add($_POST['cne'],$_POST['nom'],$_POST['prenom'],$_POST['password'],$_POST['email'],$_POST['dateNaissance'],'photo');
				$etudiant->valide($_POST['email'],$_POST['password']);
				
				header('location:./index.php?page=EtudiantClasse');
				}

			}
			catch( PDOException $e )
			{
				$erreur = 'cne ou bien email existant';
				require_once 'Vues/Home.php';
			}
		}

	}




?>
