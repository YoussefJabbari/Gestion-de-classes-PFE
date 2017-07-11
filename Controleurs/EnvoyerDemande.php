<?php

require_once 'Modeles/BD/DemandeBD.php';
require_once 'Modeles/BD/ClasseBD.php';

$demande = new DemandeBD();

$demande->envoyerdemande($_SESSION['CNE'],$_GET['idclasse']);

header('location:./index.php?page=EtudiantClasse');

?>