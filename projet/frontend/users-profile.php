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

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<?php require_once("header.html");
    require_once("sidebar.html"); ?>

<body>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <h2>Kevin Anderson</h2>
              <h3>Web Designer</h3>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" >Overview</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                
                  <h5 class="card-title">Profile Details</h5>
                  
                  <script>
                    function ajaxGETUsers(e){
                      return new Promise(function(resolve, reject) {
                              $.ajax({
                                  url: RESTAPI_URL + "/backend/users.php",
                                  method: "GET",
                                  dataType: "json"
                              }).done(function(response){
                                  resolve(response);
                              }).fail(function(error){
                                  reject(error);
                              });
                          });
                    } 

                    try {
                    let data = await ajaxGETUsers();
                    
                    // Parcours des données pour les afficher dans le tableau
                    data.forEach(user => {
                    $("#usersTableBody").append(`
                    <tr>
                        <td>${user.id_user}</td>
                        <td>${user.nom}</td>
                        <td>${user.email}</td>
                        <td>
                            <button class="btn btn-primary editBtn" onclick="editButton(this)">Edit</button>
                        </td>
                        <td>
                            <button class="btn btn-danger deleteBtn" onclick="deleteButton(this)" >Delete</button>
                        </td>
                    </tr>
                    `);
                    });
                } catch (error) {
                    console.log("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
                }
                  </script>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Nom Prénom</div>
                    <div class="col-lg-9 col-md-8">Kevin Anderson</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Date de naissance</div>
                    <div class="col-lg-9 col-md-8">(436) 486-3538 x29071</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">k.anderson@example.com</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Sexe</div>
                    <div class="col-lg-9 col-md-8">Homme</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Taille</div>
                    <div class="col-lg-9 col-md-8">180 cm</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Poids</div>
                    <div class="col-lg-9 col-md-8">72 kg</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Objectifs</div>
                    <div class="col-lg-9 col-md-8">Maintien de la forme</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Pratique sportive</div>
                    <div class="col-lg-9 col-md-8">Moyenne</div>
                  </div>

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
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

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>