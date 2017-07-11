
<?php
require_once 'Modeles/BD/ClasseBD.php';
require_once 'Modeles/BD/AnnonceBD.php';
require_once 'Modeles/BD/PublierBD.php';

require_once 'Modeles/BD/EtudiantBD.php';
require_once 'Modeles/BD/ClasseBD.php';


$etudiant = new EtudiantBD();
$objetEtudiant=$etudiant ->getEtudiantObject($_SESSION['CNE']);

$annonces = new AnnonceBD();
$classe = new ClasseBD();

if(isset($_GET['idClasse']) )
{	
		$_SESSION['id_classe']=$_GET['idClasse'];
		header('location:./index.php?page=EtudiantAnnonces');

}else{

	if(isset($_SESSION['id_classe'])){

	$objetClasse=$classe->getClasseObject($_SESSION['id_classe']);
	$lesAnnonces=$annonces->AfficherAnnonce($_SESSION['id_classe']);
	
	require_once 'Vues/Etudiant_Annonces.php';

	}



}





?>