
<?php
require_once('db_init.php');   
require_once('config.php');

// Requête GET pour récupérer tous les nutriments d'un utillisateur
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // récupérer l'id_utilisateur depuis les paramètres de la requête GET
    $id_utilisateur = $_GET['id_utilisateur'];

    try {
        // requête SQL pour récupérer les quantités moyennes journalières de nutriments pour l'utilisateur donné
        $request = $pdo->prepare("
            SELECT
                AVG(a.glucides) as avg_glucides,
                AVG(a.lipides) as avg_lipides,
                AVG(a.sucres) as avg_sucres,
                AVG(a.proteines) as avg_proteines,
                AVG(a.fibres) as avg_fibres,
                AVG(a.energie) as avg_energie
            FROM (
                SELECT
                SUM(ac.masse * al.glucides / 100) as glucides,
                SUM(ac.masse * al.lipides / 100) as lipides,
                SUM(ac.masse * al.sucres / 100) as sucres,
                SUM(ac.masse * al.proteines / 100) as proteines,
                SUM(ac.masse * al.fibres / 100) as fibres,
                SUM(ac.masse * al.energie / 100) as energie,
                DATE(r.date_consommation) as date_consommation
                FROM aliment al
                JOIN aliment_consomme ac ON ac.id_aliment = al.id_aliment
                JOIN repas r ON ac.id_repas = r.id_repas
                WHERE r.id_utilisateur = :id_utilisateur
                GROUP BY DATE(r.date_consommation)
            ) a
        ");
        $request->bindParam(':id_utilisateur', $id_utilisateur);
        $request->execute();
        $result = $request->fetchAll(PDO::FETCH_ASSOC);

        // fermer la connexion à la base de données
        $pdo = NULL;

        // renvoyer la réponse en format JSON
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode($result);

    } catch (PDOException $e) {
        header("HTTP/1.1 500 Internal Server Error");
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
}

