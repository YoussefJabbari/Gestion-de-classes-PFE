<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    
	<head>
		<title>Gestion De Classes</title>
		<link href="Vues/css/pgwslider.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="Vues/css/font-awesome.min.css">
		<link href="Vues/css/style.css" rel="stylesheet" media="screen">	
		<link href="Vues/css/responsive.css" rel="stylesheet" media="screen">		

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!--Oswald Font -->
		<link href='Vues/css/Annonce.css' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="Vues/css/tooltipster.css" />
		<!-- home slider-->
		<link href="Vues/css/pgwslider.css" rel="sme.min.css">
		<link href="Vues/css/style.css" rel="stylesheet" media="screen">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="Vues/css/font-aweso">
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
				    <div class="content_title"><h2>Examens & Contrôles</h2></div>
                    <div class="clearfix table">
                        <table>
                            <tr>
                                <th>CNE</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Devoirs</th>
                                <th>Session normale</th>
                                <th>Session rattrapage</th>
                            </tr>
                        <?php    foreach($etudiants as $etudiant){ ?>
                            <tr>
                                <td><a href=<?php echo "./index.php?page=ClasseNotesExame&CNE=".$etudiant['CNE']; ?>><?php  echo $etudiant['CNE']; ?></a></td>
                                <td><?php  echo $etudiant['NOM_ETUDIANT']; ?></td>
                                <td><?php  echo $etudiant['PRENOM_ETUDIANT']; ?></td>
                                <td><?php  echo $etudiant['NOTE_DEVOIR']; ?></td>
                                <td><?php  echo $etudiant['NOTE_NORMAL']; ?></td>
                                <td><?php  echo $etudiant['NOTE_RATTRAPAGE']; ?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
				</div>
                
				<div class="clearfix sidebar_container floatright">
                    <?php require_once('Sidebar_Classe.php'); ?>
                    <?php 
                    if(isset($_GET['CNE'])){

                    	?>
                    <div class="clearfix sidebar bottom">
						<div class="clearfix single_sidebar">
							<div class="popular_post contact_us">
								<div class="sidebar_title"><h2>Etudiant :</h2></div>
                                <img src=<?php echo $mr['PHOTO_ETUDIANT']; ?> class="floatright" width="112px" height="112px">
								<ul>
									<li><a>
                                        <label>CNE: <?php echo $mr['CNE'];?></label><br>
                                        <label>Nom: <?php echo $mr['NOM_ETUDIANT']; ?></label><br>
                                        <label>Prenom: <?php echo $mr['PRENOM_ETUDIANT']; ?></label><br>
                                    </a></li>
                                    <li>
                                        <form action=<?php echo "./index.php?page=ClasseNotesExame&CNE=".$mr['CNE']; ?> method="post">
                                            <input type="number" name="note_normale" class="wpcf7number" placeholder="Session normale">
                                            <input type="number" name="note_rattrapage" class="wpcf7number" placeholder="Session rattrapage">
                                            <input type="number" name="note_controle" class="wpcf7number" placeholder="Note de contrôle">
                                            <input type="submit" name="inserer" class="wpcf7__submit" value="Insérer">
                                        </form>
                                    </li>
								</ul>
							</div>
				        </div>
					</div>
                    <?php }?>
                    
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
