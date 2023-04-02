
<?php
require_once('db_init.php');   
require_once('config.php');

// Requête GET pour récupérer tous les aliments de la base
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM ALIMENTS";
    try {
        // requête SQL pour récupérer les aliments
        $request = $pdo->prepare("SELECT a.id_aliment, a.nom_aliment, t.nom_type_aliment, a.glucides, a.lipides, a.sucres, a.proteines, a.fibres, a.energie
        FROM ALIMENT a
        JOIN TYPE_ALIMENT t ON t.id_type_aliment = a.id_type_aliment;
        ");
        $request->execute();
        $aliment = $request->fetchAll(PDO::FETCH_ASSOC);

        //------format de la réponse------
        // id_aliment	
        // nom_aliment	
        // nom_type_aliment	
        // glucides	
        // lipides	
        // sucres	
        // proteines	
        // fibres	
        // energie

        // fermer la connexion à la base de données
        $pdo = NULL;

        // renvoyer la réponse en format JSON
        header('Content-Type: application/json;  charset=UTF-8');
        echo json_encode($aliment);

    } catch (PDOException $e) {
        header("HTTP/1.1 500 Internal Server Error");
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
}

// Requête POST pour ajouter un aliment à la base
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $array = json_decode(file_get_contents("php://input"),true); 

    $name = $array['nom_aliment'];
    $type = $array['id_type_aliment'];
    $glucides = $array['glucides'];
    $lipides = $array['lipides'];
    $sucres = $array['sucres'];
    $proteines = $array['proteines'];
    $fibres = $array['fibres'];
    $energie = $array['energie'];
    $sql = "INSERT INTO ALIMENT (nom_aliment, id_type_aliment, glucides, lipides, sucres, proteines, fibres, energie) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    try {
        $conn = new PDO($connectionString,_MYSQL_USER,_MYSQL_PASSWORD, $options);
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $type, $glucides, $lipides, $sucres, $proteines, $fibres, $energie]);
        $id = $conn->lastInsertId();
        header("HTTP/1.1 201 Created");
        header("Location: /aliments.php/$id");
        $aliment = array('id_aliment' => $id, 'nom_aliment' => $name, 'id_type_aliment' => $type, 'glucides' => $glucides, 'lipides' => $lipides, 'sucres' => $sucres, 'proteines' => $proteines, 'fibres' => $fibres, 'energie' => $energie);
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($aliment);
    } catch (PDOException $e) {
        header("HTTP/1.1 400 Bad Request");
        echo "Erreur lors de la création de l'aliment : " . $e->getMessage();
    }
}

// Requête PUT pour mettre à jour les informations d'un aliment, à noter que l'aliment est mis à jour en fonction de son identifiant
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    
    $array = json_decode(file_get_contents("php://input"), true);
    
    $id = $array['id_aliment'];
    $name = $array['nom_aliment'];
    $type = $array['id_type_aliment'];
    $glucides = $array['glucides'];
    $lipides = $array['lipides'];
    $sucres = $array['sucres'];
    $proteines = $array['proteines'];
    $fibres = $array['fibres'];
    $energie = $array['energie'];
    
    $sql = "UPDATE ALIMENT SET nom_aliment = ?, id_type_aliment = ?, glucides = ?, lipides = ?, sucres = ?, proteines = ?, fibres = ?, energie = ? WHERE id_aliment = ?";
    try {
        $conn = new PDO($connectionString, _MYSQL_USER, _MYSQL_PASSWORD, $options);
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $type, $glucides, $lipides, $sucres, $proteines, $fibres, $energie, $id]);
        header("HTTP/1.1 200 OK");
        $aliment = array('id_aliment' => $id, 'nom_aliment' => $name, 'id_type_aliment' => $type, 'glucides' => $glucides, 'lipides' => $lipides, 'sucres' => $sucres, 'proteines' => $proteines, 'fibres' => $fibres, 'energie' => $energie);
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($aliment);
    } catch (PDOException $e) {
        header("HTTP/1.1 400 Bad Request");
        echo "Erreur lors de la mise à jour de l'aliment : " . $e->getMessage();
    }
}

// Requête PATCH pour mettre à jour partiellement les informations d'un utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
    
    $array = json_decode(file_get_contents("php://input"), true);
    
    $id = $array['id_aliment'];
    $name = $array['nom_aliment'] ?? null;
    $type = $array['id_type_aliment'] ?? null;
    $glucides = $array['glucides'] ?? null;
    $lipides = $array['lipides'] ?? null;
    $sucres = $array['sucres'] ?? null;
    $proteines = $array['proteines'] ?? null;
    $fibres = $array['fibres'] ?? null;
    $energie = $array['energie'] ?? null;
    
    $setClauses = array();
    $values = array();
    
    if (!empty($name)) {
        $setClauses[] = "nom_aliment = ?";
        $values[] = $name;
    }
    
    if (!empty($type)) {
        $setClauses[] = "id_type_aliment = ?";
        $values[] = $type;
    }
    
    if (!empty($glucides)) {
        $setClauses[] = "glucides = ?";
        $values[] = $glucides;
    }
    
    if (!empty($lipides)) {
        $setClauses[] = "lipides = ?";
        $values[] = $lipides;
    }
    
    if (!empty($sucres)) {
        $setClauses[] = "sucres = ?";
        $values[] = $sucres;
    }
    
    if (!empty($proteines)) {
        $setClauses[] = "proteines = ?";
        $values[] = $proteines;
    }
    
    if (!empty($fibres)) {
        $setClauses[] = "fibres = ?";
        $values[] = $fibres;
    }
    
    if (!empty($energie)) {
        $setClauses[] = "energie = ?";
        $values[] = $energie;
    }
    
    $sql = "UPDATE ALIMENT SET " . implode(", ", $setClauses) . " WHERE id_aliment = ?";
    
    try {
        $conn = new PDO($connectionString, _MYSQL_USER, _MYSQL_PASSWORD, $options);
        $stmt = $conn->prepare($sql);
        $values[] = $id;
        $stmt->execute($values);
        header("HTTP/1.1 200 OK");
        $aliment = array('id_aliment' => $id, 'nom_aliment' => $name ?? '', 'id_type_aliment' => $type ?? '', 'glucides' => $glucides ?? '', 'lipides' => $lipides ?? '', 'sucres' => $sucres ?? '', 'proteines' => $proteines ?? '', 'fibres' => $fibres ?? '', 'energie' => $energie ?? '');
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($aliment);
    } catch (PDOException $e) {
        header("HTTP/1.1 400 Bad Request");
        echo "Erreur lors de la mise à jour de l'aliment : " . $e->getMessage();
    }
}

// Requête DELETE pour supprimer un utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

    $array = json_decode(file_get_contents("php://input"), true);

    $id = $array['id_aliment'];
    
    $sql = "DELETE FROM ALIMENT WHERE id_aliment = ?";
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
