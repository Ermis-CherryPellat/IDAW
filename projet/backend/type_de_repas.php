
<?php
require_once('db_init.php');   
require_once('config.php');

// Requête GET pour récupérer tous les types de repas de la base
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        // requête SQL pour récupérer les aliments
        $request = $pdo->prepare("SELECT t.id_type_repas, t.nom_type_repas
        FROM type_de_repas t
        ");
        $request->execute();
        $type_aliment = $request->fetchAll(PDO::FETCH_ASSOC);

        //------format de la réponse------
        // id_type_repas	
        // nom_type_repas

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

