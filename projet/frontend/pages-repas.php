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
      </div>
    </section>
    <section class="section">
      <div class="row">
          <div class="col-lg-12">
              <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">Historique des repas consommés</h5>
                      <p>Retrouvez ici tous les repas que vous avez consommés.</p>

                      <!-- Modal de détail d'un repas, qui finalement n'est pas une modal car nous n'avons pas réussi à l'afficher en tant que modal-->
                      <div id="viewRepasModal" class="modal2 hidden" >
                          <div class="modal-content">
                            <span id="close-modal2" class="close" onclick="fermerModal()">&times;</span>
                            <h5 class="card-title">Détails du repas</h5>
                            <div class="modal-body">
                            </div>
                          </div>
                      </div>

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

    // ============ JavaScript pour la modale d'ajout d'un repas ============
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
        }).done(async function(response) {
          let newRepasId = response.id_repas;
          resolve(newRepasId);

          // On n'a pas trouvé d'autre manière d'actualiser le tableau, on a essayé des methodes avec .ajax.reload() ou encore .draw() mais sans succès
          // Récupérer les nouvelles données
          let newData = await ajaxGETRepas(user);

          // Vider la table existante
          $('#repasTable').DataTable().clear();

          // Ajouter les nouvelles données
          $('#repasTable').DataTable().rows.add(newData);

          // Redessiner la table
          $('#repasTable').DataTable().draw();

          // console.log(response);


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

    let repasTable; // Déclaration de repasTable dans une portée accessible à viewButton
    let typeRepasData;
    
    async function viewButton(button, repasTable) {
      let repas = repasTable.row(button.closest('tr')).data();
      console.log(repas);
      let typeRepas = typeRepasData.find(typeRepas => typeRepas.id_type_repas === repas.id_type_repas);

      let modalContent = '<p>Date de consommation : ' + repas.date_consommation + '</p>' +
                        '<p>Type de repas : ' + (typeRepas ? typeRepas.nom_type_repas : '') + '</p>';

      try {
        let alimentConsommeData = await ajaxGETAlimentConsomme(repas.id_repas);
        let alimentData = await ajaxGETAliment();

        if (alimentConsommeData.length > 0) {
          modalContent += '<p>Contenu du repas :</p><ul>';
          for (let alimentConsomme of alimentConsommeData) {
            if (alimentConsomme.id_repas === repas.id_repas) { // vérifier si l'aliment consommé appartient au repas actuel
              let aliment = alimentData.find(aliment => aliment.id_aliment === alimentConsomme.id_aliment);
              if (aliment) {
                modalContent += '<li>' + aliment.nom_aliment + ' (' + alimentConsomme.masse + ' g)</li>';
              }
            }
          }
          modalContent += '</ul>';
        } else {
          modalContent += '<p>Aucun aliment consommé dans ce repas.</p>';
        }
      } catch (error) {
        console.log("La requête pour les aliments consommés s'est terminée en échec. Infos : " + JSON.stringify(error));
      }

      // Ouvrir la modale
      $('#viewRepasModal .modal-body').html(modalContent);
      ouvrirModal();
    }


    function ouvrirModal() {
      var modal = document.getElementById("viewRepasModal");
      modal.classList.remove("hidden");
    }

    function fermerModal() {
      var modal = document.getElementById("viewRepasModal");
      modal.classList.add("hidden");
    }


    $(document).ready(async function(){

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
                return '<button class="btn btn-primary" onclick="chooseButton(this)" >Choisir</button>';
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
      typeRepasData = await ajaxGETTypeRepas();

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
              return '<a type="button" class="btn btn-primary " onclick="viewButton(this, repasTable)">Voir</a>';
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