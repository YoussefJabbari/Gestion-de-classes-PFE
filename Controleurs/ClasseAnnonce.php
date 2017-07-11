<?php
require_once 'Modeles/BD/ClasseBD.php';
require_once 'Modeles/BD/AnnonceBD.php';
require_once 'Modeles/BD/PublierBD.php';


$annonces = new AnnonceBD();
$classe = new ClasseBD();
if(isset($_GET['idClasse']) )
{	
		$_SESSION['id_classe']=$_GET['idClasse'];
		header('location:./index.php?page=ClasseAnnonce');

}else{

	if(isset($_SESSION['id_classe'])){

	$objetClasse=$classe->getClasseObject($_SESSION['id_classe']);

	if(isset($_POST['annonce']) AND isset($_POST['titre_annonce']))
	{
		$idannonce=$annonces->addAnnonce($_SESSION['id_classe'],$_SESSION['id_enseignant'],$_POST['annonce'],$_POST['titre_annonce']);
		$publier = new PublierBD();
	    $publier->add($_SESSION['id_classe'],$idannonce);
	    header('location:./index.php?page=ClasseAnnonce');
	}

	$lesAnnonces=$annonces->AfficherAnnonce($_SESSION['id_classe']);
	require_once 'Vues/Enseignant_Annonces.php';

	}
}





?>