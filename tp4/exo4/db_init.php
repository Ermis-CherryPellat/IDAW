<?php
require_once('config.php');
$connectionString = "mysql:host=". _MYSQL_HOST;

if(defined('_MYSQL_PORT'))
    $connectionString .= ";port=". _MYSQL_PORT;
    $connectionString .= ";dbname=" . _MYSQL_DBNAME;
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' );

$pdo = NULL;

try {
    // // Connexion à la base de données
    // $pdo = new PDO($connectionString,_MYSQL_USER,_MYSQL_PASSWORD,$options);
    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // // Supprimer la base de données si elle existe
    // $pdo->exec("DROP DATABASE IF EXISTS $db_name");

    // // Créer la base de données
    // $pdo->exec("CREATE DATABASE $db_name");

    // // Sélectionner la base de données
    // $pdo->exec("USE $db_name");

    // // Importer la structure de la base de données depuis un fichier SQL
    // $sql_structure = file_get_contents('dbtest.sql');
    // $pdo->exec($sql_structure);

    // Importer les données de test depuis un fichier SQL
    // $sql_data = file_get_contents('dbtest.sql');
    // $pdo->exec($sql_data);

    echo "Base de données créée et initialisée avec succès !";
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
