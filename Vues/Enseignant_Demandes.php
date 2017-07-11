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
			<?php require_once('Enseignant_Menu_Profile.php'); ?>
		</section>
		
		<section id="content_area">
			<div class="clearfix wrapper main_content_area">
			
				<div class="clearfix main_content floatleft">
                    
					<div class="content">
                         <div class="content_title"><h2>Demandes des étudiants</h2></div>
                        
<?php
$numbre=0;
foreach($lesdemandes as $demande){
$numbre++;
	}
if($numbre>0){

?>

<?php foreach ($lesdemandes as $demande) { ?>


							<div class="clearfix single_content">
							<div class="clearfix post_date floatleft">
                                 <img width="100px" src=<?php echo "\"".$demande['PHOTO_ETUDIANT']."\""; ?> >
							</div>
							<div class="clearfix post_detail">
								<h2><a href=""><?php echo $demande['NOM_ETUDIANT']." ".$demande['PRENOM_ETUDIANT']; ?> </a></h2>
								<div class="clearfix post-meta">
									<p><span><i class="fa"></i>Classe demandée :</span></p>
								</div>
							<div class="clearfix post_excerpt">
					<p>Nom du cours        : <?php echo $demande['NOM_COURS']; ?><br>

				Semestre            : <?php echo $demande['SEMESTRE']; ?><br>

				Année universitaire : <?php echo $demande['ANNEE_UNIV']; ?><br>

				Nom de la formation : <?php echo $demande['NOM_FORMATION']; ?></p><br>
								</div>
                                <span><a href=<?php echo "./index.php?page=DemandeDesEtudiant&CNE=".$demande['CNE']."&classeid=".$demande['ID_CLASSE']."&etat=Ajouter"; ?> >Ajouter</a></span>
                                <span><a href=<?php echo "./index.php?page=DemandeDesEtudiant&CNE=".$demande['CNE']."&classeid=".$demande['ID_CLASSE']."&etat=Refuser"; ?> >Refuser</a></span>
                                
							</div>

  						 <div class="pagination">
                            <nav>
                            </nav>
                        </div>	
                         </div>
				        <div class="pagination">
                            <nav>
                            </nav>
                        </div>	
                     			
							<?php  } ?>
				       		
                        <?php
                    			}else{
                                	?>
                                	<h2 style="color: #222222;padding: 10px 20px;font-family: elephant;">Vous n'avez aucune demande!</h2>

                                	<?php
                                }
                                ?>
                        
					</div>
					
				</div>
				<div class="clearfix sidebar_container floatright">
                    <?php require_once('Enseignant_Sidebar_Profile.php'); ?>
				</div>
			</div>
		</section>
		
		<?php require_once('Footer.php'); ?>
		
		<script type="text/javascript" src="Vues/jquery.js"></script>	
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
