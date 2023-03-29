
<?php
require_once('db_init.php');   
// $pdo initialized

// Requête GET pour récupérer tous les utilisateurs de la base
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM USERS";
    try {
        // requête SQL pour récupérer les utilisateurs
        $request = $pdo->prepare("select * from USERS");
        $request->execute();
        $users = $request->fetchAll(PDO::FETCH_ASSOC);

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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $array = json_decode(file_get_contents("php://input"),true); 

    $name = $array['nom'];
    $email = $array['email'];
    $sql = "INSERT INTO USERS (nom, email) VALUES (?, ?)";
    try {
        $conn = new PDO($connectionString,_MYSQL_USER,_MYSQL_PASSWORD, $options);
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $email]);
        $id = $conn->lastInsertId();
        header("HTTP/1.1 201 Created");
        header("Location: /users.php/$id");
        $user = array('id' => $id, 'name' => $name, 'email' => $email);
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
    
    $id = $array['id_user'];
    $name = $array['nom'];
    $email = $array['email'];
    
    $sql = "UPDATE USERS SET nom = ?, email = ? WHERE id_user = ?";
    try {
        $conn = new PDO($connectionString, _MYSQL_USER, _MYSQL_PASSWORD, $options);
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $email, $id]);
        header("HTTP/1.1 200 OK");
        $user = array('id' => $id, 'name' => $name, 'email' => $email);
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($user);
    } catch (PDOException $e) {
        header("HTTP/1.1 400 Bad Request");
        echo "Erreur lors de la mise à jour de l'utilisateur : " . $e->getMessage();
    }
}

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

    $array = json_decode(file_get_contents("php://input"), true);

    $id = $array['id_user'];
    
    $sql = "DELETE FROM USERS WHERE id_user = ?";
    try {
        $conn = new PDO($connectionString, _MYSQL_USER, _MYSQL_PASSWORD, $options);
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        header("HTTP/1.1 204 No Content");
    } catch (PDOException $e) {
        header("HTTP/1.1 400 Bad Request");
        echo "Erreur lors de la suppression de l'utilisateur : " . $e->getMessage();
    }
}