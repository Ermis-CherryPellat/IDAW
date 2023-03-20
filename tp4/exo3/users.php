<?php
    // require_once('config.php');
    require_once('db_init.php');    

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

