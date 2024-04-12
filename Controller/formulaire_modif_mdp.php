<?php
require_once('../Model/config.php');
global $conn;

session_start();
$id_login = $_SESSION['id_login'];
var_dump($_SESSION);
$captchaUser = $_POST["captchaUser"];

if (!isset($_SESSION['id_login'])) {
    header('Location: ../View/index.php?issou');
    exit;
}

var_dump($_SESSION["captcha"]);
var_dump($captchaUser);

if ($_SESSION['captcha'] !== $captchaUser) {
    $_SESSION['error'] = "Captcha incorrect.";
    unset($_SESSION["captcha"]);
    header('Location: ../View/changement_mdp.php');
    exit;
}

$newPassword = $_POST['newPassword'];

$query = $conn->prepare("SELECT mdp 
                            FROM connexion 
                            WHERE id_connexion = ?");
$query->execute(array($id_login));
$result = $query->fetch();

$oldPassword = $result['mdp'];
$newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

$mdp_modif = time();


if (password_verify($oldPassword, $newHashedPassword)) {
    $_SESSION['error'] = "Le nouveau mot de passe est similaire à l'ancien";
    header('Location: ../View/changement_mdp.php');
    exit;
} else {
    $query = "UPDATE connexion 
                SET mdp = :hashedPassword 
                WHERE id_connexion = :id_login";
    $stmt2 = $conn->prepare($query);

    $stmt2->bindParam(':hashedPassword', $newHashedPassword, PDO::PARAM_STR);
    $stmt2->bindParam(':id_login', $id_login, PDO::PARAM_INT);

    $query2 = "UPDATE connexion 
                SET mdp_modif = :mdp_modif 
                WHERE id_connexion = :id_login";
    $stmt3 = $conn->prepare($query2);


    $stmt3->bindParam(':mdp_modif', $mdp_modif, PDO::PARAM_INT);
    $stmt3->bindParam(':id_login', $id_login, PDO::PARAM_INT);

    $stmt4 = $conn->prepare("UPDATE connexion 
                                SET premiere_co = 1 
                                WHERE id_connexion = :id_login");
    $stmt4->bindParam(':id_login', $id_login, PDO::PARAM_INT);

    if ($stmt2->execute() && $stmt3->execute() && $stmt4->execute()) {
        $_SESSION['success'] = "Mot de passe mis à jour avec succès.";
        unset($_SESSION['id_login']);
        header('Location: ../View/index.php');
        exit;
    } else {
        $_SESSION['error'] = "Erreur lors de la mise à jour du mot de passe.";
        header('Location: ../View/changement_mdp.php');
        exit;
    }
    $stmt = null;
    $stmt2 = null;
    $stmt3 = null;
    $stmt4 = null;
    $conn = null;
}
