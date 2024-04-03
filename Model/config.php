<?php
$conn = create_db();
// Informations de connexion à la base de données du serveur test
// function create_db()
// {
//     $servername = "127.0.0.1";
//     $username = "root";
//     $password = "root";
//     $dbname = "lpfs_cliniquebdd";


// Informations de connexion à la base de données du serveur localhost
function create_db()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    // $dbname = "lpfs_cliniquebdd";
    $dbname = "test";


    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        return $conn;
    } catch (PDOException $e) {
        echo "Une erreur est survenue lors de la connexion à la base de données. Veuillez réessayer plus tard.";
        error_log($e->getMessage());
        return null;
    }
}

$conn = create_db();
if (!$conn) {
    die("Impossible de se connecter à la base de données.");
}