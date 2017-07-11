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
			<?php require_once('Enseignant_Menu_Classe.php'); ?>
		</section>
		
		<section id="content_area">
			<div class="clearfix wrapper main_content_area">
			
				<div class="clearfix main_content floatleft">
				
					
					<div class="clearfix content">
						
						<h1>Titre :<?php echo $document1['TITRE_DOCUMENT']; ?> </h1>
						<div class="clearfix post-meta">
							<p><span><i class="fa fa-user"></i><?php echo $objetClasse->getNomCours(); ?></span> <span><i class="fa fa-clock-o"></i><?php echo $document1['DATE_DOCUMENT']; ?></span> </p>
						</div>
						
						<div class="clearfix post_excerpt categoriee">
									<pre>Type :   <?php if($document1['ID_CATEGORIE']==1)
									{
										echo "Cours";
										}else{
											if($document1['ID_CATEGORIE']==2){
												echo "Exercice";
											}else {
												echo "Autre";
											}
											}; ?>
<br>Description: <?php echo $document1['DESCRIPTION']; ?>
</pre><br>
				        </div>
						
						<div class="more_post_container">
							<h2>Versions:</h2>
							<div class="more_post">
                                
                                
                                <?php if($versions!=false){foreach($versions as $version1){?>
                                <span><label><?php echo substr($version1['URL_VERSION'],-14)." ".$version1['DATE_MISE']; ?></label></span><br>

                                <?php } } ?>
                              
                                
							</div>
						</div>	
                        <br/>
                        <div class="more_post_container contact_us">
							<h2>Ajouter une autre version:</h2>
							<form action=<?php echo "./index.php?page=Documentselect&idDoc=".$_GET['idDoc'] ?> method="post" enctype="multipart/form-data" >
                                <div class="more_post">
                                <input   type="file" name="fichier" required/><br> 
                                </div>
                                <input type="submit" class="wpcf7submit" value="Ajouter" />
                            </form>
						</div>	
                        
					</div><br><br>
					
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
