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
			<?php require_once('Etudiant_Menu_Classe.php'); ?>
		</section>
		
		<section id="content_area">
			<div class="clearfix wrapper main_content_area">
			
				<div class="clearfix main_content floatleft">

					<div class="clearfix content">
						<div class="content_title"><h2>Annonces</h2></div>
						
<?php
$numbre=0;
foreach($lesAnnonces as $annonce){
$numbre++;
	}
if($numbre>0){

?>
                        
                      <?php  foreach($lesAnnonces as $annonce){   ?>
						<div class="clearfix single_content">
							<div class="clearfix post_date floatleft">
								<div class="date">
									<h3>A</h3>
								</div>
							</div>
							<div class="clearfix post_detail">
								<h2><a><?php echo $annonce['TITRE_ANNONCE'].":"; ?> </a></h2>
								<div class="clearfix post-meta">
									<p><span><i class="fa fa-user"></i> <?php echo $objetClasse->getNomCours(); ?></span> <span><i class="fa fa-clock-o"></i> <?php echo $annonce['DATE_ANNONCE']; ?></span> </p>
								</div>
								<div class="clearfix post_excerpt">
									<pre><?php echo $annonce['ANNONCE']; ?></pre><br>
								</div>
							</div>
						</div>
						
					<?php } ?>
				    <?php
                    			}else{
                                	?>
                        <h2 style="color: #222222;padding: 10px 20px;font-family: elephant;">Cette classe ne contient aucune annonce!</h2>

                        <?php
                                }
                        ?>
												
					</div>
				
				</div>
				<div class="clearfix sidebar_container floatright">
                    
                    <?php require_once('Sidebar_Classe.php'); ?>
				
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
