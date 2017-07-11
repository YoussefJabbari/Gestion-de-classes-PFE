<?php

require_once 'Modeles/BD/EvaluationBD.php';

require_once "Modeles/BD/EnseignantBD.php";

require_once 'Modeles/BD/ClasseBD.php';

require_once 'Modeles/BD/TravailBD.php';



$classe = new ClasseBD();
$enseignant = new EnseignantBD();
$objetEnseignant=$enseignant->getEnseignantObject($_SESSION['id_enseignant']);
$objetClasse=$classe->getClasseObject($_SESSION['id_classe']);

if(isset($_POST['pourcentage_devoir']) and isset($_POST['pourcentage_examen']) and isset($_POST['pourcentage_assiduite']) and isset($_POST['pourcentage_controle']))
{
    $classe = new ClasseBD();
    $classe->insertPourcentage($_POST['pourcentage_examen'],$_POST['pourcentage_controle'],$_POST['pourcentage_devoir'],$_POST['pourcentage_assiduite'],$_SESSION['id_classe']);
    
    if($_POST['pourcentage_assiduite']!=0)
    {
        if(!empty($_POST['note_reference']) and !empty($_POST['nbr_seance']))
        {
            $classe->insertInfoAssiduite($_POST['note_reference'], $_POST['nbr_seance'], $_SESSION['id_classe']);
        }
        else
        {
            require_once 'Vues/Enseignant_Notes.php';
            exit();
        }
    }
    
    
    // Calcul de la note d'assiduité
    if($_POST['pourcentage_assiduite']!=0)
    {
        $evaluation = new EvaluationBD();
        $etudiants = $evaluation->afficherEvaluation($_SESSION['id_classe']);
        
        foreach($etudiants as $etudiant)
        {
            $prassiduite = ($_POST['nbr_seance'] - $etudiant['NBRE_ABSENCE']) / $_POST['nbr_seance'];
            $noteassiduite = $prassiduite * $_POST['note_reference'];
            $evaluation1 = new EvaluationBD();
            $evaluation1->insertPresence($_SESSION['id_classe'], $etudiant['CNE'], $noteassiduite);
        }
    }
    
    //Calcul de la note des devoirs
    if($_POST['pourcentage_devoir']!=0)
    {
        $evaluation = new EvaluationBD();
        $etudiants = $evaluation->afficherEvaluation($_SESSION['id_classe']);
        
        foreach($etudiants as $etudiant)
        {
            
            $travail = new TravailBD();
            $devoirs = $travail->afficherNoteTravail($etudiant['CNE']);
            $nbr_devoirs = 0;
            $notedevoirs = 0;
            
            foreach($devoirs as $devoir)
            {
                $notedevoirs = $notedevoirs + $devoir['NOTE_DEVOIR'];
                $nbr_devoirs++;
            }
            $notedevoirs = $notedevoirs / $nbr_devoirs;
            
            $evaluation2 = new EvaluationBD();
            $evaluation2->insertNoteDevoir($_SESSION['id_classe'], $etudiant['CNE'], $notedevoirs);
            
        }
    }
    
    //Calcul de la note globale
    $evaluation = new EvaluationBD();
    $etudiants = $evaluation->afficherEvaluation($_SESSION['id_classe']);
    
    foreach($etudiants as $etudiant)
    {
        if($etudiant['NOTE_NORMAL'] >= 10)
        {
            $noteglobale = ($_POST['pourcentage_examen']/100)*$etudiant['NOTE_NORMAL'] + ($_POST['pourcentage_controle']/100)*$etudiant['NOTE_CONTROLE'] + ($_POST['pourcentage_devoir']/100)*$etudiant['NOTE_DEVOIR'] + ($_POST['pourcentage_assiduite']/100)*$etudiant['PRESENCE'];
        }
        else
        {
            $noteglobale = ($_POST['pourcentage_examen']/100)*$etudiant['NOTE_RATTRAPAGE'] + ($_POST['pourcentage_controle']/100)*$etudiant['NOTE_CONTROLE'] + ($_POST['pourcentage_devoir']/100)*$etudiant['NOTE_DEVOIR'] + ($_POST['pourcentage_assiduite']/100)*$etudiant['PRESENCE'];
        }
        $evaluation3 = new EvaluationBD();
        $evaluation3->insertNoteGlobale($_SESSION['id_classe'], $etudiant['CNE'], $noteglobale);
    }
    
    
require_once 'Modeles/ClasseExcel/PHPExcel.php';

$evaluationN = new EvaluationBD();
$etudids = $evaluationN->NotesDetailleesExcel($_SESSION['id_classe']);
$etudigs = $evaluationN->NotesGlobalesExcel($_SESSION['id_classe']);
$etudivs = $evaluationN->EtudiantsVExcel($_SESSION['id_classe']);
$etudirs = $evaluationN->EtudiantsRattExcel($_SESSION['id_classe']);
$etudins = $evaluationN->EtudiantsNVExcel($_SESSION['id_classe']);
    
    //Fichier 1
    
$objPHPExcelD = new PHPExcel();

$objPHPExcelD->getProperties()->setCreator("App:Gestion de classes")
							 ->setLastModifiedBy($_SESSION['id_enseignant'])
							 ->setTitle("Notes Detaillees")
							 ->setSubject("Notes Detaillees");

   $objPHPExcelD->setActiveSheetIndex(0)
                ->setCellValue('A1' , 'CNE')
                ->setCellValue('B1' , 'Nom')
                ->setCellValue('C1' , 'Prenom')
                ->setCellValue('D1' , 'Email')
                ->setCellValue('E1' , 'Note d\'assiduite')
                ->setCellValue('F1' , 'Note des devoirs')
                ->setCellValue('G1' , 'Note des controles')
                ->setCellValue('H1' , 'Note d\'examen-Normale')
                ->setCellValue('I1' , 'Note d\'examen-Rattrapage')
                ->setCellValue('J1' , 'Note globale');
    
$i = 2;
foreach($etudids as $ed)
{
   $objPHPExcelD->setActiveSheetIndex(0)
                ->setCellValue('A'.$i , $ed['CNE'])
                ->setCellValue('B'.$i , $ed['NOM_ETUDIANT'])
                ->setCellValue('C'.$i , $ed['PRENOM_ETUDIANT'])
                ->setCellValue('D'.$i , $ed['EMAIL_ETUDIANT'])
                ->setCellValue('E'.$i , $ed['PRESENCE'])
                ->setCellValue('F'.$i , $ed['NOTE_DEVOIR'])
                ->setCellValue('G'.$i , $ed['NOTE_CONTROLE'])
                ->setCellValue('H'.$i , $ed['NOTE_NORMAL'])
                ->setCellValue('I'.$i , $ed['NOTE_RATTRAPAGE'])
                ->setCellValue('J'.$i , $ed['NOTE_GLOBALE']);
    $i++;
}

$objPHPExcelD->setActiveSheetIndex(0);

$callStartTime = microtime(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcelD, 'Excel2007');
$objWriter->save('Telechargement/Notes/NotesDetaillees'.$_SESSION['id_classe'].'.xlsx');
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;
    
    
    //Fichier 2
    
$objPHPExcelG = new PHPExcel();

$objPHPExcelG->getProperties()->setCreator("App:Gestion de classes")
							 ->setLastModifiedBy($_SESSION['id_enseignant'])
							 ->setTitle("Notes Globales")
							 ->setSubject("Notes Globales");

   $objPHPExcelG->setActiveSheetIndex(0)
                ->setCellValue('A1' , 'CNE')
                ->setCellValue('B1' , 'Nom')
                ->setCellValue('C1' , 'Prenom')
                ->setCellValue('D1' , 'Email')
                ->setCellValue('E1' , 'Note globale');
    
$i = 2;
foreach($etudigs as $eg)
{
   $objPHPExcelG->setActiveSheetIndex(0)
                ->setCellValue('A'.$i , $eg['CNE'])
                ->setCellValue('B'.$i , $eg['NOM_ETUDIANT'])
                ->setCellValue('C'.$i , $eg['PRENOM_ETUDIANT'])
                ->setCellValue('D'.$i , $eg['EMAIL_ETUDIANT'])
                ->setCellValue('E'.$i , $eg['NOTE_GLOBALE']);
    $i++;
}

$objPHPExcelG->setActiveSheetIndex(0);

$callStartTime = microtime(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcelG, 'Excel2007');
$objWriter->save('Telechargement/Notes/NotesGlobales'.$_SESSION['id_classe'].'.xlsx');
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;
    
    
    //Fichier 3
    
$objPHPExcelV = new PHPExcel();

$objPHPExcelV->getProperties()->setCreator("App:Gestion de classes")
							 ->setLastModifiedBy($_SESSION['id_enseignant'])
							 ->setTitle("Validation")
							 ->setSubject("Validation");

    
    //Liste des étudiants ayant validé
    
   $objPHPExcelV->setActiveSheetIndex(0)
                ->setCellValue('A1' , 'Liste des etudiants ayant valide');
    
   $objPHPExcelV->setActiveSheetIndex(0)
                ->setCellValue('A2' , 'CNE')
                ->setCellValue('B2' , 'Nom')
                ->setCellValue('C2' , 'Prenom')
                ->setCellValue('D2' , 'Email');
    
$i = 3;
foreach($etudivs as $ev)
{
   $objPHPExcelV->setActiveSheetIndex(0)
                ->setCellValue('A'.$i , $ev['CNE'])
                ->setCellValue('B'.$i , $ev['NOM_ETUDIANT'])
                ->setCellValue('C'.$i , $ev['PRENOM_ETUDIANT'])
                ->setCellValue('D'.$i , $ev['EMAIL_ETUDIANT']);
    $i++;
}

    $i++;
    
    //Liste des étudiants convoqués en rattrapage 
    
   $objPHPExcelV->setActiveSheetIndex(0)
                ->setCellValue('A'.$i , 'Liste des etudiants convoques en rattrapage');
    
    $i++;
       
   $objPHPExcelV->setActiveSheetIndex(0)
                ->setCellValue('A'.$i , 'CNE')
                ->setCellValue('B'.$i , 'Nom')
                ->setCellValue('C'.$i , 'Prenom')
                ->setCellValue('D'.$i , 'Email');
    
$i++;
foreach($etudirs as $er)
{
   $objPHPExcelV->setActiveSheetIndex(0)
                ->setCellValue('A'.$i , $er['CNE'])
                ->setCellValue('B'.$i , $er['NOM_ETUDIANT'])
                ->setCellValue('C'.$i , $er['PRENOM_ETUDIANT'])
                ->setCellValue('D'.$i , $er['EMAIL_ETUDIANT']);
    $i++;
}
    $i++;
    
    
    //Liste des étudiants n'ayant pas validé
    
   $objPHPExcelV->setActiveSheetIndex(0)
                ->setCellValue('A'.$i , 'Liste des etudiants n\'ayant pas valide');
    
    $i++;
    
   $objPHPExcelV->setActiveSheetIndex(0)
                ->setCellValue('A'.$i , 'CNE')
                ->setCellValue('B'.$i , 'Nom')
                ->setCellValue('C'.$i , 'Prenom')
                ->setCellValue('D'.$i , 'Email');
    
$i++;
foreach($etudins as $en)
{
   $objPHPExcelV->setActiveSheetIndex(0)
                ->setCellValue('A'.$i , $en['CNE'])
                ->setCellValue('B'.$i , $en['NOM_ETUDIANT'])
                ->setCellValue('C'.$i , $en['PRENOM_ETUDIANT'])
                ->setCellValue('D'.$i , $en['EMAIL_ETUDIANT']);
    $i++;
}

$objPHPExcelV->setActiveSheetIndex(0);

$callStartTime = microtime(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcelV, 'Excel2007');
$objWriter->save('Telechargement/Notes/Validation'.$_SESSION['id_classe'].'.xlsx');
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;
    
    $zipFileS = "Telechargement/Notes/Resultats de calcul ".$_SESSION['id_classe'].".zip";
    $zipFile = "Resultats de calcul ".$_SESSION['id_classe'].".zip";
    $zipArchive = new ZipArchive();
    $zipArchive->open($zipFileS, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE);
    
    $files = array('Telechargement/Notes/NotesDetaillees'.$_SESSION['id_classe'].'.xlsx' , 'Telechargement/Notes/NotesGlobales'.$_SESSION['id_classe'].'.xlsx' , 'Telechargement/Notes/Validation'.$_SESSION['id_classe'].'.xlsx');
    $files_names = array('NotesDetaillees.xlsx','NotesGlobales.xlsx','Validation.xlsx');
    
    for($j = 0 ; $j < 3 ; $j++)
        {
            $zipArchive->addFile($files[$j],$files_names[$j]);
        }
    
    $zipArchive->close();
    
    header($_SERVER['SERVER_PROTOCOL'].' 200 OK');
    header('Content-Type: application/zip');
    header('Content-Transfer-Encoding: binary'); 
    header('Content-Disposition: attachment; filename="'.$zipFile.'"'); 
	  
    readfile($zipFileS);
    
    exit;
    
}
else
{
    require_once 'Vues/Enseignant_Notes.php';
}


?>