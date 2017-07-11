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
                color:#FFF;
                font-family: sans-serif;
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
			
				<div class="clearfix main_content floatleft">
				
					<div class="clearfix content">
						
						<h1>Titre: <?php echo $objetDevoir->getTitre(); ?> </h1>
						<div class="clearfix post-meta">
							<p><span><i class="fa fa-user"></i><?php echo $objetClasse->getNomCours(); ?></span> <span><i class="fa fa-clock-o"></i><?php echo $objetDevoir->getDateDevoir(); ?></span> </p>
						</div>
						
						<div class="clearfix post_excerpt categoriee">
									<pre>Enoncé :<?php echo $objetDevoir->getEnonce(); ?>

			 
Dernier delai:    <?php echo $objetDevoir->getDeadLine(); ?>

Formats demandées:<?php echo $objetFormat->getTypeFormat(); ?></pre><br>
				        </div>
						
					</div><br><br>
                    <div class="clearfix table">
                        <table>
                            <tr>
                                <th>CNE</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Travail</th>
                         
                            </tr><?php
                            foreach($etudiantTravail AS $etudiant ){ ?>
                            <tr>
                                <td><?php echo $etudiant['CNE']; ?></td>
                                <td><?php echo $etudiant['NOM_ETUDIANT']; ?></td>
                                <td><?php echo $etudiant['PRENOM_ETUDIANT']; ?></td>
                                <td><a href=<?php echo "./index.php?page=ClasseDevoirRendu&ide=".$_GET['ide']."&CNE=".$etudiant['CNE']; ?>>Travail</a></td>
                                
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
                    <div  class="tab-contentt">
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

                                    <?php $i=0;
                                    foreach ($travailcne as $value) {
                                    	$i++;
                                    	
                                 ?>
                                    <li><a href=<?php echo $value['URL_TRAVAIL']; ?>><label><?php echo"Travail".$i; ?></label><br></a></li>
                                   <?php } ?>
                                        <form action=<?php echo "./index.php?page=ClasseDevoirRendu&ide=".$_GET['ide']."&CNE=".$mr['CNE']; ?> method="post">
                                            <input type="number" name="note_devoir" class="wpcf7number" >
                                            <input type="submit" name="inserer" class="wpcf7__submit" value="Ajouter">
                                        </form>
                                    </li>
								</ul>
							</div>
				        </div>
					</div>
                    </div>
                    <?php }?>
                    
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
