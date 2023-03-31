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
                  <span class="d-none d-lg-block">I Manger Mieux</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Créer un compte IMangerMieux</h5>
                    <p class="text-center small">Entrez vos informations personnelles</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate>
                    <div class="col-12">
                      <label for="yourName" class="form-label">Votre Nom</label>
                      <input type="text" name="name" class="form-control" id="yourName" required>
                      <div class="invalid-feedback">Entrez votre nom!</div>
                    </div>

                    <form class="row g-3 needs-validation" novalidate>
                    <div class="col-12">
                      <label for="yourName" class="form-label">Votre Prénom</label>
                      <input type="text" name="name" class="form-control" id="yourFirstName" required>
                      <div class="invalid-feedback">Entrez votre prénom!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Votre Email</label>
                      <input type="email" name="email" class="form-control" id="yourEmail" required>
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>

                    <div class="col-md-6">
                      <label for="gender" class="form-label">Sexe</label>
                      <select class="form-select" name="gender" id="gender" required>
                        <option value="">Choisissez votre sexe</option>
                        <option value="male">Homme</option>
                        <option value="female">Femme</option>
                      </select>
                      <div class="invalid-feedback">Veuillez choisir votre sexe</div>
                    </div>

                    <div class="col-md-6">
                      <label for="weight" class="form-label">Tranche de poids</label>
                      <select class="form-select" name="weight" id="weight" required>
                        <option value="">Choisissez votre tranche de poids</option>
                        <option value="0-49">Moins de 49 kg</option>
                        <option value="50-60">50 - 60 kg</option>
                        <option value="61-70">61 - 70 kg</option>
                        <option value="71-80">71 - 80 kg</option>
                        <option value="81 -90">81 - 90 kg</option>
                        <option value="91 - 100">91 - 100 kg</option>
                        <option value="111 - 120">111 - 120kg</option>
                        <option value="121 - 130">121 - 130kg</option>
                        
                      </select>
                      <div class="invalid-feedback">Veuillez choisir votre tranche d'âge</div>
                    </div>




 

  <div class="col-md-6">
    <label for="age" class="form-label">Tranche d'âge</label>
    <select class="form-select" name="age" id="age" required>
      <option value="">Choisissez votre tranche d'âge</option>
      <option value="0-11">Moins de 11 ans</option>
      <option value="12-18">12-18 ans</option>
      <option value="19-25">19-25 ans</option>
      <option value="26-40">26-40 ans</option>
      <option value="41-60">41-60ans</option>
      <option value="61-75">61-75 ans</option>
      <option value="Plusde 76">Plus de 76 ans</option>
      
    </select>
    <div class="invalid-feedback">Veuillez choisir votre tranche d'âge</div>
  </div>


  <div class="col-md-6">
    <label for="height" class="form-label">Taille</label>
    <select class="form-select" name="height" id="height" required>
      <option value="">Choisissez votre taille</option>
      <option value="150-160">1m50 - 1m60</option>
      <option value="161-170">1m61 - 1m70</option>
      <option value="171-180">1m71 - 1m80</option>
      <option value="181-190">1m81 - 1m90</option>
      <option value="191-200">1m91-2m00</option>
      <option value="201-210">Plus de 2m00</option>
      
      
    </select>
    <div class="invalid-feedback">Veuillez choisir votre tranche de taille</div>
  </div>


  <div class="col-md-6">
    <label for="pratique sportive" class="form-label">Pratique sprtive</label>
    <select class="form-select" name="pratiquesportive" id="pratiquesportive" required>
      <option value="">Quelle est votre pratique sportive ? </option>
      <option value="souvent">Souvent</option>
      <option value="régulièrement">Régulièremet</option>
      <option value="jamais">Jamais</option>
    </select>
    <div class="invalid-feedback">Veuillez choisir votre pratique sportive</div>
  </div>

  <div class="col-md-6">
    <label for="objectifsportif" class="form-label">Pratique sprtive</label>
    <select class="form-select" name="objectifsportif" id="objectifsportif" required>
      <option value="">Quelle est votre objectif ? </option>
      <option value="perte">Perte de poids</option>
      <option value="prise">Prise de masse</option>
      <option value="maintien">Maintien de la formes</option>
    </select>
    <div class="invalid-feedback">Veuillez choisir votre pratique sportive</div>
  </div>

                    

                    
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Mot de passe</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="pages-login.php">Log in</a></p>
                    </div>

                    <form class="row g-3 needs-validation" novalidate>
  
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Designed by <a>Ermis CHerry Pellat & Rodolphe Ianboukhtine</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php require_once("js_files.html"); ?>

</body>

</html>