<?php
session_start();




?>
<!DOCTYPE html>

<html lang="en">


<?php 

    require_once("head.html");
    
    ?>

  <main>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.php" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">i Manger Mieux</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Se connecter à votre compte</h5>
                    <p class="text-center small">Entrez votre email et mot de passe pour vous connecter</p>
                  </div>

                  <form id=loginForm   method="post"  class="row g-3 needs-validation" novalidate>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="email" class="form-control" id="email" required>
                        <div class="invalid-feedback">Entrez votre mot de passe</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Mot de passe</label>
                      <input type="password" name="mot_de_passe" class="form-control" id="mot_de_passe" required>
                      <div class="invalid-feedback">Entrez votre mot de passe!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                    <div class="col-12">
                    <p id="loginError" class="text-danger mt-2"></p>
                      </div>
                    <div class="col-12">
                      <p class="small mb-0">Pas de comptre <a href="pages-register.php">Créer un compte</a></p>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">

                Designed by <a>Ermis Cherry Pellat & Rodolphe Ianboukhtine</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->
  <?php require_once("footer.php"); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php require_once("js_files.html"); ?>

   
    <script>

let RESTAPI_URL = "<?php 
      require_once('config.php'); 
      echo URL_API;
  ?>";


function getID_UserByEmailAndPassword(email, mot_de_passe, users) {
    for (let i = 0; i < users.length; i++) {
        if (users[i].email === email && users[i].mot_de_passe === mot_de_passe) {
            return users[i].id_utilisateur;
        }
    }
    return null;
}

function validateUser(email, mot_de_passe, users) {
    let user = getID_UserByEmailAndPassword(email, mot_de_passe, users);
    if (user !== null) {
        sessionStorage.setItem('id_utilisateur', user.id_utilisateur);
        sessionStorage.setItem('email', email);
        return true;
    } else {
        return false;
    }
}




$(document).ready(function() {
    // Écouteur d'événement pour le formulaire de connexion qaund on clique sur se connecter
    $('#loginForm').submit(function(event) {
        event.preventDefault();

        // Récupérer les valeurs du formulaire
        let email = $('#email').val();
        let mot_de_passe = $('#mot_de_passe').val();

        // Envoyer une requête AJAX GET pour récupérer les utilisateurs de la base de données
        $.ajax({
            type: 'GET',
            url: RESTAPI_URL + '/users.php',
            dataType: 'json',
            success: function(users) {
                // Vérifier si l'utilisateur est valide
                if (validateUser(email, mot_de_passe, users)) {
                    // Ouvrir une session et rediriger l'utilisateur vers une page de votre site
                    alert('Connexion réussie !');
                    sessionStorage.setItem('email', email);
                    sessionStorage.setItem('mot_de_passe', mot_de_passe);
                    sessionStorage.setItem('id_utilisateur',getID_UserByEmailAndPassword(email, mot_de_passe, users));
                    
                    // Exemple de redirection vers une page du site
                    window.location.replace('users-profile.php');
                    } else {
                    
                    alert('Email ou mot de passe incorrect !');
                }
            },
            error: function() {
                alert('Une erreur s\'est produite lors de la récupération des utilisateurs.');
            }
        });
    });
});
       
    </script>
</body>
</html>