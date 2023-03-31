<!DOCTYPE html>
<html lang="en">

<?php 

  require_once("head.html");
  require_once("header.html");
  require_once("sidebar.html"); 

?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Repas</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Blank</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Veuillez entrer le repas actuel</h5>
              <p>Form pour entrer le repas avec date,aliments, ect...</p>
            </div>
          </div>

        </div>

        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Dernier repas</h5>
              <p>Montre le dernier repas consommé</p>
            </div>
          </div>

        </div>
      </div>
    </section>
    <section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Historique des repas consommés</h5>
          <p>Ceci est une section qui prend toute la place en dessous des deux premières sections.</p>
          <p>Ici on ajoutera untableau avec la liste des repas consommés précédents</p>
        </div>
      </div>
    </div>
  </div>
</section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php require_once("footer.php"); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php require_once("js_files.html"); ?>

</body>

</html>