<?php
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

    // requête SQL pour récupérer les utilisateurs
    $request = $pdo->prepare("select * from users");
    $request->execute();
    $users = $request->fetchAll(PDO::FETCH_OBJ);

    // affichage des utilisateurs dans un tableau HTML
    if (count($users) > 0) {
      echo "<table>";
      echo "<tr><th>ID</th><th>Nom</th><th>Adresse email</th></tr>";
      foreach ($users as $user) {
        echo "<tr>";
        echo "<td>".$user->id_user."</td>";
        echo "<td>".$user->nom."</td>";
        echo "<td>".$user->email."</td>";
        
        echo "</tr>";
      }
      echo "</table>";
    } else {
      echo "Aucun utilisateur trouvé.";
    }
    
    // echo'<div class="container">
	
    //     <div class="table">
    //         <div class="table-header">
    //             <div class="header__item">User Id</div>
    //             <div class="header__item">Name</div>
    //             <div class="header__item">Email</div>
    //         </div>';

    // echo '
    //         <div class="table-content">	
    //             <div class="table-row">		
    //                 <div class="table-data">Tom</div>
    //                 <div class="table-data">2</div>
    //                 <div class="table-data">0</div>
    //             </div>
    //             <div class="table-row">
    //                 <div class="table-data">Paul</div>
    //                 <div class="table-data">1</div>
    //                 <div class="table-data">1</div>
    //             </div>
    //             <div class="table-row">
    //                 <div class="table-data">Harry</div>
    //                 <div class="table-data">0</div>
    //                 <div class="table-data">2</div>
    //             </div>
    //         </div>	
    //     </div>
    // </div>;   
    

    $pdo = null;

?>

