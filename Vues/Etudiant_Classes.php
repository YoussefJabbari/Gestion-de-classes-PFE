<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

	<head>
		<title>Gestion De Classes</title>
		<link rel="stylesheet" href="Vues/bootstrap/css/bootstrap.css"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!--Oswald Font -->
		<link href='Vues/css/Annonce.css' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="Vues/css/tooltipster.css" />
		<!-- home slider-->
		<link href="Vues/css/pgwslider.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="Vues/css/font-awesome.min.css">
		<link href="Vues/css/style.css" rel="stylesheet" media="screen">	
		<link href="Vues/css/responsive.css" rel="stylesheet" media="screen">	
        <style>
            th{background-color: #222222;
                color:white;
                font-family: monospace;
            }
            tr:nth-child(even){background-color: #f2f2f2}

        </style>
        
	</head>
    
	<body>
        
        <section id="header_area">
			<?php require_once 'Etudiant_Menu_Profile.php'; ?>
		</section>
		
		<section id="content_area">
			<div class="clearfix wrapper main_content_area">
			
				<div class="clearfix main_content floatleft">
                
					<div class="content">
						<div class="content_title"><h2><span class="glyphicon glyphicon-home"></span> Vos classes</h2></div>
                        
<?php
$numbre=0;
foreach($lesClasses as $class){
$numbre++;
	}
if($numbre>0){

?>
                        
                        <div class="clearfix table">
                            <table>
                                <tr>
                                    <th>Nom du cours</th>
                                    <th>Nom de la formation</th>
                                    <th>Semestre</th>
                                    <th>Année scolaire</th>
                                </tr>
                             <?php  foreach($mesClasses as $class){ 

                            $objetClasse=$classe->getClasseObject($class['ID_CLASSE']);

            	echo "<tr><td><a href=\"index.php?page=EtudiantAnnonces&idClasse=".$objetClasse->getIdClasse()."\">".$objetClasse->getNomCours()."</a></td><td><a href=\"index.php?page=EtudiantAnnonces&idClasse=".$objetClasse->getIdClasse()."\">".$objetClasse->getNomFormation().'</a></td><td>'.$objetClasse->getSemestre().'</td><td>'.$objetClasse->getAnnee_Univ()."</td></tr>";
    
                                } ?>
                            </table>
                        </div>
                        
                        <?php
                    			}else{
                                	?>
                                	<h2 style="color: #222222;padding: 10px 20px;font-family: elephant;">Vous n'avez aucune classe!</h2>

                                	<?php
                                }
                                ?>
                        
                        <br /> <br />  
					</div>
				
				</div>
				<div class="clearfix sidebar_container floatright">
				    <?php require_once 'Etudiant_Sidebar_profile.php'; ?>
                    <div class="clearfix sidebar bottom"  id="travail">
                        <div class="clearfix single_sidebar">
                            <div class="popular_post contact_us">
                                <div class="sidebar_title"><h2><span class="glyphicon glyphicon-search"></span> Rechercher une classe :</h2></div>
                                <ul>
                                    <li>
                                        <form action="./index.php?page=RechercherClasseControlleur" method="post">
                                            <input type="text" name="nom_cours" class="wpcf7__number" placeholder="Nom du cours">
                                            <input type="text" name="semestre" class="wpcf7__number" placeholder="Semestre">
                                            <input type="text" name="annee_univ" class="wpcf7__number" placeholder="Année universitaire">
                                            <input type="text" name="nom_formation" class="wpcf7__number" placeholder="Nom de la formation"><br>
                                            <input type="submit" name="rechercher" class="floatright wpcf7__submit" value="Rechercher">
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</section>
		
		<?php require_once('Footer.php'); ?>
        		
		<script type="text/javascript" src="Vues/js/jquery.js"></script>	
		<script type="text/javascript" src="Vues/js/jquery.tooltipster.min.js"></script>		
		<script type="text/javascript">
			$(document).ready(function() {
				$('.tooltip').tooltipster();
			});
		</script>
		 <script type="text/javascript" src="Vues/js/selectnav.min.js"></script>
		<script type="text/javascript">
			selectnav('nav', {
			  label: '-Navigation-',
			  nested: true,
			  indent: '-'
			});
		</script>		
		<script src="Vues/js/pgwslider.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('.pgwSlider').pgwSlider({
					
					intervalDuration: 5000
				
				});
			});
		</script>
		<script type="text/javascript" src="Vues/js/placeholder_support_IE.js"></script>
		
	</body>
</html>
