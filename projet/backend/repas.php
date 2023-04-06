
<?php
require_once('db_init.php');   
require_once('config.php');


// Requête GET pour récupérer tous les repas de la base
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $id_utilisateur = $_GET['id_utilisateur'];

        // requête SQL pour récupérer les repas de l'utilisateur donné
        $request = $pdo->prepare("SELECT r.id_repas, r.id_utilisateur, r.id_type_repas, r.date_consommation
        FROM repas r
        WHERE r.id_utilisateur = :id_utilisateur
        ");
        $request->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
        $request->execute();
        $repas = $request->fetchAll(PDO::FETCH_ASSOC);


        //------format de la réponse------
        // id_repas	
        // id_utilisateur	
        // id_type_repas
        // date_consommation

        // fermer la connexion à la base de données
        $pdo = NULL;

        // renvoyer la réponse en format JSON
        header('Content-Type: application/json;  charset=UTF-8');
        echo json_encode($repas);

    } catch (PDOException $e) {
        header("HTTP/1.1 500 Internal Server Error");
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
}


// Requête POST pour ajouter un repas à la base
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    //INSERT INTO REPAS  (id_repas,id_utilisateur,id_type_repas,date_consommation) VALUES (NULL, 2,  3 ,’2023-03-28 13:35:58 ’);


    $array = json_decode(file_get_contents("php://input"),true); 

    $id_utilisateur = $array['id_utilisateur'];
    $id_type_repas = $array['id_type_repas'];
    $date_consommation = $array['date_consommation'];

    $sql = "INSERT INTO repas (id_utilisateur,id_type_repas,date_consommation) VALUES (?,?,?);";
    try {
        $conn = new PDO($connectionString,_MYSQL_USER,_MYSQL_PASSWORD, $options);
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id_utilisateur, $id_type_repas, $date_consommation]);
        $id_repas = $conn->lastInsertId();
        header("HTTP/1.1 201 Created");
        header("Location: /repas.php/$id_repas");
        $repas = array('id_repas' => $id_repas, 'id_utilisateur' => $id_utilisateur, 'id_type_repas' => $id_type_repas, 'date_consommation' => $date_consommation);
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($repas);
    } catch (PDOException $e) {
        header("HTTP/1.1 400 Bad Request");
        echo "Erreur lors de la création de l'aliment : " . $e->getMessage();
    }
}

// a modifier !

// Requête PUT pour mettre à jour les informations d'un aliment, à noter que l'aliment est mis à jour en fonction de son identifiant
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    
    $array = json_decode(file_get_contents("php://input"), true);
    
    $id = $array['id_repas'];
    $id_utilsateurs = $array['id_utilsateurs']; //On ne doit pas pouvoir changer l'utilisateur
    $id_type_repas = $array['id_type_repas'];
    $date_consommation = $array['date_consommation'];
    
    $sql = "UPDATE repas SET id_type_repas = ?, date_consommation = ? WHERE id_repas = ?";
    try {
        $conn = new PDO($connectionString, _MYSQL_USER, _MYSQL_PASSWORD, $options);
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id_type_repas, $date_consommation, $id]);
        header("HTTP/1.1 200 OK");
        $repas = array('id_repas' => $id, 'id_utilsateurs' => $id_utilsateurs, 'id_type_repas' => $id_type_repas, 'date_consommation' => $date_consommation);
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($repas);
    } catch (PDOException $e) {
        header("HTTP/1.1 400 Bad Request");
        echo "Erreur lors de la mise à jour de l'aliment : " . $e->getMessage();
    }
}

// Requête DELETE pour supprimer un aliment
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

    $array = json_decode(file_get_contents("php://input"), true);

    $id = $array['id_repas'];
    
    $sql = "DELETE FROM repas WHERE id_repas = ?";
    try {
        $conn = new PDO($connectionString, _MYSQL_USER, _MYSQL_PASSWORD, $options);
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        header("HTTP/1.1 204 No Content");
    } catch (PDOException $e) {
        header("HTTP/1.1 400 Bad Request");
        echo "Erreur lors de la suppression de l'aliment : " . $e->getMessage();
    }
}