
<?php
require_once('db_init.php');   
require_once('config.php');

// Requête GET pour récupérer tous les aliments de la base
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        // requête SQL pour récupérer les types aliments
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


