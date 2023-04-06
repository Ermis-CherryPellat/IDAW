
<!DOCTYPE html>
<html lang="en">

<?php 

  require_once("head.html");
  
?>

<main>

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
                  <h5 class="card-title text-center pb-0 fs-4">Créer un compte IMangerMieux</h5>
                  <p class="text-center small">Entrez vos informations personnelles</p>
                </div>

                <form id="addUserForm" method="POST" action=""  onsubmit="onFormSubmit();" class="row g-3 needs-validation" novalidate>
                  <div class="form-group">
                    <label for="yourName" class="form-label">Votre Nom</label>
                    <input type="text" name="nom" class="form-control" id="inputName" required value="Fromage">
                    <div class="invalid-feedback">Entrez votre nom!</div>
                  </div>
                  
                  <div class="col-12">
                    <label for="yourName" class="form-label">Votre Prénom</label>
                    <input type="text" name="prenom" class="form-control" id="inputPrenom" required value="Paul">
                    <div class="invalid-feedback">Entrez votre prénom!</div>
                  </div>

                  <div class="col-12">
                    <label for="yourEmail" class="form-label">Votre Email</label>
                    <input type="email" name="email" class="form-control" id="inputEmail" required value="a@a.com">
                    <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                  </div>

                  <div class="col-md-6">
                    <label for="gender" class="form-label">Sexe</label>
                    <select class="form-select" name="id_sexe" id="inputGender" required>
                      <option value="">Choisissez votre sexe</option>
                      <option value="0" selected>Homme</option>
                      <option value="1">Femme</option>
                    </select>
                    <div class="invalid-feedback">Veuillez choisir votre sexe</div>
                  </div>

                  <div class="col-md-6">
                    <label for="weight" class="form-label">Tranche de poids</label>
                    <select class="form-select" name="id_poids" id="inputWeight" required>
                      <option value="">Choisissez votre tranche de poids</option>
                      <option value="1">Moins de 49 kg</option>
                      <option value="2">50 - 60 kg</option>
                      <option value="3">61 - 70 kg</option>
                      <option value="4">71 - 80 kg</option>
                      <option value="5">81 - 90 kg</option>
                      <option value="6">91 - 100 kg</option>
                      <option value="7">111 - 120kg</option>
                      <option value="8">121 - 130kg</option>
                      
                    </select>
                    <div class="invalid-feedback">Veuillez choisir votre tranche d'âge</div>
                  </div>

                  <div class="col-md-6">
                    <label for="age" class="form-label">Tranche d'âge</label>
                    <select class="form-select" name="id_tranche_age" id="inputAge" required>
                      <option value="">Choisissez votre tranche d'âge</option>
                      <option value="1">Moins de 11 ans</option>
                      <option value="2">12-18 ans</option>
                      <option value="3">19-25 ans</option>
                      <option value="4">26-40 ans</option>
                      <option value="5">41-60ans</option>
                      <option value="6">61-75 ans</option>
                      <option value="7">Plus de 76 ans</option>
                    </select>
                    <div class="invalid-feedback">Veuillez choisir votre tranche d'âge</div>
                  </div>

                  <div class="col-md-6">
                    <label for="height" class="form-label">Taille</label>
                    <select class="form-select" name="id_taille" id="inputHeight" required>
                      <option value="">Choisissez votre taille</option>
                      <option value="1"selected>1m50 - 1m60</option>
                      <option value="2">1m61 - 1m70</option>
                      <option value="3">1m71 - 1m80</option>
                      <option value="4">1m81 - 1m90</option>
                      <option value="5">1m91-2m00</option>
                      <option value="6">Plus de 2m00</option>
                    </select>
                    <div class="invalid-feedback">Veuillez choisir votre tranche de taille</div>
                  </div>

                  <div class="col-md-6">
                    <label for="pratique sportive" class="form-label">Pratique sportive</label>
                    <select class="form-select" name="id_pratique_sportive" id="inputPratique" required>
                      <option value="">Quelle est votre pratique sportive ? </option>
                      <option value="1" selected>Souvent</option>
                      <option value="2">Régulièremet</option>
                      <option value="3">Jamais</option>
                    </select>
                    <div class="invalid-feedback">Veuillez choisir votre pratique sportive</div>
                  </div>

                  <div class="col-md-6">
                    <label for="objectifsportif" class="form-label">Pratique sprtive</label>
                    <select class="form-select" name="id_objectif" id="inputObjectif" required>
                      <option value="">Quelle est votre objectif ? </option>
                      <option value="1" selected>Perte de poids</option>
                      <option value="2">Prise de masse</option>
                      <option value="3">Maintien de la forme</option>
                    </select>
                    <div class="invalid-feedback">Veuillez choisir votre pratique sportive</div>
                  </div>

                  <div class="col-12">
                    <label for="yourPassword" class="form-label">Mot de passe</label>
                    <input type="password" name="mot_de_passe" class="form-control" id="inputMotdePasse" required value="a">
                    <div class="invalid-feedback">Please enter your password!</div>
                  </div>

                  <div class="col-12">
                    <button class="btn btn-primary w-100" action=""  type="submit">Créer un compte</button>
                  </div>
                  <div class="col-12">
                    <p class="small mb-0">Déjà un compte ? <a href="pages-login.php">Se connecter</a></p>
                  </div>

                  <!-- <form class="row g-3 needs-validation" novalidate> -->

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

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php require_once("js_files.html"); ?>

<script>
  let RESTAPI_URL = "<?php 
      require_once('config.php'); 
      echo URL_API;
  ?>";


  async function onFormSubmit() {
    // prevent the form to be sent to the server
    event.preventDefault();
    
    let nom = $("#inputName").val();
    let prenom = $("#inputPrenom").val();
    let email = $("#inputEmail").val();
    let sexe = $("#inputGender").val();
    let poids = $("#inputWeight").val();
    let age = $("#inputAge").val();
    let taille = $("#inputHeight").val();
    let pratique = $("#inputPratique").val();
    let objectif = $("#inputObjectif").val();
    let mot_de_passe =$("#inputMotdePasse").val();


    
    // console.log(nom, prenom, email, sexe, poids, age, taille, pratique, objectif,mot_de_passe);
    ajaxPOSTUsers(nom, prenom, email, sexe, poids, age, taille, pratique,objectif,mot_de_passe);
    // console.log(ajaxGETUsers());
    alert('Compte créé !');
    window.location.replace('pages-login.php');
    

    

  }

  function ajaxGETUsers(){
    return new Promise(function(resolve, reject) {
        $.ajax({
            url: RESTAPI_URL + "/users.php",
            method: "GET",
            dataType: "json"
        }).done(function(response){
            resolve(response);
        }).fail(function(error){
            reject(error);
        });
    });
  }

  function ajaxPOSTUsers(nom, prenom, email, sexe, poids, age, taille, pratique,objectif,mot_de_passe) {
    // convertit les valeurs en entiers
    sexe = parseInt(sexe) || 0;
    poids = parseInt(poids) || 0;
    age = parseInt(age) || 0;
    taille = parseInt(taille) || 0;
    pratique = parseInt(pratique) || 0;
    objectif = parseInt(objectif) || 0;
    
    $.ajax({
        url: RESTAPI_URL + "/users.php",
        method: "POST",
        data: JSON.stringify({
            nom: nom,
            prenom: prenom,
            email: email ,
            mot_de_passe:mot_de_passe ,
            id_sexe: sexe,
            id_poids: poids ,
            id_taille: taille,
            id_objectif: objectif ,
            id_pratique_sportive: pratique,
            id_tranche_age: age,
        }),
        dataType: "json"
    }).done(async function(response) {
      console.log("ok");
    }).fail(function(error) {
      console.log("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
    });
  }

  </script>
</body>

</html>