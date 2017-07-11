     
        <div class="clearfix sidebar">
            <div class="clearfix single_sidebar">
				<div class="popular_post">
				<div class="content_title"><h2><span class="glyphicon glyphicon-user"></span> Profile:</h2></div>
                <img src=<?php echo $objetEtudiant->getPhotoEtudiant(); ?> class="img-thumbnail" style="width:270px;height:255px;" class="img-responsive"/>
				<ul>
					<li><a>
                        <label>CNE: <?php echo $objetEtudiant->getCne();?></label><br>
                        <label>Nom: <?php echo $objetEtudiant->getNomEtudiant();?></label><br>
                        <label>Prénom: <?php echo $objetEtudiant->getPrenomEtudiant();?></label><br>
                        <label>Date de naissance: <?php echo $objetEtudiant->getDateEtudiant();?></label><br>
                        <label>Email: <?php echo $objetEtudiant->getEmailEtudiant();?></label><br>
                    </a></li>
				</ul>
                </div>
            </div>
        </div>    
   