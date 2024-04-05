<?php
require_once('../Model/config.php');
global $conn;
session_start();

$mail_s = $_POST['mail_s'];
$nom_s = $_POST['nom_s'];
$prenom_s = $_POST['prenom_s'];
$id_poste = $_POST['id_poste'];
$id_civilite = $_POST['id_civilite'];

$identifiant = strtolower($prenom_s[0]) . '.' . strtolower($nom_s);

$mdp = $identifiant . ".azerty@123";
$mdp = password_hash($identifiant, PASSWORD_DEFAULT);

$premiereco = 0;
$mdp_modif = time();


$query = "INSERT INTO salarie (mail_s, nom_s, prenom_s, id_poste, id_civilite)
VALUES (:mail_s, :nom_s, :prenom_s, :id_poste, :id_civilite)";

$stmt = $conn->prepare($query);
$stmt->bindParam(':mail_s', $mail_s, PDO::PARAM_STR);
$stmt->bindParam(':nom_s', $nom_s, PDO::PARAM_STR);
$stmt->bindParam(':prenom_s', $prenom_s, PDO::PARAM_STR);
$stmt->bindParam(':id_poste', $id_poste, PDO::PARAM_INT);
$stmt->bindParam(':id_civilite', $id_civilite, PDO::PARAM_INT);

if ($stmt->execute()) {
    $id_salarie = $conn->lastInsertId();

    $query2 = "INSERT INTO connexion (identifiant, mdp, premiere_co, mdp_modif, id_salarie) 
    VALUES (:identifiant, :mdp, :premiereco, :mdp_modif, :id_salarie)";

    $stmt2 = $conn->prepare($query2);
    $stmt2->bindParam(':identifiant', $identifiant, PDO::PARAM_STR);
    $stmt2->bindParam(':mdp', $mdp, PDO::PARAM_STR);
    $stmt2->bindParam(':premiereco', $premiereco, PDO::PARAM_INT);
    $stmt2->bindParam(':mdp_modif', $mdp_modif, PDO::PARAM_INT);
    $stmt2->bindParam(':id_salarie', $id_salarie, PDO::PARAM_INT);

    if ($stmt2->execute()) {
        header('Location: ../View/pannel.php');
    } else {
        echo "Erreur lors de l'ajout des informations de connexion.";
    }
} else {
    echo "Erreur lors de l'ajout du salarié.";
}
?>