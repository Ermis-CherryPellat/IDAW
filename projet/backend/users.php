
<?php
require_once('db_init.php');   
require_once('config.php');

// Requête GET pour récupérer tous les utilisateurs de la base
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM UTILISATEUR";
    try {
        // requête SQL pour récupérer les utilisateurs
        $request = $pdo->prepare("SELECT u.id_utilisateur, u.nom, u.prenom, u.email, u.mot_de_passe, s.nom_sexe, tp.tranche_min AS poids_min, tp.tranche_max AS poids_max, tt.tranche_min AS taille_min, tt.tranche_max AS taille_max, o.nom_objectif, ps.frequence_pratique_sportive, ta.tranche_min AS age_min, ta.tranche_max AS age_max
        FROM UTILISATEUR u
        JOIN SEXE s ON s.id_sexe = u.id_sexe
        JOIN TRANCHE_POIDS tp ON tp.id_tranche_poids = u.id_poids
        JOIN TRANCHE_TAILLE tt ON tt.id_tranche_taille = u.id_taille
        JOIN OBJECTIF o ON o.id_objectif = u.id_objectif
        JOIN PRATIQUE_SPORTIVE ps ON ps.id_pratique_sportive = u.id_pratique_sportive
        JOIN TRANCHE_AGE ta ON ta.id_tranche_age = u.id_tranche_age
        WHERE u.id_utilisateur = 24;
        ");
        $request->execute();
        $users = $request->fetchAll(PDO::FETCH_ASSOC);

        //------format de la réponse------
        //id
        // nom
        // prenom
        // email
        // mot de passe
        // nom_sexe
        // poids_min
        // poids_max
        // taille_min
        // taille_max
        // nom_objectif
        // frequence_pratique_sportive
        // age_min
        // age_max

        // fermer la connexion à la base de données
        $pdo = NULL;

        // renvoyer la réponse en format JSON
        header('Content-Type: application/json;  charset=UTF-8');
        echo json_encode($users);

    } catch (PDOException $e) {
        header("HTTP/1.1 500 Internal Server Error");
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
}



// Requête POST pour ajouter un utilisateur à la base
// Pas encore testé mais modfié
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $array = json_decode(file_get_contents("php://input"),true); 

    $id=$array['id_utilsateur'];
    $nom = $array['nom'];
    $prenom = $array['prenom'];
    $email = $array['email'];   
    $mdp=$array['mot_de_passe'];
    $sexe = $array['sexe'];
    $poids = $array['poids'];
    $taille = $array['taille'];
    $objectif = $array['objectif'];
    $sport = $array['sport'];
    $age = $array['age'];

    $sql = "INSERT INTO UTILISATEUR (nom, prenom,email,mot_de_passe, id_sexe, id_poids, id_taille, id_objectif, id_pratique_sportive, id_tranche_age) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)";
    try {
        // préparer la requête SQL pour ajouter un utilisateur à la base
        $conn = new PDO($connectionString,_MYSQL_USER,_MYSQL_PASSWORD, $options);
        $stmt = $conn->prepare($sql);
        $request->execute([$nom, $prenom,$email,$mot_de_passe, $sexe, $poids, $taille, $objectif, $sport, $age]);
        $id = $conn->lastInsertId();
        header("HTTP/1.1 201 Created");
        header("Location: /users.php/$id");
        $user = array('id' => $id, 'nom' => $nom, 'prenom' => $prenom, 'sexe' => $sexe,'email' => $email,'mdp'=> $mdp, 'poids' => $poids, 'taille' => $taille, 'objectif' => $objectif, 'sport' => $sport, 'age' => $age);
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($user);
    } catch (PDOException $e) {
        header("HTTP/1.1 400 Bad Request");
        echo "Erreur lors de la création de l'utilisateur : " . $e->getMessage();
    }
}

// Requête PUT pour mettre à jour les informations d'un utilisateur

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $array = json_decode(file_get_contents("php://input"), true);

    $id = $array['id'];
    $nom = $array['nom'];
    $prenom = $array['prenom'];
    $email = $array['email'];
    $mdp = $array['mot_de_passe'];
    $sexe = $array['sexe'];
    $poids = $array['poids'];
    $taille = $array['taille'];
    $objectif = $array['objectif'];
    $sport = $array['sport'];
    $age = $array['age'];

    $sql = "UPDATE UTILISATEUR SET nom=?, prenom=?, email=?, mot_de_passe=?, id_sexe=?, id_poids=?, id_taille=?, id_objectif=?, id_pratique_sportive=?, id_tranche_age=? WHERE id_utilisateur=?";
    try {
        // préparer la requête SQL pour mettre à jour un utilisateur dans la base
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nom, $prenom, $email, $mdp, $sexe, $poids, $taille, $objectif, $sport, $age, $id]);

        header("HTTP/1.1 200 OK");
        $user = array('id' => $id, 'nom' => $nom, 'prenom' => $prenom, 'sexe' => $sexe, 'email' => $email, 'mdp' => $mdp, 'poids' => $poids, 'taille' => $taille, 'objectif' => $objectif, 'sport' => $sport, 'age' => $age);
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($user);
    } catch (PDOException $e) {
        header("HTTP/1.1 400 Bad Request");
        echo "Erreur lors de la mise à jour de l'utilisateur : " . $e->getMessage();
    }
}

///// A PARTIR D'ICI IL FAUT MODIFIER /////////
// Requête PATCH pour mettre à jour partiellement les informations d'un utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
    
    $array = json_decode(file_get_contents("php://input"), true);
    
    $id = $array['id_user'];
    $name = $array['nom'] ?? null;
    $email = $array['email'] ?? null;
    
    $setClauses = array();
    $values = array();
    
    if (!empty($name)) {
        $setClauses[] = "nom = ?";
        $values[] = $name;
    }
    
    if (!empty($email)) {
        $setClauses[] = "email = ?";
        $values[] = $email;
    }
    
    $sql = "UPDATE USERS SET " . implode(", ", $setClauses) . " WHERE id_user = ?";
    
    try {
        $conn = new PDO($connectionString, _MYSQL_USER, _MYSQL_PASSWORD, $options);
        $stmt = $conn->prepare($sql);
        $values[] = $id;
        $stmt->execute($values);
        header("HTTP/1.1 200 OK");
        $user = array('id' => $id, 'name' => $name ?? '', 'email' => $email ?? '');
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($user);
    } catch (PDOException $e) {
        header("HTTP/1.1 400 Bad Request");
        echo "Erreur lors de la mise à jour de l'utilisateur : " . $e->getMessage();
    }
}

// Requête DELETE pour supprimer un utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET['id'];
    
  
    try {
        // préparer la requête SQL pour supprimer l'utilisateur avec l'id donné
        $stmt = $pdo->prepare("DELETE FROM UTILISATEUR WHERE id_utilisateur = ?");
        $stmt->execute([$id]);
    
        header("HTTP/1.1 200 OK");
        echo json_encode(['message' => 'Utilisateur supprimé avec succès.']);
    } catch (PDOException $e) {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(['message' => 'Une erreur est survenue lors de la suppression de l\'utilisateur.']);
    }
    }


    
    // Requête PUT pour mettre à jour les informations d'un utilisateur
    if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
        // Récupérer l'ID de l'utilisateur à mettre à jour
        $id = intval($_GET['id']);
        
        // Récupérer les données à mettre à jour
        $data = json_decode(file_get_contents('php://input'), true);
        
        // Définir les variables à partir des données reçues
        $nom = $data['nom'];
        $prenom = $data['prenom'];
        $email = $data['email'];
        $mot_de_passe = $data['mot_de_passe'];
        $id_sexe = $data['id_sexe'];
        $id_poids = $data['id_poids'];
        $id_taille = $data['id_taille'];
        $id_objectif = $data['id_objectif'];
        $id_pratique_sportive = $data['id_pratique_sportive'];
        $id_tranche_age = $data['id_tranche_age'];
        
        // Préparer la requête SQL pour mettre à jour les informations de l'utilisateur
        $sql = "UPDATE UTILISATEUR SET nom=?, prenom=?, email=?, mot_de_passe=?, id_sexe=?, id_poids=?, id_taille=?, id_objectif=?, id_pratique_sportive=?, id_tranche_age=? WHERE id_utilisateur=?";
        try {
            // Exécuter la requête SQL pour mettre à jour les informations de l'utilisateur
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nom, $prenom, $email, $mot_de_passe, $id_sexe, $id_poids, $id_taille, $id_objectif, $id_pratique_sportive, $id_tranche_age, $id]);
            
            // Fermer la connexion à la base de données
            $pdo = NULL;
            
            // Envoyer une réponse avec un code de succès
            http_response_code(204);
        } catch (PDOException $e) {
            // Envoyer une réponse avec un code d'erreur
            header("HTTP/1.1 500 Internal Server Error");
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
        }
    }
    ?>



