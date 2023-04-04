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
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Repas</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Veuillez entrer un repas</h5>
              <!-- Button pour ouvrir la modale -->
                <a type="button" class="btn btn-primary " id="open-modal">Ajouter un repas</a>

            </div>
          </div>
        </div>

        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Précédent repas</h5>
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

      <!-- La modale -->
      <div id="modal" class="modal">
        <div class="modal-content">
          <span id="close-modal" class="close">&times;</span>
          <h5 class="card-title">Ajout d'un repas</h2>
          <p>Contenu de la modale</p>
        </div>
      </div>

  </main><!-- End #main -->

  <?php require_once("footer.php"); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php require_once("js_files.html"); ?>

  
  <script>

    // ============ JavaScript pour la modale ============
    // Récupérer la modale et les boutons pour l'ouvrir et la fermer
    var modal = document.getElementById("modal");
    var btn = document.getElementById("open-modal");
    var span = document.getElementById("close-modal");

    // Quand l'utilisateur clique sur le bouton, ouvrir la modale
    btn.onclick = function() {
      modal.style.display = "block";
    }

    // Quand l'utilisateur clique sur la croix, fermer la modale
    span.onclick = function() {
      modal.style.display = "none";
    }

    // Si l'utilisateur clique à l'extérieur de la modale, la fermer
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }

    // ============ JavaScript pour les API ============
    let RESTAPI_URL = "<?php 
          require_once('config.php'); 
          echo URL_API;
      ?>";
    function ajaxGETTypeRepas(){
      return new Promise(function(resolve, reject) {
        $.ajax({
            url: RESTAPI_URL + "/type_de_repas.php",
            method: "GET",
            dataType: "json"
        }).done(function(response){
            resolve(response);
        }).fail(function(error){
            reject(error);
        });
      });
    }

    function ajaxGETAliment(){
          return new Promise(function(resolve, reject) {
              $.ajax({
                  url: RESTAPI_URL + "/aliments.php",
                  method: "GET",
                  dataType: "json"
              }).done(function(response){
                  resolve(response);
              }).fail(function(error){
                  reject(error);
              });
          });
      }



  </script>

</body>

</html>