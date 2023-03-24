<!doctype html>
<html lang="fr">
    <head>
        <meta charset='utf-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <title>API Ajax test</title>
        <link href="style.css" rel="stylesheet" />
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
                <label for="inputId" class="col-sm-2 col-form-label">Id</label>
                <div class="col-sm-3">
                <input type="text" class="form-control" id="inputId" >
                </div>
            </div> 

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

            // affichage des utilisateurs dans un tableau HTML
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

            function editButton(){
                $(document).on('click', '.editBtn', function() {
                    // récupérer les données de la ligne
                    let row = $(this).closest('tr');
                    let id = row.find('td:eq(0)').text();
                    let nom = row.find('td:eq(1)').text();
                    let email = row.find('td:eq(2)').text();

                    // remplir le formulaire avec les données
                    $('#inputId').val(id);
                    $('#inputNom').val(nom);
                    $('#inputEmail').val(email);

                    // supprimer la ligne
                    row.remove();
                });
            }

            function deleteButton(e){
                // let row = $(event.target).closest("tr");
                // $(document).on('click', '.deleteBtn', function() {
                   let row = $(e).closest('tr');
                   row.remove();
                // });
            }

            function onFormSubmit() {
                // prevent the form to be sent to the server
                event.preventDefault();

                let nom = $("#inputNom").val();
                let id = $("#inputId").val();
                let email = $("#inputEmail").val();

                if(verifierNom(nom)){
                    return;
                }


                $("#usersTableBody").append(`
                    <tr>
                        <td>${id}</td>
                        <td>${nom}</td>
                        <td>${email}</td>
                        <td>
                            <button class="btn btn-primary editBtn" on-click="editButton(this)">Edit</button>
                        </td>
                        <td>
                            <button class="btn btn-danger deleteBtn" on-click="deleteButton(this)" >Delete</button>
                        </td>
                    </tr>
                `);
                
                // editButton();
                // deleteButton();

                //supprime les inputs
                document.getElementById("addUserForm").reset();

            }

            function ajaxGETUsers(){
                $.ajax(
                    {   url: RESTAPI_URL + "/users.php",
                        method: "GET",
                        dataType: "json"
                    }
                ).done(function(response){
                    let data = JSON.stringify(response);
                    // console.log(data);
                    return data;

                }).fail(function(error){
                    console.log("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
                });
            }

            function ajaxPOSTUsers(){

                // let nom = $("#inputNom").val();
                // let id = $("#inputId").val();
                // let email = $("#inputEmail").val();

                $.ajax(
                    {   url: RESTAPI_URL + "/users.php",
                        method: "POST",
                        // data: {
                        //     id_user: id,
                        //     nom: nom,
                        //     email: email
                        // }
                        dataType: "json"
                    }
                ).done(function(response){
                    let data = JSON.stringify(response);
                    // console.log(data);
                    // return data;
                }).fail(function(error){
                    console.log("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
                });
            }

            $(document).ready(function(){

                // let nom = $("#inputNom").val();
                // let id = $("#inputId").val();
                // let email = $("#inputEmail").val();

                let data = ajaxGETUsers();
                // data => data.json();

                // Parcours des données pour les afficher dans le tableau
                data.forEach(user => {
                    // $("#usersTableBody").append(`
                    // <tr>
                    //     <td>${user.id_user}</td>
                    //     <td>${user.nom}</td>
                    //     <td>${user.email}</td>
                    //     <td>
                    //         <button class="btn btn-primary editBtn">Edit</button>
                    //     </td>
                    //     <td>
                    //         <button class="btn btn-danger deleteBtn">Delete</button>
                    //     </td>
                    // </tr>
                    // `);
                    console.log("1");
                });
            });

        </script>
    </body>
</html>