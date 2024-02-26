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
    $servername = "localhost:3306";
    $username = "root";
    $password = "";
    $dbname = "lpfs_cliniquebdd";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);

        // Configurer PDO pour afficher les erreurs SQL
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        //echo "Connexion réussie !";

        return $conn;
    } catch (PDOException $e) {
        echo "Erreur : ";
        if ($e->getCode() == 1049) {
            echo "Base de données inconnue.";
        } elseif ($e->getCode() == 1045) {
            echo "Identifiant ou mot de passe incorrect.";
        } elseif ($e->getCode() == 2002) {
            echo "Impossible de se connecter au serveur de base de données.";
        } else {
            // Affiche le message d'erreur SQL
            echo $e->getMessage();
        }
    }
}
