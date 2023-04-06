<!DOCTYPE html>
<html lang="en">

<?php 

  require_once("head.html");
  require_once("header.php");
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
              <h5 class="card-title">Un nouveau repas ... ?</h5>
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
                      <p>Ici on ajoutera un tableau avec la liste des repas consommés précédents</p>
                      <table id="repasTable" class="display">
                          <thead>
                              <tr>
                                  <th>Type de repas</th>
                                  <th>Date de consommation</th>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody></tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
    </section>


    <!-- La modale (j'ajoute un z-index à la modale et à la sidebar pour que la modale apparaisse par dessus) -->
    <div id="modal" class="modal">
      <div class="modal-content">
        <span id="close-modal" class="close">&times;</span>
        <h5 class="card-title">Ajout d'un repas</h5>
        <?php require_once("modale-ajout-repas.php"); ?>
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


    // On supprime l'aliment correspondant à un bouton "Supprimer" quand il est cliqué
    // + on vérifier s'il y a plus d'un aliment avant de le supprimer
    $('#alimentsChoisis').on('click', '.removeFoodBtn', function() {
      $(this).closest('.aliments-group').remove();
    });

    async function onFormSubmit() {
      // prevent the form to be sent to the server
      event.preventDefault();

      let user = window.sessionStorage.getItem('id_utilisateur');
      let type = $("#typeRepas").val(); //récupère l'id_type_repas
      let date = $("#datetime").val();

      let newRepas = await ajaxPOSTRepas(user, type, date);
      console.log(newRepas);
      // parcourir chaque aliment ajouté dans le formulaire
      $(".aliments-group").each(async function() {
        let quantity = $(this).find(".quantity").val();
        let idAliment = $(this).attr("id").replace("aliment", "");
        await ajaxPOSTAlimentConsomme(quantity, idAliment, newRepas);
      });

      //supprime les inputs et ferme la modale
      document.getElementById("addRepasForm").reset();
      modal.style.display = "none";
    }





    // ============ JavaScript pour les API ============
    // let RESTAPI_URL = "<?php 
    //       require_once('config.php'); 
    //       echo URL_API;
    //   ?>";

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

    function ajaxPOSTRepas(user, type, date) {
      console.log(user, type, date);
      return new Promise(function(resolve, reject) {
        $.ajax({
            url: RESTAPI_URL + "/repas.php",
            method: "POST",
            data: JSON.stringify({
                id_utilisateur: user,
                id_type_repas: type,
                date_consommation: date
            }),
            dataType: "json"
        }).done(function(response) {
            let newRepasId = response.id_repas;
            resolve(newRepasId);
        }).fail(function(error) {
            console.log("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
            reject(error);
        });
      });
    }


    function ajaxGETAlimentConsomme(){
      return new Promise(function(resolve, reject) {
        $.ajax({
            url: RESTAPI_URL + "/aliment_consomme.php",
            method: "GET",
            dataType: "json"
        }).done(function(response){
            resolve(response);
        }).fail(function(error){
            reject(error);
        });
      });
    }

    function ajaxPOSTAlimentConsomme(masse, id_aliment, id_repas) {
      $.ajax({
          url: RESTAPI_URL + "/aliment_consomme.php",
          method: "POST",
          data: JSON.stringify({
            masse: masse,
            id_aliment: id_aliment,
            id_repas: id_repas
          }),
          dataType: "json"
      }).done(async function(response) {
        
        // ============== A modifier quand j'aurai fait l'historique des repas !!! ==============

        // // On n'a pas trouvé d'autre manière d'actualiser le tableau, on a essayé des methodes avec .ajax.reload() ou encore .draw() mais sans succès
        // // Récupérer les nouvelles données
        // let newData = await ajaxGETAliment();

        // // Vider la table existante
        // $('#alimentsTable').DataTable().clear();

        // // Ajouter les nouvelles données
        // $('#alimentsTable').DataTable().rows.add(newData);

        // // Redessiner la table
        // $('#alimentsTable').DataTable().draw();

        // console.log(response);

      }).fail(function(error) {
          console.log("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
      });
    }

    function ajaxGETRepas(id_utilisateur){
      return new Promise(function(resolve, reject) {
        $.ajax({
          url: RESTAPI_URL + "/repas.php?id_utilisateur=" + id_utilisateur,
          method: "GET",
          dataType: "json"
        }).done(function(response){
            resolve(response);
        }).fail(function(error){
            reject(error);
        });
      });
    }

    async function chooseButton(button) {
      let row = $(button).closest('tr');
      let data = $('#alimentsTable').DataTable().row(row).data();
      let nomAliment = data.nom_aliment;
      let idAliment = data.id_aliment;

      try {
            $("#alimentsChoisis").append(`<div class="aliments-group" id="aliment${idAliment}">
              <div class="row rowAliment">
                <div class="col-lg-3 alimentRepas">
                  <label for="aliment${idAliment}">${nomAliment}</label>
                </div>
                <div class="col-lg-3 alimentRepas">
                  <input type="number" class="form-control quantity" name="quantity" placeholder="Quantité en grammes" required>
                </div>
                <div class="col-lg-3 alimentRepas">
                  <button type="button" class="btn btn-secondary bouton_form removeFoodBtn">Supprimer</button>
                </div>
              </div>
              `);
          
      } catch (error) {
          console.log("La séléction d'aliment s'est terminée en échec. Infos : " + JSON.stringify(error));
      }
    }

    function viewButton(button, repasTable) {
      let repas = repasTable.row($(button).parents('tr')).data();
      let typeRepas = typeRepasData.find(typeRepas => typeRepas.id_type_repas === repas.id_type_repas);

      let modalContent = '<p>Date de consommation : ' + repas.date_consommation + '</p>' +
                        '<p>Type de repas : ' + (typeRepas ? typeRepas.nom_type_repas : '') + '</p>';

      // Ajouter le contenu des aliments du repas
      // ...
      
      // Ouvrir la modale
      $('#viewRepasModal .modal-body').html(modalContent);
      $('#viewRepasModal').modal('show');
    }

    $(document).ready(async function(){
    let repasTable; // Déclaration de repasTable dans une portée accessible à viewButton

    // Récuperer le type des aliments pour le form
    try {
      let data = await ajaxGETTypeRepas();
      // Parcours des données pour les afficher dans le tableau
      data.forEach(type => {
        $("#typeRepas").append(`<option value="${type.id_type_repas}">${type.nom_type_repas}</option>`);
      });
    } catch (error) {
        console.log("La requête pour les types de repas s'est terminée en échec. Infos : " + JSON.stringify(error));
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
                return '<button class="btn btn-primary" onclick="chooseButton(this)">Choisir</button>';
            } },
            { data: 'id_aliment', visible : false, render: function(data, type, row, meta) {
              return '<div id="' + data + '">' + data + '</div>';
            }}
          ]
      });
    } catch (error) {
        console.log("La requête pour les aliments s'est terminée en échec. Infos : " + JSON.stringify(error));
    }
    
    try {
      let id_utilisateur = window.sessionStorage.getItem('id_utilisateur');
      let repasData = await ajaxGETRepas(id_utilisateur);
      let typeRepasData = await ajaxGETTypeRepas();

      repasTable = $('#repasTable').DataTable({ 
        pageLength: 25,
        paging: true,
        data: repasData,
        columns: [
          { data: 'date_consommation' },
          {
            data: null, render: function (data, type, row, meta) {
              let typeRepas = typeRepasData.find(typeRepas => typeRepas.id_type_repas === row.id_type_repas);
              return typeRepas ? typeRepas.nom_type_repas : '';
            }
          },
          {
            data: null, render: function (data, type, row, meta) {
              return '<button class="btn " onclick="viewButton(this)">Voir</button>';
            }
          },
          { data: 'id_repas', visible: false }
            ]
          });
        } catch (error) {
          console.log("La requête pour les repas s'est terminée en échec. Infos : " + JSON.stringify(error));
        }
      });

  </script>

</body>

</html>