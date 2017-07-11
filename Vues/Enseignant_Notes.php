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
						<div class="clearfix single_content newsletter">
                            <form action="./index.php?page=CalculerNotes" method="post">
                                <legend class="legende">Calculer les notes:</legend><br>
                                <input type="number" name="pourcentage_examen" placeholder="Pourcentage de l'examen final"><br />
                                <input type="number" name="pourcentage_controle" placeholder="Pourcentage des contrôles"><br /> 
                                <input type="number" name="pourcentage_devoir" placeholder="Pourcentage des devoirs"><br /> 
                                <input type="number" name="pourcentage_assiduite"  placeholder="Pourcentage de l'assiduité"><br />
                                <input type="number" name="note_reference"  placeholder="Note de référence de l'assiduité"><br />
                                <input type="number" name="nbr_seance"  placeholder="Nombre de séances"><br />
                                
                                <input type="submit" class="floatright" value="Calculer"> <br /><br />
                            </form>
                        </div>
						
												
					</div>
					
				</div>
				<div class="clearfix sidebar_container floatright">
                    <?php require_once('Sidebar_Classe.php'); ?>
				</div>
			</div>
		</section>
		
		<?php
        require_once('Footer.php');
        ?> 
		
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

        <script src='Vues/jquery.js'></script>
		<script src="Vues/js/index.js"></script>
		
    </body>
</html>
