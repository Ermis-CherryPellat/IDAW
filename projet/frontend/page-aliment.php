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
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Aliment</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Ajouter un aliment</h5>
              <form id="addAlimentForm" method="POST" action="" onsubmit="onFormSubmit();">
                <div class="form-group">
                  <label for="nom_aliment">Nom de l'aliment :</label>
                  <input type="text" class="form-control" id="inputNom" name="inputNom">
                </div>
                <div class="form-group">
                  <label for="type_aliment">Type d'aliment :</label>
                  <select class="form-control" id="inputType" name="inputType" required>
                  </select>
                </div>
                <div class="form-group">
                  <label for="glucides">Taux de glucides :</label>
                  <input type="number" class="form-control" id="inputGlucides" name="inputGlucides" min="0">
                </div>
                <div class="form-group">
                  <label for="lipides">Taux de lipides :</label>
                  <input type="number" class="form-control" id="inputLipides" name="inputLipides" min="0">
                </div>
                <div class="form-group">
                  <label for="sucres">Taux de sucres :</label>
                  <input type="number" class="form-control" id="inputSucres" name="inputSucres" min="0">
                </div>
                <div class="form-group">
                  <label for="proteines">Taux de protéines :</label>
                  <input type="number" class="form-control" id="inputProteines" name="inputProteines" min="0">
                </div>
                <div class="form-group">
                  <label for="fibres">Taux de fibres :</label>
                  <input type="number" class="form-control" id="inputFibres" name="inputFibres" min="0">
                </div>
                <div class="form-group">
                  <label for="energie">Taux d'énergie :</label>
                  <input type="number" class="form-control" id="inputEnergie" name="inputEnergie" min="0">
                </div>
                <div class="col-12">
                <button type="submit" class="btn btn-primary bouton_form">Ajouter</button>
                </div>
              </form>
            </div>
          </div>

          <div id="editCard" style="display:none;">
            <div class="card" >
              <div class="card-body">
                <h5 class="card-title">Modifier l'aliment</h5>
                <form id="editForm">
                  <input type="hidden" id="idAliment">
                  <div class="form-group">
                      <label for="editNomAliment">Nom de l'aliment :</label>
                      <input type="text" class="form-control" id="editNomAliment">
                  </div>
                  <div class="form-group">
                      <label for="editIdTypeAliment">Type d'aliment :</label>
                      <select class="form-control" id="editIdTypeAliment">
                          <!-- Options du select -->
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="editGlucides">Glucides :</label>
                      <input type="number" class="form-control" id="editGlucides" min="0">
                  </div>
                  <div class="form-group">
                      <label for="editLipides">Lipides :</label>
                      <input type="number" class="form-control" id="editLipides" min="0">
                  </div>
                  <div class="form-group">
                      <label for="editSucres">Sucres :</label>
                      <input type="number" class="form-control" id="editSucres" min="0">
                  </div>
                  <div class="form-group">
                      <label for="editProteines">Protéines :</label>
                      <input type="number" class="form-control" id="editProteines" min="0">
                  </div>
                  <div class="form-group">
                      <label for="editFibres">Fibres :</label>
                      <input type="number" class="form-control" id="editFibres" min="0">
                  </div>
                  <div class="form-group">
                      <label for="editEnergie">Énergie :</label>
                      <input type="number" class="form-control" id="editEnergie" min="0">
                  </div>
                  <button type="button" class="btn btn-success bouton_form" onclick="submitEditForm()">Modifier</button>
                </form>
              </div>
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

      function verifierNom(nom){
        // supprimer le message d'erreur s'il existe déjà
        $('#inputNom').siblings('.text-danger').remove();
        // vérifier si le champ nom est vide
        if (nom.trim() === '') {
            // vérifier si le message d'erreur existe déjà
            if ($('#inputNom').siblings('.text-danger').length == 0) {
                // afficher le message d'erreur à côté du champ nom
                $('#inputNom').parent().append('<div class="text-danger">This field is required</div>');
            }
            return true;
        };
      }

      function onFormSubmit() {
        // prevent the form to be sent to the server
        event.preventDefault();

        let nom = $("#inputNom").val();
        let type = $("#inputType").val();
        let glucides = $("#inputGlucides").val();
        let lipides = $("#inputLipides").val();
        let sucres = $("#inputSucres").val();
        let proteines = $("#inputProteines").val();
        let fibres = $("#inputFibres").val();
        let energie = $("#inputEnergie").val();

        if(verifierNom(nom)){
            return;
        }

        ajaxPOSTAliment(nom, type, glucides, lipides, sucres, proteines, fibres, energie);

        //supprime les inputs
        document.getElementById("addAlimentForm").reset();
      }

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
        // convertit les valeurs en entiers
        glucides = parseInt(glucides) || 0;
        lipides = parseInt(lipides) || 0;
        sucres = parseInt(sucres) || 0;
        proteines = parseInt(proteines) || 0;
        fibres = parseInt(fibres) || 0;
        energie = parseInt(energie) || 0;
        
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
        }).done(async function(response) {
          
          // On n'a pas trouvé d'autre manière d'actualiser le tableau, on a essayé des methodes avec .ajax.reload() ou encore .draw() mais sans succès
          // Récupérer les nouvelles données
          let newData = await ajaxGETAliment();

          // Vider la table existante
          $('#alimentsTable').DataTable().clear();

          // Ajouter les nouvelles données
          $('#alimentsTable').DataTable().rows.add(newData);

          // Redessiner la table
          $('#alimentsTable').DataTable().draw();


        }).fail(function(error) {
            console.log("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
        });
      }

      function ajaxPUTAliment(id, nom, type, glucides, lipides, sucres, proteines, fibres, energie) {
        // convertit les valeurs en entiers
        id = parseInt(id);
        glucides = parseInt(glucides) || 0;
        lipides = parseInt(lipides) || 0;
        sucres = parseInt(sucres) || 0;
        proteines = parseInt(proteines) || 0;
        fibres = parseInt(fibres) || 0;
        energie = parseInt(energie) || 0;
        
        $.ajax({
            url: RESTAPI_URL + "/aliments.php",
            method: "PUT",
            data: JSON.stringify({
              id_aliment: id,
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
        }).done(async function(response) {
          // On n'a pas trouvé d'autre manière d'actualiser le tableau, on a essayé des methodes avec .ajax.reload() ou encore .draw() mais sans succès
          // Récupérer les nouvelles données
          let newData = await ajaxGETAliment();

          // Vider la table existante
          $('#alimentsTable').DataTable().clear();

          // Ajouter les nouvelles données
          $('#alimentsTable').DataTable().rows.add(newData);

          // Redessiner la table
          $('#alimentsTable').DataTable().draw();
        }).fail(function(error) {
            console.log("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
        });
      }

      async function editButton(button) {
        let row = $(button).closest('tr');
        let data = $('#alimentsTable').DataTable().row(row).data();
        // Récupérer l'ID du type de l'aliment à modifier
        let nomTypeAliment = data.nom_type_aliment;

        // Aller chercher les types d'aliments
        let typesAliments = await ajaxGETTypeAliment();
        // Récupérer le type des aliments pour le form
        try {
            let data = await ajaxGETTypeAliment();
            // Parcourir les données pour les afficher dans le select
            data.forEach(type => {
              let selected = type.nom_type_aliment === nomTypeAliment ? 'selected' : ''; // Ajouter l'attribut selected si l'ID du type correspond à celui de l'aliment à modifier
              $("#editIdTypeAliment").append(`<option value="${type.id_type_aliment}" ${selected}>${type.nom_type_aliment}</option>`);
            });
        } catch (error) {
            console.log("La requête pour les types d'aliments s'est terminée en échec. Infos : " + JSON.stringify(error));
        }
        openEditForm(data);
      }

      async function openEditForm(aliment) {
        // Afficher le formulaire de modification
        $('#editCard').show();
        $('#editForm').show();

        // Pré-remplir le formulaire avec les données de l'aliment
        $('#idAliment').val(aliment.id_aliment); // Hidden
        $('#editNomAliment').val(aliment.nom_aliment);
        $('#editGlucides').val(aliment.glucides);
        $('#editLipides').val(aliment.lipides);
        $('#editSucres').val(aliment.sucres);
        $('#editProteines').val(aliment.proteines);
        $('#editFibres').val(aliment.fibres);
        $('#editEnergie').val(aliment.energie);
      }

      async function submitEditForm() {
        // prevent the form to be sent to the server
        event.preventDefault();

        let id = $("#idAliment").val();
        let nom = $("#editNomAliment").val();
        let type = $("#editIdTypeAliment").val();
        let glucides = $("#editGlucides").val();
        let lipides = $("#editLipides").val();
        let sucres = $("#editSucres").val();
        let proteines = $("#editProteines").val();
        let fibres = $("#editFibres").val();
        let energie = $("#editEnergie").val();

        if(verifierNom(nom)){
            return;
        }

        ajaxPUTAliment(id, nom, type, glucides, lipides, sucres, proteines, fibres, energie);

        // Supprimer les inputs
        document.getElementById("editForm").reset();

        $('#alimentsTable').DataTable().draw();


        // Cacher le form
        $("#editCard").hide();
      }

      function deleteButton(button) {
        let table = $('#alimentsTable').DataTable();
        let row = table.row($(button).parents('tr'));
        let id = row.data().id_aliment;
        
        ajaxDELETEAliment(id)
      }

      function ajaxDELETEAliment(id) {
        $.ajax({
            url: RESTAPI_URL + "/aliments.php",
            method: "DELETE",
            data: JSON.stringify({
                    id_aliment: id,
                }),
            dataType: "json"
        })
        .done(async function(response) {
          // Supprimer la ligne correspondante dans la table
          let table = $('#alimentsTable').DataTable();
          let row = table.row('#' + id);
          row.remove().draw(false);
          // On n'a pas trouvé d'autre manière d'actualiser le tableau, on a essayé des methodes avec .ajax.reload() ou encore .draw() mais sans succès
          // Récupérer les nouvelles données
          let newData = await ajaxGETAliment();

          // Vider la table existante
          $('#alimentsTable').DataTable().clear();

          // Ajouter les nouvelles données
          $('#alimentsTable').DataTable().rows.add(newData);

          // Redessiner la table
          $('#alimentsTable').DataTable().draw();
        })
        .fail(function(error) {
            console.log("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
        });
      }

      $(document).ready(async function(){
          
        // Récuperer le type des aliments pour le form
        try {
          let data = await ajaxGETTypeAliment();
          // Parcours des données pour les afficher dans le tableau
          data.forEach(type => {
            $("#inputType").append(`<option value="${type.id_type_aliment}">${type.nom_type_aliment}</option>`);
          });
        } catch (error) {
            console.log("La requête pour les types d'aliments s'est terminée en échec. Infos : " + JSON.stringify(error));
        }
    
        try {
          let data = await ajaxGETAliment();

          let alimentsTable = $('#alimentsTable').DataTable({
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
                } },
                { data: 'id_aliment', visible : false, render: function(data, type, row, meta) {
                  return '<div id="' + data + '">' + data + '</div>';
                }}
              ]
          });
        } catch (error) {
            console.log("La requête pour les aliments s'est terminée en échec. Infos : " + JSON.stringify(error));
        }
      });

  </script>
</body>

</html>