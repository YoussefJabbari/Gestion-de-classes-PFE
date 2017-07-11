<!DOCTYPE html>
<html >
    
    <head>
        <meta charset="UTF-8">
        <title>Gestion de classes</title>
    
        <link rel="stylesheet" href="Vues/css/reset.css">
        <link rel='stylesheet prefetch' href='Vues/css/Home.css'>
        <link rel='stylesheet prefetch' href='Vues/css/home2.css'>
        <link rel='stylesheet prefetch' href='Vues/css/home3.css'>
        <link rel="stylesheet" href="Vues/css/test.css">
      
        <script>
            function uenseignant() {
                document.getElementById('ifetudiant').style.display = "none";
            }
            function uetudiant() {
                document.getElementById('ifetudiant').style.display = "block";
            }
        </script>
        <style>
            body{ background-image: url('Amphi-Ulg.jpg');}
        </style>
    </head>

    <body>
        <div class="container">
            <div class="info">
                <h1>Gestion de classes</h1>
            </div>
        </div>
        <div class="form" style=" background: rgba(255, 250, 235, 0.6)" >
            <div class="thumbnail" style="background: rgba(255, 197, 0, 0.85)"><img src="Vues/images/hat.svg"/></div>

            <!-- formulaire de l'inscription  -->
            <form action="./index.php?page=InscriptionControlleur" method="post" class="register-form" enctype="multipart/form-data">
                <input name="nom" type="text" placeholder="Nom" required/>
                <input name="prenom" type="text" placeholder="Prénom" required/>
                <input name="dateNaissance" type="date" placeholder="Date de naissance" required/>
                <input name="user" type="radio" onclick="uenseignant()" id="tenseignant" value="enseignant" required/>Enseignant
                <input name="user" type="radio" onclick="uetudiant()" id="tetudiant" value="etudiant" required/>Etudiant
                <div id="ifetudiant" style="display: none;"><input name="cne" type="text" placeholder="CNE"/></div>
                <input name="email" type="email" placeholder="Adresse mail" required/>
                <input name="password" type="password" placeholder="Mot de passe" required/>
                <label for="photo" style="float: left;">Photo d'identité:</label>
                <input name="photo" type="file" accept="image/*" required/>
                <button>create</button>
                <p class="message">Déjà inscrit? <a href="#">S'authentifier</a></p>
            </form>
  
 <!-- formulaire de authentification -->
            <form action="./index.php?page=LoginControlleur" method="post" class="login-form">
                <input name="email" type="email" placeholder="Adresse mail" required/>
                <input name="password" type="password" placeholder="Mot de passe" required/>
                <button>login</button>
                <p class="message">Vous n'êtes pas inscrits? <a href="#">Créez un compte</a></p>
            </form>
        </div>

    <script src='Vues/js/Ajax.js'></script>
    <script src="Vues/js/dynamic.js"></script>

  <?php if( isset($erreur) ){ ?>

  <script> 
    $('form').animate({height: "toggle", opacity: "toggle"}, "fast");
    alert('<?php echo $erreur; ?>');
  </script>

  <?php } ?>
    
  </body>
</html>
