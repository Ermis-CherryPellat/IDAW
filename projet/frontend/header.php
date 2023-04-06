


<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">i Manger Mieux</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span class="d-none d-md-block dropdown-toggle ps-2">
              <span id="prenom-utilisateur"></span> <span id="nom-utilisateur"></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><span id="prenom"> </span>  <span id="nom"></h6>
              <span id="nom_objectif"></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            
            <li>
              <hr class="dropdown-divider">
            </li>
          
            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php" >
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

</main>

<script>

let RESTAPI_URL = "<?php 
      require_once('config.php'); 
      echo URL_API;
  ?>";


var id_utilisateur = sessionStorage.getItem('id_utilisateur');

// Envoyer une requête AJAX GET pour récupérer les informations de l'utilisateur
$.ajax({
  type: 'GET',
  url: RESTAPI_URL + '/users.php?id_utilisateur=' + id_utilisateur ,
  dataType: 'json',
  success: function(user) {

    var nom = user[0].nom;
    var prenom = user[0].prenom;
    var nom_objectif = user[0].nom_objectif;
    document.getElementById('nom').textContent = nom;
    document.getElementById('prenom').textContent = prenom;
    document.getElementById('nom_objectif').textContent = nom_objectif;

  }
}).done(function() {
  console.log("La requête AJAX a réussi");
}).fail(function() {
  console.log("La requête AJAX a échoué");
});

</script>