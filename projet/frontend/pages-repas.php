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
            <form id="addMealForm">
              <div class="form-group">
                <label for="datetime">Date et heure du repas</label>
                <input type="datetime-local" class="form-control" id="datetime" name="datetime" required>
              </div>
              <div class="form-group">
                <label for="mealType">Type de repas</label>
                <select class="form-control" id="mealType" name="mealType" required>
                  <option value="">Sélectionnez un type de repas</option>
                  <option value="petit_dejeuner">Petit-déjeuner</option>
                  <option value="dejeuner">Déjeuner</option>
                  <option value="diner">Dîner</option>
                  <option value="collation">Collation</option>
                </select>
              </div>
              <div id="mealFoods">
                <div class="form-group">
                  <label for="food1">Aliment 1</label>
                  <input type="text" class="form-control food" id="food1" name="food1" required>
                  <input type="number" class="form-control quantity" id="quantity1" name="quantity1" placeholder="Quantité en grammes" required>
                </div>
              </div>
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

      $(document).on('click', '#addFoodBtn', function() {
        var foodCount = $('.food').length + 1;
        $('#mealFoods').append('<div class="form-group"><label for="food' + foodCount + '">Aliment ' + foodCount + '</label><input type="text" class="form-control food" id="food' + foodCount + '" name="food' + foodCount + '" required><input type="number" class="form-control quantity" id="quantity' + foodCount + '" name="quantity' + foodCount + '" placeholder="Quantité en grammes" required></div>');
      });
  </script>

</body>

</html>