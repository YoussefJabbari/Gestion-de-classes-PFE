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
            .newsletter form select{
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
						<div class="content_title"><h2>Documents</h2></div>
						<div class="clearfix single_content newsletter">
                              <form action="./index.php?page=ClasseDocument" method="post" enctype="multipart/form-data">
                                <legend class="legende">Ajouter un document:</legend>
                                <input type="text" name="titre_document" placeholder="Titre du document" required><br />
                                <label for="categorie">Catégorie:</label>
                                <select name="categorie">
                                    <option value="1">Cours</option>
                                    <option value="2">Exercice</option>
                                    <option value="3">Autre</option>
                                </select> <br />
                                <textarea  name="Description" placeholder="Description" required></textarea><br />
                                <input type="file" name="fichier" required/><br /><br />
                                <input type="submit" value="Ajouter"> <br /><br />
                            </form>
                        </div>
                        
<?php
$numbre=0;
foreach($documents as $doc){
$numbre++;
	}
if($numbre>0){

?>
                        
                        <div class="div clearfix work_pagination">
                        <ul class="tab-group">
                            <li class="tab active"><a  href="#affichageNormale">Affichage normale</a></li>
                            <li class="tab"><a  href="#affichageCategorie">Affichage par catégorie</a></li>
                        </ul>
                            
                        <div class="tab-content">
                            
                        <div id="affichageNormale">


                        <?php foreach($documents as $doc){ ?> 
						<div class="clearfix single_content">
							<div class="clearfix post_date floatleft">
								<div class="date">
									<h3>Dc</h3>
								</div>
							</div>
							<div class="clearfix post_detail">
								<h2><a href="">Titre :<?php echo $doc['TITRE_DOCUMENT']; ?> </a></h2>
								<div class="clearfix post-meta">
									<p><span><i class="fa fa-user"></i><?php echo $objetClasse->getNomCours(); ?></span> <span><i class="fa fa-clock-o"></i><?php echo $doc['DATE_DOCUMENT']; ?></span> </p>
								</div>

								<div class="clearfix post_excerpt">
						<pre>Type :   <?php echo $doc['NOM_CATEGORIE']."<br>"; ?></pre>
						<pre>Description: <?php echo $doc['DESCRIPTION']; ?></pre>

														</div>
                                <a href=<?php echo "./index.php?page=Documentselect&idDoc=".$doc['ID_DOCUMENT'] ?>>Accéder au document</a>
							</div>
						</div>
						<?php  } ?>
					
                        </div>
                        <div id="affichageCategorie" style="display:none;">
                            <div class="cours">   
                                <h1><?php echo "Cours:" ?></h1>
                 				<?php foreach($documents as $doc){ ?>
					

                               <?php	if($doc['ID_CATEGORIE']==1){ ?>
   							<div class="clearfix singlesidebar post_excerpt categoriee">
                                <h2><?php echo $doc['TITRE_DOCUMENT']; ?></h2>
                                <ul>
								    <li class="floatleft"><pre>Type :   <?php echo $doc['NOM_CATEGORIE']; ?>

Date :<?php echo $doc['DATE_DOCUMENT']; ?></pre><a href=<?php echo "./index.php?page=Documentselect&idDoc=".$doc['ID_DOCUMENT'] ?>>Accéder au document</a>                 </li>
                                    </ul>
                                 </div>
                                <?php } ?>
                            
                            <?php } ?>
                            </div>





                            <div class="cours">
                                <h1>Exercice:</h1>
                                <?php foreach($documents as $doc){ ?>
                                
                                <?php
                         	if($doc['ID_CATEGORIE']==2){
                               	?>
                               	<div class="clearfix singlesidebar post_excerpt categoriee">
                                <h2><?php echo $doc['TITRE_DOCUMENT']; ?></h2>
                                <ul>
								    <li class="floatleft"><pre>Type :   <?php echo $doc['NOM_CATEGORIE']; ?>

Date :<?php echo $doc['DATE_DOCUMENT']; ?></pre><a href=<?php echo "./index.php?page=Documentselect&idDoc=".$doc['ID_DOCUMENT'] ?>>Accéder au document</a>
                                    </li>
                                    </ul>
                                </div>
                                <?php } ?>
							<?php } ?>
							</div>



							<div class="cours">
                                <h1>Autre:</h1>
							<?php foreach($documents as $doc){ ?>
                                
                                	<?php if($doc['ID_CATEGORIE']==3){ ?>
                                	<div class="clearfix singlesidebar post_excerpt categoriee">
                                <h2><?php echo $doc['TITRE_DOCUMENT']; ?></h2>
                                <ul>
								    <li class="floatleft"><pre>Type :   <?php echo $doc['NOM_CATEGORIE']; ?>

Date :<?php echo $doc['DATE_DOCUMENT']; ?></pre><a href=<?php echo "./index.php?page=Documentselect&idDoc=".$doc['ID_DOCUMENT'] ?>>Accéder au document</a>                 </li>
                                    </ul>
                                    </div>
                                <?php } ?>
       							 <?php } ?>

								</div> 
                        </div>
                        </div>                        
						</div>
                        
                        <?php
                    			}else{
                                	?>
                        <h2 style="color: #222222;padding: 10px 20px;font-family: elephant;">Cette classe ne contient aucun document!</h2>

                        <?php
                                }
                        ?>
												
					</div>
					
				</div>
				<div class="clearfix sidebar_container floatright">
                    <?php require_once('Sidebar_Classe.php'); ?>
                    
                    <div class="clearfix sidebar">
						<div class="clearfix single_sidebar">
							<div class="popular_post">
								<div class="sidebar_title"><h2>Statistiques:</h2></div>
								<ul>
									<li><a>
                                        <label>Cours: <?php echo $statiquecour;?></label><br>
                                        <label>Exercices: <?php echo $statiquexercice;?></label><br>
                                        <label>Autres catégories: <?php echo $statiquautre;?></label><br>
                                        <label>Total: <?php echo $statiquautre+$statiquexercice+$statiquecour;?></label><br>
                                    </a></li>
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

        <script src='Vues/jquery.js'></script>
		<script src="Vues/js/index.js"></script>
        
        
	</body>
</html>
