<?php
session_start();
ob_start();

$acl_enseignant = array('CreerClasseControlleur',
						'LoginControlleur',
						'DemandeDesEtudiant',
						'ClasseDevoir',
						'ClasseDocument',
						'ClasseAssiduite',
						'ClasseNotes',
						'ClasseEtudiant',
						'ClasseNotesExame',
						'ClasseAnnonce',
						'SupprimerClasse',
						'RechercherClasseControlleur',
						'ClasseNotes',
                        'CalculerNotes',
						'DevoirRendu',
						'DeconnecteControlleur',
						'Documentselect',
						'ClasseDevoirRendu');

$acl_etudiant = array('LoginControlleur',
				      'EtudiantClasse',
				      'EtudiantAccepter',
				      'EtudiantAnnonces',
                      'EnvoyerDemande',
				      'EtudiantDevoirs',
				      'EtudiantDocuments',
				      'DeconnecteControlleur',
				      'RechercherClasseControlleur');



if(!empty($_GET['page']) AND is_file('Controleurs/'.$_GET['page'].'.php'))
{
		

		if(isset($_SESSION['id_enseignant']))
		{	

			if (in_array($_GET['page'], $acl_enseignant)) 
			{
				require_once 'Controleurs/'.$_GET['page'].'.php';

		    }else{

			 header('location:./index.php?page=CreerClasseControlleur');

			}

		}

		if(isset($_SESSION['CNE']))
		{

			if (in_array($_GET['page'], $acl_etudiant)) 
			{
				require_once 'Controleurs/'.$_GET['page'].'.php';
		    }else{

				header('location:./index.php?page=EtudiantClasse');
			}
		}

		if($_GET['page']=='LoginControlleur' OR $_GET['page']=='InscriptionControlleur'){
			
			require_once 'Controleurs/'.$_GET['page'].'.php';

		}else{

			if(!isset($_SESSION['id_enseignant']) AND !isset($_SESSION['CNE'])){

			require_once 'Controleurs/HomeControlleur.php';

			}
		}
	


}else{

	if(isset($_SESSION['id_enseignant']))
	{	
		header('location:./index.php?page=CreerClasseControlleur');

	}else{

		if(isset($_SESSION['CNE']))
		{

		header('location:./index.php?page=EtudiantClasse');

		}else{

			require_once 'Controleurs/HomeControlleur.php';
		}
	}
	
}

?>


	
		
		