<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Users / Profile - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">


  <link href="assets/css/style.css" rel="stylesheet">


</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php require_once("header.php");
    require_once("sidebar.html"); ?>

<body>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Utilisateurs</li>
          <li class="breadcrumb-item active">Profil</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <h2>     <span id="prenom"> </span>  <span id="nom"> </span>                </h2>
              <h3>                         </h3>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" >Votre profil</button>
                </li>
                

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                
                  <h5 class="card-title">Détail du profil</h5>
                  
                 

                  

    <div class="row">
  <div class="col-lg-3 col-md-4 label">Age</div>
  <div class="col-lg-9 col-md-8"><span id="age_min"></span> - <span id="age_max"></span> ans</div>
</div>
<div class="row">
  <div class="col-lg-3 col-md-4 label">Email</div>
  <div class="col-lg-9 col-md-8"><span id="email"></span></div>
</div>
<div class="row">
  <div class="col-lg-3 col-md-4 label">Sexe</div>
  <div class="col-lg-9 col-md-8"><span id="nom_sexe"></span></div>
</div>
<div class="row">
  <div class="col-lg-3 col-md-4 label">Tranche de taille</div>
  <div class="col-lg-9 col-md-8"><span id="taille_min"></span> - <span id="taille_max"></span> cm</div>
</div>
<div class="row">
  <div class="col-lg-3 col-md-4 label">Poids</div>
  <div class="col-lg-9 col-md-8"><span id="poids_min"></span> - <span id="poids_max"></span> kg</div>
  <!-- <select class="form-select" name="id_poids" id="inputWeight" required>
                      <option value="">Choisissez votre tranche de poids</option>
                      <option value="1">Moins de 49 kg</option>
                      <option value="2">50 - 60 kg</option>
                      <option value="3">61 - 70 kg</option>
                      <option value="4">71 - 80 kg</option>
                      <option value="5">81 - 90 kg</option>
                      <option value="6">91 - 100 kg</option>
                      <option value="7">111 - 120kg</option>
                      <option value="8">121 - 130kg</option> -->
</div>

<div class="row">
  <div class="col-lg-3 col-md-4 label">Objectif</div>
  <div class="col-lg-9 col-md-8"><span id="nom_objectif"></span></div>
  <!-- <option value="1">Souvent</option>
 <option value="2">Régulièremet</option>
<option value="3">Jamais</option> -->
</div>

<div class="row">
  <div class="col-lg-3 col-md-4 label">Pratique</div>
  <div class="col-lg-9 col-md-8"><span id="frequence_pratique_sportive"></span></div>

  <!-- <option value="1">Perte de poids</option>
                      <option value="2">Prise de masse</option>
                      <option value="3">Maintien de la forme</option> -->

</div>

  

</div>
                    
                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>

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


    // TEST 
  // affiche le resultat de la requete ajax  
  //   console.log(user);
  //   console.log(id_utilisateur);
  // // affiche l'email du user dans la console
  //   console.log((user[0].email));
    
    

    // Récupérer les valeurs des champs de l'objet utilisateur
    var nom = user[0].nom;
    
    var prenom = user[0].prenom;
    var email = user[0].email;
    var sexe = user[0].nom_sexe;
    var poids_min = user[0].poids_min;
    var poids_max = user[0].poids_max;
    var taille_min = user[0].taille_min;
    var taille_max = user[0].taille_max;
    var age_min = user[0].age_min;
    var age_max = user[0].age_max;
    var nom_objectif = user[0].nom_objectif;
    var frequence_pratique_sportive = user[0].frequence_pratique_sportive;
    
       // Mettre à jour le contenu HTML avec les informations utilisateur récupérées
    document.getElementById('nom').textContent = nom;
    document.getElementById('prenom').textContent = prenom;
    document.getElementById('age_min').textContent = age_min;
    document.getElementById('age_max').textContent = age_max;
    document.getElementById('email').textContent = email;
    document.getElementById('nom_sexe').textContent = sexe;
    document.getElementById('taille_min').textContent = taille_min;
    document.getElementById('taille_max').textContent = taille_max;
    document.getElementById('poids_min').textContent =  poids_min;
    document.getElementById('poids_max').textContent = poids_max;

    document.getElementById('nom_objectif').textContent = nom_objectif
    document.getElementById('frequence_pratique_sportive').textContent = frequence_pratique_sportive
  }
}).done(function() {
  console.log("La requête AJAX a réussi");
}).fail(function() {
  console.log("La requête AJAX a échoué");
});

</script>

 
<?php require_once("footer.php") ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>


  <script src="assets/js/main.js"></script>

</body>

</html>