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
			<?php require_once('Enseignant_Menu_Classe.php'); ?>
		</section>
		
		<section id="content_area">
			<div class="clearfix wrapper main_content_area">
                <form action="" method="post">
				<div class="clearfix main_content floatleft">
                    <div class="clearfix table">
                        <table class="">
                            <tr>
                                <th>CNE</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>N°h d'absence</th>
                                <th>Email</th>
                                <th>Date de naissance</th>
                            </tr>

                        <?php    foreach($etudiants AS $etudiant){ ?>
                            <tr class="div">
                                <td><?php  echo $etudiant['CNE']; ?></td>
                                <td><?php  echo $etudiant['NOM_ETUDIANT']; ?></td>
                                <td><?php  echo $etudiant['PRENOM_ETUDIANT']; ?></td>
                                <td><?php  echo $etudiant['NBRE_ABSENCE']; ?></td>
                                <td><?php  echo $etudiant['EMAIL_ETUDIANT']; ?></td>
                                <td><?php  echo $etudiant['DATE_ETUDIANT']; ?></td>
                            </tr>
                          <?php } ?>
                        </table>
                    </div>
			
				</div>
                
				<div class="clearfix sidebar_container floatright">
                    <?php require_once('Sidebar_Classe.php'); ?>
                    <div class="tab-contentt">
                    <div class="clearfix">
						<div class="clearfix single_sidebar">
							<div class="popular_post contact_us">
								<div class="sidebar_title"><h2>Ajouter un étudiant</h2></div><br>
                                <ul>
                                    <li>
                                        <form action=<?php echo "./index.php?page=ClasseEtudiant"; ?> method="post">
                                            <input style="width: 280px; height: 25px;" type="number" name="acne" placeholder="CNE" required><br>
                                            <input type="submit" name="ajouter_etudiant" class="floatright wpcf7__submit" value="Ajouter">
                                            
                                        </form>
                                    </li>
								</ul>
							</div>
				        </div>
					</div>
                    </div>
                    <div class="tab-contentt">
                    <div class="clearfix">
						<div class="clearfix single_sidebar">
							<div class="popular_post contact_us">
								<div class="sidebar_title"><h2>Supprimer un étudiant</h2></div>
                                <ul>
                                    <li>
                                        <form class="floatright" action=<?php echo "./index.php?page=ClasseEtudiant"; ?> method="post">
                                            <input style="width: 280px; height: 25px;" type="number" name="scne" placeholder="CNE" required><br>
                                            <input type="submit" name="supprimer_etudiant" class="floatright wpcf7__submit" value="Supprimer">
                                            
                                        </form>
                                    </li>
								</ul>
							</div>
				        </div>
					</div>
                    </div>
				</div>
                </form>
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
	
		<script type="text/javascript" src="Vues/js/placeholder_support_IE.js"></script>		
        <script src="js/index.js"></script>
 
	</body>
</html>
