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
            .newsletter form input[type=date]{
                width: 680px;
                height: 30px;
                margin-bottom: 15px;
                box-shadow: inset 0px 0px 50px 0px #CCCCCC;
                -webkit-box-shadow: inset 0px 0px 50px 0px #CCCCCC;
                -moz-box-shadow: inset 0px 0px 50px 0px #CCCCCC;
                -o-box-shadow: inset 0px 0px 50px 0px #CCCCCC;
                font-family: sans-serif;
                font-style: bold;
            }
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
						<div class="content_title"><h2>Devoirs</h2></div>
						<div class="clearfix single_content newsletter">


                        <form action="./index.php?page=ClasseDevoir" method="post">

                            <legend class="legende">Ajouter un devoir:</legend>

                            <input type="text" name="titre_devoir" placeholder="Titre du devoir " required><br />
                            <input type="text" name="format_demandee" placeholder="Formats demandées" required><br />
                            <label for="deadline">Dernier délai:</label><br>
                            <input type="date" name="deadline"  required><br /><br>
                            <textarea  name="enonce" placeholder="Enoncé" required></textarea><br />

                            <input type="submit" value="Ajouter"> <br /><br />
                            
                        </form>

                        </div>
                        
<?php
$numbre=0;
foreach($lesDevoirs as $devoir){
$numbre++;
	}
if($numbre>0){

?>                        
    
                        <?php foreach($lesDevoirs as $devoir){  ?>
						<div class="clearfix single_content">
							<div class="clearfix post_date floatleft">
								<div class="date">
									<h3>Dv</h3>
								</div>
							</div>
							<div class="clearfix post_detail">
								<h2><a href="">Titre :<?php echo $devoir['TITRE_DEVOIR']; ?> </a></h2>
								<div class="clearfix post-meta">
									<p><span><i class="fa fa-user"></i><?php echo $objetClasse->getNomCours(); ?></span> <span><i class="fa fa-clock-o"></i><?php echo $devoir['DATE_DEVOIR']; ?></span> </p>
								</div>
								<div class="clearfix post_excerpt">
									<p>Enoncé :<?php echo $devoir['ENONCE']; ?><br>
							Dernier delai:    <?php echo $devoir['DEADLINE']; ?><br>
								Formats demandées:<?php echo $devoir['TYPE_FORMAT']; ?></p>
								</div>
                                <a href=<?php echo "./index.php?page=ClasseDevoirRendu&ide=".$devoir['ID_DEVOIR']; ?>>Accéder aux devoirs rendus</a>
							</div>
						</div>
						<?php  } ?>
				
						<?php
                    			}else{
                                	?>
                        <h2 style="color: #222222;padding: 10px 20px;font-family: elephant;">Cette classe ne contient aucun devoir!</h2>

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
