<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

	<head>
		<title>Gestion De Classes</title>
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
	</head>

	<body>
        
        <section id="header_area">
			<?php require_once 'Etudiant_Menu_Profile.php'; ?>
		</section>
		
		<section id="content_area">
			<div class="clearfix wrapper main_content_area">
			
				<div class="clearfix main_content floatleft">
                
					<div class="content">
						<div class="content_title"><h2>Votre Recherche !</h2></div>
					</div>
                    
                    <?php  foreach($classetrouvee as $classe){ ?>
                    
                    <div style="border-top: 3px solid #CCC ; padding:20px;" class="clearfix content">
						<div class="clearfix single_content">
							<div class="clearfix post_date floatleft">
								<div class="date">
									<h3>C</h3>
								</div>
							</div>
							<div class="clearfix post_detail">
								<h2><a>Classe trouvée:</a></h2>
								<div class="clearfix post_excerpt">
									<pre>Nom du cours: <?php echo $classe['NOM_COURS'];?>

Semestre: <?php echo $classe['SEMESTRE'];?>

Année universitaire: <?php echo $classe['ANNEE_UNIV'];?>

Nom de la formation: <?php echo $classe['NOM_FORMATION'];?>

Enseignant responsable: <?php echo $classe['NOM_ENSEIGNANT']." ".$classe['PRENOM_ENSEIGNANT']; ?></pre><br>
								</div>
                                <a href=<?php echo "./index.php?page=EnvoyerDemande&idclasse=".$classe['ID_CLASSE']; ?> >Envoyer une demande</a>
							</div>
						</div>
								
					</div>
                    
                    <?php } ?>

				</div>
				<div class="clearfix sidebar_container floatright">
				    <?php require_once 'Etudiant_Sidebar_profile.php'; ?>
                    <div class="clearfix sidebar bottom"  id="travail">
                        <div class="clearfix single_sidebar">
                            <div class="popular_post contact_us">
                                <div class="sidebar_title"><h2>Rechercher une classe :</h2></div>
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
