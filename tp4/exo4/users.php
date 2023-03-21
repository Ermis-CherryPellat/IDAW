<?php
    require_once('db_init.php');   
    
    

    require_once('config.php');
    $connectionString = "mysql:host=". _MYSQL_HOST;
    
    if(defined('_MYSQL_PORT'))
        $connectionString .= ";port=". _MYSQL_PORT;
        $connectionString .= ";dbname=" . _MYSQL_DBNAME;
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' );

    $pdo = NULL;

    try {
        $pdo = new PDO($connectionString,_MYSQL_USER,_MYSQL_PASSWORD,$options);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $erreur) {
        echo 'Erreur : '.$erreur->getMessage();
    }

    if(isset($_POST['new_nom']) && $_POST['new_nom'] != NULL && isset($_POST['new_email']) && $_POST['new_email'] != NULL && $_POST['submit']== 'Ajouter'){
      $nouveau_nom = $_POST['new_nom'];
      $nouveau_email = $_POST['new_email'];
      $ajout = $pdo->prepare("INSERT INTO USERS (id_user,nom,email) VALUES (NULL,:nom,:email)");
      $ajout->bindParam(":nom", $nouveau_nom);
      $ajout->bindParam(":email", $nouveau_email);
      $ajout->execute();
      echo 'Entrée ajoutée dans la table';
    }

    if(isset($_POST['delete']) ){
      $id_to_delete = $_POST['delete'];
      $pdo->exec("DELETE FROM USERS WHERE id_user = $id_to_delete;");
      echo 'Élement supprimé';
    }

    if(isset($_POST['change']) && ($_POST['submit'] == 'Modifier') && isset($_POST['new_nom']) && isset($_POST['new_email'])){
      $id_to_change = $_POST['id_to_change'];
      $nouveau_nom = $_POST['new_nom'];
      $nouveau_email = $_POST['new_email'];
      $pdo->exec("UPDATE USERS SET nom = '$nouveau_nom', email = '$nouveau_email' WHERE id_user = $id_to_change;");
      echo 'Élement changé';
    }

    // requête SQL pour récupérer les utilisateurs
    $request = $pdo->prepare("select * from USERS");
    $request->execute();
    $users = $request->fetchAll(PDO::FETCH_OBJ);

    

    function renderTableToHTML($user) {
    // affichage des utilisateurs dans un tableau HTML
    if (count($user) > 0) {
      echo '<table>';
      echo '<tr><th>ID</th><th>Nom</th><th>Adresse email</th><th></th><th></th></tr>';
      foreach ($user as $us) {
        echo "<tr>";
        echo '<td>'.$us->id_user.'</td>';
        echo '<td>'.$us->nom.'</td>';
        echo '<td>'.$us->email.'</td>';
        echo '<td><form action="" method="post"><button type="button hidden">Modifier</button><input type="hidden" name="change" value="'.$us->id_user.'"></form></td>';
        echo '<td><form action="" method="post"><button type="button hidden">Supprimer</button><input type="hidden" name="delete" value="'.$us->id_user.'"></form></td>';
        echo "</tr>";
      }
      echo "</table>";
    } else {
      echo "Aucun utilisateur trouvé.";
    }
    }
     

?>

<!doctype html> 

<html>
<head>
<meta charset="utf-8">
<title>TP4 – PDO - REST - CRUD - Tests – 20 mars 2023</title>
</head>

<body>
   

    <?php   
        renderTableToHTML($users)
    ?>

    <div>
        <form action="" method="post">

            <?php 
            if(isset($_POST['change']) ){
              $id_to_change = $_POST['change'];
              echo '<br> <label for="id_to_change">Id à changer</label>
              <input type="text" name="id_to_change" placeholder="Id à changer" value='.$id_to_change.'>';;
            } 
            ?>
            <br>
            
            <label for="nom">Nom</label>
            <input type="text" name="new_nom" placeholder="Votre nom...">

            <br>

            <label for="email">Email</label>
            <input type="text" name="new_email" placeholder="Votre email...">

            <br>
        
            <?php 
            if(isset($_POST['change']) ){
              echo '<input type="submit" name="submit" value="Modifier">';
              echo '<input type="submit" name="submit" value="Ajouter">';
            } else {
              echo '<input type="submit" name="submit" value="Ajouter">';
            }
            ?>
        </form>
    </div>
</body>

</html>