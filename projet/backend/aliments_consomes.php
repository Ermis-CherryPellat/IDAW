
<?php
require_once('db_init.php');   
require_once('config.php');


// a modifier !


// Requête GET pour récupérer tous les aliments de la base
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $sql = "SELECT * FROM type_aliment";
    try {
        // requête SQL pour récupérer les aliments
        $request = $pdo->prepare("SELECT t.id_type_aliment, t.nom_type_aliment
        FROM type_aliment t
        ");
        $request->execute();
        $type_aliment = $request->fetchAll(PDO::FETCH_ASSOC);

        //------format de la réponse------
        // id_type_aliment	
        // nom_type_aliment	


        // fermer la connexion à la base de données
        $pdo = NULL;

        // renvoyer la réponse en format JSON
        header('Content-Type: application/json;  charset=UTF-8');
        echo json_encode($type_aliment);

    } catch (PDOException $e) {
        header("HTTP/1.1 500 Internal Server Error");
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
}

// Requête POST pour ajouter un aliment à la base
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    //INSERT INTO ALIMENT_CONSOMME (`masse`, `id_aliment`, `id_repas`) VALUES ('100', '2250', '3');


    $array = json_decode(file_get_contents("php://input"),true); 

    $nom_type_aliment = $array['nom_type_aliment'];
   
    $sql = "INSERT INTO type_aliment (nom_type_aliment) VALUES (?)";
    try {
        $conn = new PDO($connectionString,_MYSQL_USER,_MYSQL_PASSWORD, $options);
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nom_type_aliment]);
        $id = $conn->lastInsertId();
        header("HTTP/1.1 201 Created");
        header("Location: /type_aliment.php/$id");
        $type_aliment = array('id_type_aliment' => $id, 'nom_type_aliment' => $nom_type_aliment);
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($type_aliment);
    } catch (PDOException $e) {
        header("HTTP/1.1 400 Bad Request");
        echo "Erreur lors de la création du type d'aliment : " . $e->getMessage();
    }
}
