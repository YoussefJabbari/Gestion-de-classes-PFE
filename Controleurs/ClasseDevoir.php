<?php

require_once 'Modeles/BD/ClasseBD.php';
require_once 'Modeles/BD/DevoirBD.php';
require_once 'Modeles/BD/FormatBD.php';


	$classe = new ClasseBD();
	$devoirs= new DevoirBD();
	$objetClasse=$classe->getClasseObject($_SESSION['id_classe']);
	
	if(isset($_POST['titre_devoir']) AND isset($_POST['enonce']) AND isset($_POST['deadline']) AND isset($_POST['format_demandee']))
	{
		
		$iddevoir=$devoirs->addDevoir($_SESSION['id_classe'] ,$_POST['titre_devoir'] ,$_POST['enonce'] ,$_POST['deadline']);
		$format = new FormatBD();
	    $format->add($iddevoir,$_POST['format_demandee']);
	    header('location:./index.php?page=ClasseDevoir');

	}
	
	
	$lesDevoirs=$devoirs->AfficherDevoir($_SESSION['id_classe']);
	require_once 'Vues/Enseignant_Devoirs.php';

?>