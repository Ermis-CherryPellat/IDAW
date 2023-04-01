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
        <div class="col-lg-12">

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
                <div class="col-12">
                <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
              </form>
            </div>
          </div>


        </div>
      </div>

      <div class="row">

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Liste des aliments enregistrés</h5>
              <p>Voici la liste des aliments en enregistrés qui vous permettent de composer des repas.</p>

              <table id="alimentsTable" class="display">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Type</th>
                        <th>Glucides</th>
                        <th>Lipides</th>
                        <th>Sucres</th>
                        <th>Protéines</th>
                        <th>Fibres</th>
                        <th>Énergie</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
              </table>

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

      function ajaxPOSTAliment(nom, type, glucides, lipides, sucres, proteines, fibres, energie) {
        $.ajax({
            url: RESTAPI_URL + "/aliments.php",
            method: "POST",
            data: JSON.stringify({
                nom_aliment: nom,
                id_type_aliment: type,
                glucides: glucides,
                lipides: lipides,
                sucres: sucres,
                proteines: proteines,
                fibres: fibres,
                energie: energie
            }),
            dataType: "json"
        }).done(function(response) {
            let nom_aliment = response.nom_aliment;
            let id_type_aliment = response.id_type_aliment;
            let glucides = response.glucides;
            let lipides = response.lipides;
            let sucres = response.sucres;
            let proteines = response.proteines;
            let fibres = response.fibres;
            let energie = response.energie;
            $("#alimentsTableBody").append(`
                <tr>
                    <td>${nom_aliment}</td>
                    <td>${id_type_aliment}</td>
                    <td>${glucides}</td>
                    <td>${lipides}</td>
                    <td>${sucres}</td>
                    <td>${proteines}</td>
                    <td>${fibres}</td>
                    <td>${energie}</td>
                    <td>
                        <button class="btn btn-primary editBtn" onclick="editButton(this)">Edit</button>
                    </td>
                    <td>
                        <button class="btn btn-danger deleteBtn" onclick="deleteButton(this)" >Delete</button>
                    </td>
                </tr>
            `);
        }).fail(function(error) {
            console.log("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
        });
      }


      $(document).ready(async function(){
          
        // Récuperer le type des aliments pour le form
        try {
          let data = await ajaxGETTypeAliment();
          // Parcours des données pour les afficher dans le tableau
          data.forEach(user => {
            $("#type_aliment").append(`<option value="${user.id_type_aliment}">${user.nom_type_aliment}</option>`);
          });
        } catch (error) {
            console.log("La requête pour les types d'aliments s'est terminée en échec. Infos : " + JSON.stringify(error));
        }
    
        try {

          let data = await ajaxGETAliment();

          $('#alimentsTable').DataTable({
              // Nombre d'éléments par page
              pageLength: 25,
              // Activer la pagination
              paging: true,
              
              // Passer les données à la table
              data: data,
              columns: [
                  { data: 'nom_aliment' },
                  { data: 'nom_type_aliment' },
                  { data: 'glucides' },
                  { data: 'lipides' },
                  { data: 'sucres' },
                  { data: 'proteines' },
                  { data: 'fibres' },
                  { data: 'energie' },
                  { data: null, render: function (data, type, row, meta) {
                      return '<button class="btn btn-primary editBtn" onclick="editButton(this)">Edit</button>';
                  } },
                  { data: null, render: function (data, type, row, meta) {
                      return '<button class="btn btn-danger deleteBtn" onclick="deleteButton(this)">Delete</button>';
                  } }
              ]
          });
        } catch (error) {
            console.log("La requête pour les aliments s'est terminée en échec. Infos : " + JSON.stringify(error));
        }
      });

  </script>
</body>

</html>