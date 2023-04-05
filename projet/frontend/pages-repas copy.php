<!DOCTYPE html>
<html lang="en">

<?php 

  require_once("head.php");
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
            <h5 class="card-title">Veuillez entrer un repas</h5>
            <form id="addMealForm">
              <div class="form-group">
                  <label for="datetime">Date et heure du repas</label>
                  <input type="datetime-local" class="form-control" id="datetime" name="datetime" required>
              </div>
              <div class="form-group">
                  <label for="mealType">Type de repas</label>
                  <select class="form-control" id="typeRepas" name="typeRepas" required>
                  </select>
              </div>
              <div id="mealFoods">
                  <div class="form-group mealFood">
                      <label for="searchBox">Rechercher un aliment :</label>
                      <input type="text" class="form-control" id="searchBox" placeholder="Entrez le nom d'un aliment...">
                      <!-- <div class="dropdown" id="listeAliment" name="listeAliment">
                        <button class="btn bouton_form dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Sélectionner un aliment
                        </button>
                      </div> -->

                      <div class="dropdown" aria-labelledby="dropdownMenuButton" id="listeAliment">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Sélectionnez un aliment
                        </button>
                        <input class="form-control" type="text" placeholder="Rechercher un aliment" id="searchBox">
                      </div>


                      <input type="number" class="form-control quantity" name="quantity" placeholder="Quantité en grammes" required>
                      <button type="button" class="btn btn-secondary bouton_form removeFoodBtn">Supprimer</button>
                  </div>
              </div>
              <!-- <div id="mealFoods">
                <div class="form-group mealFood">
                    <label for="food1">Aliment 1</label>
                      <table id="alimentsTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nom de l'aliment</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                      <label for="searchBox">Rechercher un aliment :</label>
                      <input type="text" class="form-control" id="searchBox" placeholder="Entrez le nom d'un aliment...">
                    </div>
                    <input type="number" class="form-control quantity" name="quantity" placeholder="Quantité en grammes" required>
                    <button type="button" class="btn btn-secondary bouton_form removeFoodBtn">Supprimer</button>
                </div>
              </div> -->
              <button type="button" class="btn btn-primary bouton_form" id="addFoodBtn">Ajouter un aliment</button>
              <button type="submit" class="btn btn-success bouton_form">Enregistrer le repas</button>
            </form>

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

  </main><!-- End #main -->

  <?php require_once("footer.php"); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php require_once("js_files.html"); ?>

  <script>
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

    // On ajoute un nouvel aliment quand le bouton "Ajouter un aliment" est cliqué
    $('#addFoodBtn').click(function() {
      // On clone la première div d'aliment et on la modifie pour qu'elle soit unique
      var newMealFood = $('.mealFood').first().clone();
      var lastIndex = $('#mealFoods .mealFood').length;
      newMealFood.find('.food').attr('name', 'aliment[' + lastIndex + ']').val('');
      newMealFood.find('.quantity').attr('name', 'quantity[' + lastIndex + ']').val('');
      newMealFood.find('.removeFoodBtn').show();
      // On ajoute la nouvelle div d'aliment à la liste
      $('#mealFoods').append(newMealFood);
    });

    // On supprime l'aliment correspondant à un bouton "Supprimer" quand il est cliqué
    // + on vérifier s'il y a plus d'un aliment avant de le supprimer
    $('#mealFoods').on('click', '.removeFoodBtn', function() {
      if($('#mealFoods > .form-group').length > 1) {
      $(this).closest('.form-group').remove();
      }    
    });


    



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

      // Récupérer les aliments et les stocker dans une variable
    let aliments = [];

// Fonction pour filtrer les aliments en fonction de la recherche
function filterAliments(searchTerm) {
    return aliments.filter(function(aliment) {
        return aliment.nom_aliment.toLowerCase().includes(searchTerm.toLowerCase());
    });
}

// Fonction pour mettre à jour la liste déroulante des aliments
function updateAlimentsDropdown(searchTerm) {
    let filteredAliments = filterAliments(searchTerm);
    $("#listeAliment").empty();
    if (filteredAliments.length > 0) {
        filteredAliments.forEach(function(aliment) {
          console.log("ok");
            $("#listeAliment").append(`<a class="dropdown-item" href="#" data-aliment-id="${aliment.id_aliment}">${aliment.nom_aliment}</a>`);
        });
    } else {
        $("#listeAliment").append(`<span class="dropdown-item text-muted">Aucun aliment trouvé</span>`);
    }
}

// Initialisation de la recherche d'aliments
$("#searchBox").on("input", function() {
    let searchTerm = $(this).val();
    updateAlimentsDropdown(searchTerm);
});

// Gestion de la sélection d'un aliment dans la liste déroulante
$("#listeAliment").on("click", ".dropdown-item", function(event) {
    event.preventDefault();
    let alimentId = $(this).data("aliment-id");
    let alimentNom = $(this).text();
    $("#listeAliment").val(alimentId);
    $("#dropdownMenuButton").text(alimentNom);
});
  
// Récupération des aliments et initialisation de la liste déroulante des aliments
(async function() {
    try {
        let response = await ajaxGETAliment();
        aliments = response;
    } catch (error) {
        console.log("La requête pour les aliments s'est terminée en échec. Infos : " + JSON.stringify(error));
    }
})();

// Gestion de la sélection d'un aliment dans la liste déroulante
$("#listeAliment").on("click", ".dropdown-item", function(event) {
    event.preventDefault();
    let alimentId = $(this).data("aliment-id");
    let alimentNom = $(this).text();
    $("#listeAliment").val(alimentId);
    $("#dropdownMenuButton").text(alimentNom);
});

      // Récuperer les aliments pour le form
      // try {
      //   let data = await ajaxGETAliment();
      //   // Parcours des données pour les afficher dans le tableau
      //   data.forEach(aliment => {
      //     $("#listeAliment").append(`<option value="${aliment.id_aliment}">${aliment.nom_aliment}</option>`);
      //   });
      // } catch (error) {
      //     console.log("La requête pour les types de repas s'est terminée en échec. Infos : " + JSON.stringify(error));
      // }

      //////////
      // let options = {
      //   ajax: {
      //     url: RESTAPI_URL + "/aliments.php",
      //     dataSrc: "",
      //   },
      //   columns: [
      //     { data: "nom_aliment" },
      //   ],
      // };

      // // Initialiser le DataTable avec les options
      // $('#alimentsTable').DataTable(options);

      // $('#alimentsTable tbody').on('click', 'tr', function() {
      //   // Récupération des données de la ligne sélectionnée
      //   var data = table.row( this ).data();

      //   // Ajout des données à votre formulaire
      //   $('#selectedAliment').val(data[0]); // Suppose que l'id de l'aliment est dans la première colonne du tableau
      // });
    });
   

  </script>

</body>

</html>