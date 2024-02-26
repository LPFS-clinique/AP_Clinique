<?php
require_once('../../Model/config.php');
global $conn;
// Vérifier si le formulaire a été soumis

if ($_SERVER["REQUEST_METHOD"] == "POST") 
    // Récupérer les données du formulaire
var_dump($_POST);
    $nom_naissance = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $ddn = $_POST["date_naissance"];
    
    $date = $_POST["date_admission"];
    $nom_service = $_POST["services"];
    $medecin_traitant = $_POST["traitant"];



    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $ddn = $_POST["ddn"];
    $date_admission = $_POST["date_admission"];
    $services = $_POST["services"];
    $traitant = $_POST["traitant"];
    
    if (strlen($nom) > 50 || strlen($prenom) > 50) {
        die("Erreur: Le nom ou le prénom est trop long.");
    }
    
    if (strtotime($ddn) >= time()) {
        die("Erreur: La date de naissance est invalide.");
    }
    
    if (strtotime($date_admission) >= time()) {
        die("Erreur: La date d'hospitalisation est invalide.");
    }
    
    if (empty($services) || $services === "service") {
        die("Erreur: Veuillez sélectionner un service.");
    }
    
    if (empty($traitant) || $traitant === "medecin_traitant") {
        die("Erreur: Veuillez sélectionner un médecin traitant.");
    }
    
    
    // Préparer et exécuter la requête SQL pour insérer les données dans la base de données
    $sql = "";//"INSERT INTO patient (nom_naissance, prenom, ddn, id_civilite,num_secu,adresse,cp,ville,mail;num_tel,id_hosp,id_civilite,id_doc,id_secu,id_pays)
            //VALUES ('$nom_naissance', '$prenom', '$ddn', '1','1','1','1','1','1','1','1','1','1','1','1','1','1')";

    $sql2 = "";//"INSERT INTO hospitalisation (date_admission)
            //VALUES ('$date')";

    // Récupération des données de la table poste
    $stmt = $conn->prepare("SELECT * FROM services");
    $result = $stmt->execute();

    // Affichage des données dans le volet de sélection
    $rows = $stmt->fetchAll();
    if (sizeof($rows) > 0) {
        foreach($rows as $row) {
            echo '<option value=' . $row["services"] . '</option>';

        }
    } else {
    echo '<option value="">Aucun poste disponible</option>';
    }

    $stmt = $conn->prepare("SELECT s.nom_salarie , s.prenom_salarie FROM medecin m
    Inner join salarie s on m.id_salarie = s.id_salarie 
    Where id_poste = 14 ");
    $result = $stmt->execute();

    // Affichage des données dans le volet de sélection
    $rows = $stmt->fetchAll();
    if (sizeof($rows) > 0) {
        foreach($rows as $row) {
            echo '<option value="' . $row["nom_salarie"] . '">' . $row["prenom_salarie"] . '</option>';
        }
    } 
    else {
        echo '<option value="">Aucun poste disponible</option>';
    }

    $result = $stmt->execute();
    if ($result) {
        echo "Les données ont été enregistrées avec succès.";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->errorInfo();
    }

    //Rediriger vers la page de formulaire si le formulaire n'a pas été soumis
    header("Location: formulaire.php");
    exit();
?>