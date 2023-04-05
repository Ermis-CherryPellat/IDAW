
<?php
require_once('db_init.php');   
require_once('config.php');


// a modifier !


// Requête GET pour récupérer tous les aliments de la base
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $sql = "SELECT * FROM aliment_consomme";
    try {
        // requête SQL pour récupérer les aliments
        $request = $pdo->prepare("SELECT a.masse, a.id_aliment, a.id_repas
        FROM aliment_consomme a
        ");
        $request->execute();
        $aliment_consomme = $request->fetchAll(PDO::FETCH_ASSOC);

        //------format de la réponse------
        // id_type_aliment	
        // nom_type_aliment	


        // fermer la connexion à la base de données
        $pdo = NULL;

        // renvoyer la réponse en format JSON
        header('Content-Type: application/json;  charset=UTF-8');
        echo json_encode($aliment_consomme);

    } catch (PDOException $e) {
        header("HTTP/1.1 500 Internal Server Error");
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
}

// Requête POST pour ajouter un aliment à la base
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    //INSERT INTO ALIMENT_CONSOMME (`masse`, `id_aliment`, `id_repas`) VALUES ('100', '2250', '3');

    $array = json_decode(file_get_contents("php://input"),true); 

    $masse = $array['masse'];
    $id_aliment = $array['id_aliment'];
    $id_repas = $array['id_repas'];
   
    $sql = "INSERT INTO aliment_consomme (masse,id_aliment,id_repas) VALUES (?,?,?)";
    try {
        $conn = new PDO($connectionString,_MYSQL_USER,_MYSQL_PASSWORD, $options);
        $stmt = $conn->prepare($sql);
        $stmt->execute([$masse,$id_aliment,$id_repas]);
        header("HTTP/1.1 201 Created");
        header("Location: /aliment_consomme.php");
        $aliment_consomme = array('masse' => $masse, 'id_aliment' => $id_aliment, 'id_repas' => $id_repas);
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($aliment_consomme);
    } catch (PDOException $e) {
        header("HTTP/1.1 400 Bad Request");
        echo "Erreur lors de la création de l'aliment consomme : " . $e->getMessage();
    }
}

// Requête PUT pour mettre à jour les informations d'un aliment, à noter que l'aliment est mis à jour en fonction de son identifiant
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    
    $array = json_decode(file_get_contents("php://input"), true);
    
    $masse = $array['masse'];
    $id_aliment = $array['id_aliment'];
    $id_repas = $array['id_repas'];

    $sql = "UPDATE aliment_consomme SET masse = ? WHERE id_aliment = ? AND id_repas = ? ";
    try {
        $conn = new PDO($connectionString, _MYSQL_USER, _MYSQL_PASSWORD, $options);
        $stmt = $conn->prepare($sql);
        $stmt->execute([$masse,$id_aliment,$id_repas]);
        header("HTTP/1.1 200 OK");
        $aliment_consomme = array('masse' => $masse, 'id_aliment' => $id_aliment, 'id_repas' => $id_repas);
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($aliment_consomme);
    } catch (PDOException $e) {
        header("HTTP/1.1 400 Bad Request");
        echo "Erreur lors de la mise à jour de l'aliment : " . $e->getMessage();
    }
}

// Requête DELETE pour supprimer un aliment
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

    $array = json_decode(file_get_contents("php://input"), true);

    $id_aliment = $array['id_aliment'];
    $id_repas = $array['id_repas'];  

    $sql = "DELETE FROM aliment_consomme WHERE id_aliment = ? AND id_repas = ?";
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
