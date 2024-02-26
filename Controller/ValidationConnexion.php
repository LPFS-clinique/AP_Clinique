<?php
// Démarrage de la session
session_start();

// Inclusion du fichier de configuration pour la connexion à la base de données
require_once('../Model/config.php');

// Vérification si les données du formulaire sont présentes
if (isset($_POST['identifiant'], $_POST['mdp'], $_POST['captcha'])) {
    // Récupération des données du formulaire
    $identifiant = $_POST['identifiant'];
    $mdp = $_POST['mdp'];
    $captchaUser = $_POST['captcha'];

    if ($_SESSION['captcha'] !== $captchaUser) {
        $_SESSION['error'] = "Captcha incorrect.";
        unset($_SESSION["captcha"]);
        header('Location: ../View/index.php');
        exit;
    }
    // Préparation de la requête pour récupérer les informations de l'utilisateur
    $query = $conn->prepare("SELECT * FROM connexion WHERE identifiant = ?");
    $query->execute(array($identifiant));
    $result = $query->fetch();

    if ($result) {
        $dateAnterieur = $result['mdp_modif'];
        $_SESSION['id_login'] = $result['id_connexion'];
        $_SESSION['username'] = $identifiant;
        $intervalle = diff_in_days($dateAnterieur);

        if (password_verify($mdp, $result['mdp'])) {
            // Gestion de la première connexion ou du changement de mot de passe requis
            if ($result['premiere_co'] != "1" || $intervalle >= 90) {
                header('Location: ../View/changement_mdp.php');
            } else {
                header('Location:../View/pannel.php');
            }
        } else {
            $_SESSION['error'] = "Identifiant ou mot de passe incorrect.";
            header("Location: ../View/index.php");
        }
    } else {
        $_SESSION['error'] = "Identifiant inconnu.";
        header("Location: ../View/index.php");
    }

    unset($_SESSION["captcha"]);
    // Fermeture de la connexion à la base de données
    $conn = null;
    exit;
}

function diff_in_days($dateAnterieur)
{
    $now = time();
    $datediff = $now - $dateAnterieur;

    return round($datediff / (60 * 60 * 24));
}
