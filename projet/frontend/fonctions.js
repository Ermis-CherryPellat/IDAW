function getUserInfo() {
    var id_utilisateur = sessionStorage.getItem('id_utilisateur');
  
    // Envoyer une requête AJAX GET pour récupérer les informations de l'utilisateur
    $.ajax({
      type: 'GET',
      url: RESTAPI_URL + '/users.php?id_utilisateur=' + id_utilisateur ,
      dataType: 'json',
      success: function(user) {
        // Récupérer les valeurs des champs de l'objet utilisateur
        var nom = user[0].nom;
        var prenom = user[0].prenom;
        var email = user[0].email;
        var sexe = user[0].nom_sexe;
        var poids_min = user[0].poids_min;
        var poids_max = user[0].poids_max;
        var taille_min = user[0].taille_min;
        var taille_max = user[0].taille_max;
        var age_min = user[0].age_min;
        var age_max = user[0].age_max;
        var nom_objectif = user[0].nom_objectif;
        var frequence_pratique_sportive = user[0].frequence_pratique_sportive;
  
        // Mettre à jour le contenu HTML avec les informations utilisateur récupérées
        var prenomElements = document.getElementsByClassName('prenom');
        for (var i = 0; i < prenomElements.length; i++) {
          prenomElements[i].textContent = prenom;
        }
  
        var nomElements = document.getElementsByClassName('nom');
        for (var i = 0; i < nomElements.length; i++) {
          nomElements[i].textContent = nom;
        }
  
        var nomObjectifElements = document.getElementsByClassName('nom_objectif');
        for (var i = 0; i < nomObjectifElements.length; i++) {
          nomObjectifElements[i].textContent = nom_objectif;
        }
  
        var emailElements = document.getElementsByClassName('email');
        for (var i = 0; i < emailElements.length; i++) {
          emailElements[i].textContent = email;
        }
  
        var sexeElements = document.getElementsByClassName('sexe');
        for (var i = 0; i < sexeElements.length; i++) {
          sexeElements[i].textContent = sexe;
        }
  
        var poidsElements = document.getElementsByClassName('poids');
        for (var i = 0; i < poidsElements.length; i++) {
          poidsElements[i].textContent = poids_min + "kg - " + poids_max + "kg";
        }
  
        var tailleElements = document.getElementsByClassName('taille');
        for (var i = 0; i < tailleElements.length; i++) {
          tailleElements[i].textContent = taille_min + "cm - " + taille_max + "cm";
        }
  
        var ageElements = document.getElementsByClassName('age');
        for (var i = 0; i < ageElements.length; i++) {
          ageElements[i].textContent = age_min + " ans - " + age_max + " ans";
        }
  
        var frequenceElements = document.getElementsByClassName('frequence');
        for (var i = 0; i < frequenceElements.length; i++) {
          frequenceElements[i].textContent = frequence_pratique_sportive;
        }
      }
    }).done(function() {
      console.log("La requête AJAX a réussi");
    }).fail(function() {
      console.log("La requête AJAX a échoué");
    });
  }