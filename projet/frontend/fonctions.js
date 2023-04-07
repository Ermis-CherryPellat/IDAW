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
        console.log('tranche poids','poids');
  
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

// fonction pour récupérer les nutiments consommés par le user
function calculerBesoinsNutritionnels() {
  var id_utilisateur = sessionStorage.getItem('id_utilisateur');

  // Envoyer une requête AJAX GET pour récupérer les informations de l'utilisateur
  $.ajax({
      type: 'GET',
      url: RESTAPI_URL + '/users.php?id_utilisateur=' + id_utilisateur,
      dataType: 'json',
      success: function(user) {
          // Récupérer les valeurs des champs de l'objet utilisateur
          var sexe = user[0].nom_sexe;
          var poids_min = parseFloat(user[0].poids_min);
          var poids_max = parseFloat(user[0].poids_max);
          var poids = (poids_min + poids_max) / 2;
          var taille_min = parseFloat(user[0].taille_min);
          var taille_max = parseFloat(user[0].taille_max);
          var age_min = parseFloat(user[0].age_min);
          var age_max = parseFloat(user[0].age_max);
          var taille = (taille_min + taille_max) / 2;
          var age = (age_min + age_max) / 2;
          var niveauActiviteString = user[0].frequence_pratique_sportive;
          var niveauActivite;
          

          switch (niveauActiviteString) {
            case "bas":
              niveauActivite = 1.2;
            break;
             case "moyen":
              niveauActivite = 1.4;
            break;
              case "élevé":
              niveauActivite = 1.6;
            break;
            default:
    console.log("Niveau d'activité non reconnu");
              }

              
          
          // Calculer les besoins nutritionnels en fonction du sexe, de la taille, du poids, de l'âge et du niveau d'activité physique
          var besoinsNutritionnels = {};
          if (sexe === 'Masculin') {
              besoinsNutritionnels.calories = (Math.round((10 * poids) + (6.25 * taille) - (5 * age) + 5) * niveauActivite).toFixed(2);
              besoinsNutritionnels.proteines = Math.round(1.2 * poids);
              besoinsNutritionnels.glucides = Math.round(besoinsNutritionnels.calories * 0.5 / 4);
              besoinsNutritionnels.lipides = Math.round(besoinsNutritionnels.calories * 0.3 / 9);
              besoinsNutritionnels.fibres = Math.round(14 * poids / 1000);
              besoinsNutritionnels.sucres = Math.round(besoinsNutritionnels.glucides * 0.1);
          } else if (sexe === 'Feminin') {
              besoinsNutritionnels.calories = (Math.round((10 * poids) + (6.25 * taille) - (5 * age) - 161) * niveauActivite).toFixed(2);
              besoinsNutritionnels.proteines = Math.round(1.2 * poids);
              besoinsNutritionnels.glucides = Math.round(besoinsNutritionnels.calories * 0.5 / 4);
              besoinsNutritionnels.lipides = Math.round(besoinsNutritionnels.calories * 0.3 / 9);
              besoinsNutritionnels.fibres = Math.round(14 * poids / 1000);
              besoinsNutritionnels.sucres = Math.round(besoinsNutritionnels.glucides * 0.1);
              
          } else {
              console.log('Sexe non reconnu');
          }
          sessionStorage.setItem('besoinsNutritionnels', JSON.stringify(besoinsNutritionnels));
          

          // Mettre à jour la valeur des besoins nutritionnels dans les balises HTML correspondantes
          var caloriesElements = document.getElementsByClassName('calories');
          for (var i = 0; i < caloriesElements.length; i++) {
              var calories = Math.floor(besoinsNutritionnels.calories);
              caloriesElements[i].textContent = calories;
          
          

          

              }

              var proteinesElements = document.getElementsByClassName('proteines');
              for (var i = 0; i < proteinesElements.length; i++) {
                  proteinesElements[i].textContent = besoinsNutritionnels.proteines;
              }
        
              var glucidesElements = document.getElementsByClassName('glucides');
              for (var i = 0; i < glucidesElements.length; i++) {
                  glucidesElements[i].textContent = besoinsNutritionnels.glucides;
              }
        
              var lipidesElements = document.getElementsByClassName('lipides');
              for (var i = 0; i < lipidesElements.length; i++) {
                  lipidesElements[i].textContent = besoinsNutritionnels.lipides;
              }
        
              var fibresElements = document.getElementsByClassName('fibres');
              for (var i = 0; i < fibresElements.length; i++) {
                  fibresElements[i].textContent = besoinsNutritionnels.fibres;
              }
        
              var sucresElements = document.getElementsByClassName('sucres');
              for (var i = 0; i < sucresElements.length; i++) {
                  sucresElements[i].textContent = besoinsNutritionnels.sucres;
              }



            
            }
          }).done(function() {
            console.log("La requête AJAX a réussi");
        }).fail(function() {
            console.log("La requête AJAX a échoué");
        });
    }

function CalculNutritionUser() {
  var id_utilisateur = sessionStorage.getItem('id_utilisateur');

  $.ajax({
    type: 'GET',
    url: RESTAPI_URL + '/nutriments.php?id_utilisateur=' + id_utilisateur ,
    dataType: 'json',
    success: function(data) {
      
      console.log('data',data);
      sessionStorage.setItem('MoyNutrimentJour', JSON.stringify(data[0]));
      sessionStorage.setItem('Calories', JSON.stringify(data[0].avg_energie));
      

            // Sélectionnez le span HTML en utilisant l'ID ou la classe
            var spanCalories = document.querySelector('#span-calories'); // Utilisez # pour sélectionner l'ID ou . pour sélectionner la classe

            // Ajouter la valeur de Calories dans le span HTML
            var calories = Math.floor(data[0].avg_energie);
            spanCalories.innerText = calories;

      
      


      


    }
    }).done(function() {
      console.log("La requête AJAX a réussi");
    }).fail(function() {
      console.log("La requête AJAX a échoué");
    });
  }

  function NutrimentUser(){
    var besoinsNutritionnels = JSON.parse(sessionStorage.getItem('besoinsNutritionnels'));
    var MoyNutritionUser = JSON.parse(sessionStorage.getItem('MoyNutrimentJour'));
    var ProtUser = MoyNutritionUser.avg_proteines;
    

    var GlucUser = MoyNutritionUser.avg_glucides;
    var LipUser = MoyNutritionUser.avg_lipides;
    var FibUser = MoyNutritionUser.avg_fibres;
    var SucrUser = MoyNutritionUser.avg_sucres;
    
    
    var objectifProt = besoinsNutritionnels.proteines;
    var objectifGluc =  besoinsNutritionnels.glucides;
    var objectifLip  =  besoinsNutritionnels.lipides;
    var objectifFibres = besoinsNutritionnels.fibres;
    var objectiSucres =   besoinsNutritionnels.sucres;
  
  
    // Données du diagramme à barres
    const data = [objectifProt,objectifGluc,objectifLip,objectifFibres,objectiSucres];
    console.log('objectif',data);
    const data2 = [ProtUser,GlucUser,LipUser,FibUser,SucrUser];
  
    const dataPourcentage = [];
    for (let i = 0; i < data.length; i++) {
    dataPourcentage.push((data2[i] / data[i]) * 100);

    
  }
  console.log('POURCENTAGE',dataPourcentage);
  sessionStorage.setItem('Nutriments consommés',dataPourcentage);
}

 
function drawDiagram() {
  const percentages = sessionStorage.getItem('Nutriments consommés');
  const titles = ["Protéines", "Glucides", "Lipides", "Fibres", "Sucres"];
  const colors = ["#4CAF50", "#2196F3", "#FFC107", "#FF5722", "#9C27B0"];

  const svg = d3.select("body")
              .append("svg")
              .attr("width", 500)
              .attr("height", 300);
  
  const chartBars = svg.selectAll("rect")
                      .data(percentages)
                      .enter()
                      .append("rect")
                      .attr("class", "chart-bar")
                      .attr("x", (d, i) => i * 80 + 50)
                      .attr("y", 150)
                      .attr("height", 0)
                      .attr("width", 50)
                      .attr("fill", (d, i) => colors[i]);
  
  chartBars.transition()
           .delay((d, i) => i * 500)
           .attr("y", (d) => 150 - 1.5 * d)
           .attr("height", (d) => 1.5 * d);
  
  const chartFills = svg.selectAll(".chart-fill")
                        .data(percentages)
                        .enter()
                        .append("rect")
                        .attr("class", "chart-fill")
                        .attr("x", (d, i) => i * 80 + 50)
                        .attr("y", 150)
                        .attr("height", 0)
                        .attr("width", 50)
                        .attr("fill", (d, i) => colors[i]);
  
  chartFills.transition()
            .delay((d, i) => i * 500)
            .attr("y", (d) => 150 - 1.5 * d)
            .attr("height", (d) => 1.5 * d);
  
  const chartLabels = svg.selectAll(".chart-label")
                         .data(percentages)
                         .enter()
                         .append("text")
                         .attr("class", "chart-label")
                         .text((d) => `${d}%`)
                         .attr("x", (d, i) => i * 80 + 75)
                         .attr("y", (d) => 150 - 1.5 * d - 5);
  
  const chartTitles = svg.selectAll(".chart-title")
                         .data(titles)
                         .enter()
                         .append("text")
                         .attr("class", "chart-title")
                         .text((d) => d)
                         .attr("x", (d, i) => i * 80 + 75)
                         .attr("y", 210);
}



  




  

  

 


























