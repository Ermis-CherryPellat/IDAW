<!DOCTYPE html>
<html lang="en">

<?php 

  require_once("head.html");
  require_once("header.php");
  require_once("sidebar.html"); 

?>
<script src="fonctions.js"></script>
<script src="https://d3js.org/d3.v7.min.js"></script>

<script>
  
  getUserInfo();
  calculerIMC();
  calculerBesoinsNutritionnels();
  CalculNutritionUser();
  
  NutrimentUser();
  

</script>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Analyse</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Analyse</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                

                <div class="card-body">
                  <h5 class="card-title"> Tranche de poids actuel <span></span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person"></i>
                    </div>
                    <div class="ps-3">
                      <h6><span class="poids"></span></h6>
                      <span class="text-success small pt-1 fw-bold">Indiquer le nombre de kg à perdre</span> <span class="text-muted small pt-2 ps-1"></span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                

                <div class="card-body">
                  <h5 class="card-title">IMC actuel</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6><span class="imc"></span></h6>
                      <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-lg-4">

              <div class="card info-card customers-card">

               

                <div class="card-body">
                  <h5 class="card-title">Objectif Calories Quotidien</h5>

                  
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    
                    <h6> <span id="span-calories"></span> / </h6>  
                    <h6><span class="calories"></span>  kgCal </h6>
                      

                     

                    </div>
                  </div>

                </div>
              </div>
<!-- Nutriments à consommer  -->
<div class="col-lg-12">
  <div class="card info-card customers-card">
    <div class="card-body">
      <h5 class="card-title text-center">Pourcentage de nutriments consommés par rapport aux objectifs<span></span></h5>
      <div class="text-center">
        <div class="diagram-container" style="margin-left: 50px;">
  <!-- insérez ici le code de votre diagramme -->
        <script>
          drawDiagram();
        </script>
        </div>
          <!-- insérez ici le code de votre diagramme -->
          <script>
            drawDiagram();
          </script>
        </div>
      </div>
    </div>
  </div>
</div>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
<?php require_once("footer.php"); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php require_once("js_files.html"); ?>

</body>

</html>