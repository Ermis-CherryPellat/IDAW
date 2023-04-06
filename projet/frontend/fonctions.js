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

  function calculerIMC() {
    var id_utilisateur = sessionStorage.getItem('id_utilisateur');

    // Envoyer une requête AJAX GET pour récupérer les informations de l'utilisateur
    $.ajax({
        type: 'GET',
        url: RESTAPI_URL + '/users.php?id_utilisateur=' + id_utilisateur ,
        dataType: 'json',
        success: function(user) {
            // Récupérer les valeurs des champs de l'objet utilisateur
            var sexe = user[0].nom_sexe;
            var poids_min = parseFloat(user[0].poids_min);
            var poids_max = parseFloat(user[0].poids_max);
            var poids= (poids_min+poids_max)/2;
            var taille_min = (user[0].taille_min)/100;
            var taille_max = (user[0].taille_max)/100;
            var taille=(taille_max+taille_min)/2;
            console.log('poids : ' + poids);
            // Calculer l'IMC en fonction du sexe
            var imc = 0;
            if (sexe === 'Masculin') {
                imc = poids/  (taille ** 2);

                console.log('imc : ' +imc );
            } else if (sexe === 'Feminin') {
                imc = poids / ((taille ** 2)) - 0.75;
            } else {
                console.log('Sexe non reconnu');
            }
            console.log('IMC calculé : ' + imc.toFixed(2));


            
            // Mettre à jour la valeur de l'IMC dans la balise HTML avec la classe 'imc'
            var imcElements = document.getElementsByClassName('imc');
            for (var i = 0; i < imcElements.length; i++) {
              imcElements[i].textContent = imc.toFixed(2);
            }
            
        }
    }).done(function() {
        console.log("La requête AJAX a réussi");
    }).fail(function() {
        console.log("La requête AJAX a échoué");
    });
}