<!DOCTYPE html>
<html lang="en">

<?php 

    require_once("head.html");
    require_once("header.html");
    require_once("sidebar.html"); 
    
    ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Liste des aliments</h1>
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
            <h5 class="card-title">Ajouter un aliment</h5>
            <form method="POST" action="ajouter_aliment.php">
              <div class="form-group">
                <label for="nom_aliment">Nom de l'aliment :</label>
                <input type="text" class="form-control" id="nom_aliment" name="nom_aliment">
              </div>
              <div class="form-group">
                <label for="type_aliment">Type d'aliment :</label>
                <select class="form-control" id="type_aliment" name="type_aliment">
                
                 <?php
                  // Connexion à la base de données
                  $db = new PDO('mysql:host=localhost;dbname=ma_base_de_donnees;charset=utf8', 'utilisateur', 'mot_de_passe');

                  // Requête SQL pour récupérer les types d'aliments
                  $query = "SELECT id_type_aliment, nom_type_aliment FROM TYPE_ALIMENT";

                  // Exécution de la requête
                  $result = $db->query($query);

                  // Parcours des résultats pour afficher les options du menu déroulant
                  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="'.$row['id_type_aliment'].'">'.$row['nom_type_aliment'].'</option>';
                  }

                  // Fermeture de la connexion à la base de données
                  $db = null;
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="glucides">Taux de glucides :</label>
                <input type="text" class="form-control" id="glucides" name="glucides">
              </div>
              <div class="form-group">
                <label for="lipides">Taux de lipides :</label>
                <input type="text" class="form-control" id="lipides" name="lipides">
              </div>
              <div class="form-group">
                <label for="sucres">Taux de sucres :</label>
                <input type="text" class="form-control" id="sucres" name="sucres">
              </div>
              <div class="form-group">
                <label for="proteines">Taux de protéines :</label>
                <input type="text" class="form-control" id="proteines" name="proteines">
              </div>
              <div class="form-group">
                <label for="fibres">Taux de fibres :</label>
                <input type="text" class="form-control" id="fibres" name="fibres">
              </div>
              <div class="form-group">
                <label for="energie">Taux d'énergie :</label>
                <input type="text" class="form-control" id="energie" name="energie">
              </div>
              <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
          </div>
        </div>


        </div>

        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Liste des aliments enregistrés</h5>
              <p>Voici la liste des aliments qui en mémoire qui vous permettent de composer des repas.</p>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
  
  <?php require_once("footer.php"); ?>
  
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  
  <?php require_once("js_files.html"); ?>

  <script>
            let RESTAPI_URL = "<?php 
                require_once('config.php'); 
                echo URL_API;
            ?>";

            function ajaxGETTypeAliment(){
                return new Promise(function(resolve, reject) {
                    $.ajax({
                        url: RESTAPI_URL + "/type_aliment.php",
                        method: "GET",
                        dataType: "json"
                    }).done(function(response){
                        resolve(response);
                    }).fail(function(error){
                        reject(error);
                    });
                });
            }

            $(document).ready(async function(){
                
                try {
                    let data = await ajaxGETTypeAliment();
                    // Parcours des données pour les afficher dans le tableau
                    data.forEach(user => {
                      $("#type_aliment").append(`<option value="'.${user.id_type_aliment}.'">'.${user.nom_type_aliment}.'</option>'`);
                    });
                } catch (error) {
                    console.log("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
                }
            
            });

        </script>
</body>

</html>