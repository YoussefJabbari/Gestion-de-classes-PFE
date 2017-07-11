
        <div class="clearfix sidebar">
            <div class="clearfix single_sidebar">
				<div class="popular_post">
				<div class="content_title"><h2><span class="glyphicon glyphicon-user"></span> Profile:</h2></div>
                <img src=<?php echo $objetEnseignant->getPhotoEnseignant(); ?> class="img-thumbnail" style="width:270px;height:255px;" class="img-responsive" alt="Responsive image"/>
				<ul>
					<li><a>
                        <label>Nom: <?php echo $objetEnseignant->getNomEnseignant();?></label><br>
                        <label>Prénom: <?php echo $objetEnseignant->getPrenomEnseignant();?></label><br>
                        <label>Date de naissance: <?php echo $objetEnseignant->getDateEnseignant();?></label><br>
                        <label>Email: <?php echo $objetEnseignant->getEmailEnseignant();?></label><br>
                    </a></li>
				</ul>
                </div>
            </div>
        </div>
   