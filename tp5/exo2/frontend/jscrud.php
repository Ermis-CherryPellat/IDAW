<!doctype html>
<html lang="fr">
    <head>
        <meta charset='utf-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <title>API Ajax test</title>
        <link href="style.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
        <script src="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.js"></script>
    </head>
    <body>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Nom</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
                <tbody id="usersTableBody">
            </tbody>
        </table>

        <form id="addUserForm" action="" onsubmit="onFormSubmit();">
          
            <div class="form-group row">
                <label for="inputNom" class="col-sm-2 col-form-label">Nom*</label>
                <div class="col-sm-3">
                <input type="text" class="form-control" id="inputNom" >
                </div>
            </div> 
            
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-3">
                <input type="text" class="form-control" id="inputEmail" >
                </div>
            </div> 

            <div class="form-group row">
                    <span class="col-sm-2"></span>
                <div class="col-sm-2">
                <button type="submit" class="btn btn-primary form-control">Submit</button>
                </div>
            </div>
        </form>

        <script>
            let RESTAPI_URL = "<?php 
                require_once('config.php'); 
                echo URL_API;
            ?>";

            <?php function renderTableToHTML($user) {
             if (count($user) > 0) {
                echo '<table>';
                echo '<tr><th>ID</th><th>Nom</th><th>Adresse email</th><th></th><th></th></tr>';
                foreach ($user as $us) {
                    echo "<tr>";
                    echo '<td>'.$us->id_user.'</td>';
                    echo '<td>'.$us->nom.'</td>';
                    echo '<td>'.$us->email.'</td>';
                    echo '<td><form action="" method="post"><button type="submit">Modifier</button><input type="hidden" name="change" value="'.$us->id_user.'"></form></td>';
                    echo '<td><form action="" method="post"><button type="submit hidden">Supprimer</button><input type="hidden" name="delete" value="'.$us->id_user.'"></form></td>';
                    echo "</tr>";
                }
                    echo "</table>";
                } else {
                    echo "Aucun utilisateur trouvé.";
                } 
            } ?>

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

            function editButton(e){
                // récupérer les données de la ligne
                let row = $(e).closest('tr');
                let id = row.find('td:eq(0)').text();
                let nom = row.find('td:eq(1)').text();
                let email = row.find('td:eq(2)').text();

                // remplir le formulaire avec les données
                $('#inputId').val(id);
                $('#inputNom').val(nom);
                $('#inputEmail').val(email);

                // supprimer la ligne
                row.remove();
            }

            function deleteButton(e) {
                let id = $(e).closest('tr').data('id');
                ajaxDELETEUser(id);
                $(e).closest('tr').remove();
            }

            function onFormSubmit() {
                // prevent the form to be sent to the server
                event.preventDefault();

                let nom = $("#inputNom").val();
                // let id = $("#inputId").val();
                let email = $("#inputEmail").val();

                if(verifierNom(nom)){
                    return;
                }

                ajaxPOSTUser(nom,email);

                //supprime les inputs
                document.getElementById("addUserForm").reset();
            }

            function ajaxGETUsers(){
                return new Promise(function(resolve, reject) {
                    $.ajax({
                        url: RESTAPI_URL + "/users.php",
                        method: "GET",
                        dataType: "json"
                    }).done(function(response){
                        resolve(response);
                    }).fail(function(error){
                        reject(error);
                    });
                });
            }

            function ajaxDELETEUser(id) {
                $.ajax({
                    url: RESTAPI_URL + "/users.php?id=" + id,
                    method: "DELETE",
                    dataType: "json"
                })
                .done(function(response) {
                    // Supprime la ligne du tableau correspondant à l'utilisateur supprimé
                    $("#usersTableBody").find(`tr[data-id="${id}"]`).remove();
                })
                .fail(function(error) {
                    console.log("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
                });
            }

            function ajaxPOSTUser(nom1,email1){
                $.ajax(
                    {   url: RESTAPI_URL + "/users.php",
                        method: "POST",
                        data: JSON.stringify({
                            nom: nom1,
                            email: email1
                        }),
                        dataType: "json"
                    }
                ).done(function(response){
                    let id1 = response.id;
                    $("#usersTableBody").append(`
                        <tr>
                            <td>${id1}</td>
                            <td>${nom1}</td>
                            <td>${email1}</td>
                            <td>
                                <button class="btn btn-primary editBtn" onclick="editButton(this)">Edit</button>
                            </td>
                            <td>
                                <button class="btn btn-danger deleteBtn" onclick="deleteButton(this)" >Delete</button>
                            </td>
                        </tr>
                    `);
                }).fail(function(error){
                    console.log("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
                });
            }


            $(document).ready(async function(){
                
                try {
                    let data = await ajaxGETUsers();
                    // Parcours des données pour les afficher dans le tableau
                    data.forEach(user => {
                    $("#usersTableBody").append(`
                    <tr>
                        <td>${user.id_user}</td>
                        <td>${user.nom}</td>
                        <td>${user.email}</td>
                        <td>
                            <button class="btn btn-primary editBtn" onclick="editButton(this)">Edit</button>
                        </td>
                        <td>
                            <button class="btn btn-danger deleteBtn" onclick="deleteButton(this)" >Delete</button>
                        </td>
                    </tr>
                    `);
                    });
                } catch (error) {
                    console.log("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
                }
            
            });

        </script>
    </body>
</html>