


<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">i Manger Mieux</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span class="d-none d-md-block dropdown-toggle ps-2">
              <span id="prenom-utilisateur"></span> <span id="nom-utilisateur"></span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><span class="prenom"> </span>  <span class="nom"></h6>
              <span class="nom_objectif"></span>
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

          </ul>
        </li>

      </ul>
    </nav>

  </header>

</main>
<script src="fonctions.js"></script>

<script>
  
let RESTAPI_URL = "<?php 
          require_once('config.php'); 
          echo URL_API;
      ?>";
  // Appeler la fonction getUserInfo()
  getUserInfo();
</script>

