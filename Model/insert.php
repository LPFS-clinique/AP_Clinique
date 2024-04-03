<?php
require_once('./config.php');
session_start();

global $conn;
extract($_SESSION);

function executeInsertion($conn, $stmt)
{
    if ($stmt->execute()) {
        return $conn->lastInsertId();
    } else {
        // Log de l'erreur ou autre action
        return false;
    }
}

// Insertion dans la table `couverture_sociale`
$stmt = $conn->prepare("INSERT INTO `couverture_sociale` (nom_secu, assure, ald, nom_mutu, num_mutu) VALUES (?, ?, ?, ?, ?)");
$stmt->bindParam(1, $_SESSION['nom_secu']);
$stmt->bindParam(2, $_SESSION['assure']);
$stmt->bindParam(3, $_SESSION['ald']);
$stmt->bindParam(4, $_SESSION['nom_mutu']);
$stmt->bindParam(5, $_SESSION['num_mutu']);
$id_secu = executeInsertion($conn, $stmt);
if (!$id_secu) {
    $_SESSION['insert_failed'] = "Erreur lors de l'insertion dans couverture_sociale.";
    header('Location: ../View/formulaire1.php');
    exit();
}

function uploadDocument($file) {
    if (isset($_FILES[$file]) && $_FILES[$file]['error'] == UPLOAD_ERR_OK) {
        return file_get_contents($_FILES[$file]['tmp_name']);
    }
    return null;
}

$stmt = $conn->prepare("INSERT INTO `documents` (ci_recto, ci_verso, cv, mutuelle, livret_fam) VALUES (?, ?, ?, ?, ?)");
$ci_recto = uploadDocument('carte_identite_recto');
$ci_verso = uploadDocument('carte_identite_verso');
$cv = uploadDocument('carte_vitale');
$mutuelle = uploadDocument('carte_mutuelle');
$livret_fam = uploadDocument('livret_famille');

$stmt->bindParam(1, $ci_recto, PDO::PARAM_LOB);
$stmt->bindParam(2, $ci_verso, PDO::PARAM_LOB);
$stmt->bindParam(3, $cv, PDO::PARAM_LOB);
$stmt->bindParam(4, $mutuelle, PDO::PARAM_LOB);
$stmt->bindParam(5, $livret_fam, PDO::PARAM_LOB);

$id_doc = executeInsertion($conn, $stmt);
if (!$id_doc) {
    $_SESSION['insert_failed'] = "Erreur lors de l'insertion dans documents.";
    header('Location: ../View/formulaire1.php');
    exit();
}



// Insertion dans la table `patient`
$stmt = $conn->prepare("INSERT INTO `patient` (num_secu, nom_naissance_pt, nom_epouse_pt, prenom_pt, ddn_pt, adresse_pt, cp_pt, ville_pt, mail_pt, num_tel_pt, id_civilite, id_doc, id_secu, id_pays) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bindParam(1, $_SESSION['num_secu']);
$stmt->bindParam(2, $_SESSION['nom_naissance_pt']);
$stmt->bindParam(3, $_SESSION['nom_epouse']);
$stmt->bindParam(4, $_SESSION['prenom_pt']);
$stmt->bindParam(5, $_SESSION['date_naissance_pt']);
$stmt->bindParam(6, $_SESSION['adresse_pt']);
$stmt->bindParam(7, $_SESSION['code_postal_pt']);
$stmt->bindParam(8, $_SESSION['ville_pt']);
$stmt->bindParam(9, $_SESSION['email_pt']);
$stmt->bindParam(10, $_SESSION['telephone_pt']);
$stmt->bindParam(11, $_SESSION['civilite_pt']);
$stmt->bindParam(12, $id_doc);
$stmt->bindParam(13, $id_secu);
$stmt->bindParam(14, $_SESSION['id_pays_pt']);
$lastid_patient = executeInsertion($conn, $stmt);
if (!$lastid_patient) {
    $_SESSION['insert_failed'] = "Erreur lors de l'insertion dans patient.";
    header('Location: ../View/formulaire1.php');
    exit();
}



// Insertion dans la table `hospitalisation`
$passe = 0; // Définissez cette variable selon votre logique
$stmt = $conn->prepare("INSERT INTO `hospitalisation` (date, heure, passe, id_medecin, num_type_chambre, id_type_hospitalisation, id_patient) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bindParam(1, $_SESSION['date_admission']);
$stmt->bindParam(2, $_SESSION['heure_admission']);
$stmt->bindParam(3, $passe);
$stmt->bindParam(4, $_SESSION['medecin']);
$stmt->bindParam(5, $_SESSION['chambre']);
$stmt->bindParam(6, $_SESSION['type_hospitalisation']);
$stmt->bindParam(7, $lastid_patient);
if (executeInsertion($conn, $stmt) === false) {
    $_SESSION['insert_failed'] = "Erreur lors de l'insertion dans hospitalisation.";
    header('Location: ../View/formulaire1.php');
    exit();
}

// Insertion des personnes liées au patient
// Insertion dans la table `personne`
$stmt = $conn->prepare("INSERT INTO `personne` (nom_p, prenom_p, adresse_p, num_tel_p, cp_p, ville_p, id_categorie_personne, id_pays, id_civilite) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bindParam(1, $_SESSION['nom_p1']);
$stmt->bindParam(2, $_SESSION['prenom_p1']);
$stmt->bindParam(3, $_SESSION['adresse_p1']);
$stmt->bindParam(4, $_SESSION['num_tel_p1']);
$stmt->bindParam(5, $_SESSION['codePostal_p1']);
$stmt->bindParam(6, $_SESSION['ville_p1']);
$stmt->bindParam(7, $_SESSION['id_categorie_personne_p1']);
$stmt->bindParam(8, $_SESSION['id_pays_p1']);
$stmt->bindParam(9, $_SESSION['civilite_p1']);
    
$id_personne = executeInsertion($conn, $stmt);

if (!$id_personne) {
    $_SESSION['insert_failed'] = "Erreur lors de l'insertion d'une personne.";
    header('Location: ../View/formulaire1.php?enculé1=true');
    exit();
}
$stmt = $conn->prepare("INSERT INTO `personne_patient` (id_personne, id_patient) VALUES (?, ?)");
$stmt->bindParam(1, $id_personne);
$stmt->bindParam(2, $lastid_patient);

if (executeInsertion($conn, $stmt) === false) {
    $_SESSION['insert_failed'] = "Erreur lors de la liaison personne-patient.";
    header('Location: ../View/formulaire1.php?enculé2=true');
    exit();
}



// Insertion dans la table `personne`
$stmt = $conn->prepare("INSERT INTO `personne` (nom_p, prenom_p, adresse_p, num_tel_p, cp_p, ville_p, id_categorie_personne, id_pays, id_civilite) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bindParam(1, $_SESSION['nom_p2']);
$stmt->bindParam(2, $_SESSION['prenom_p2']);
$stmt->bindParam(3, $_SESSION['adresse_p2']);
$stmt->bindParam(4, $_SESSION['num_tel_p2']);
$stmt->bindParam(5, $_SESSION['codePostal_p2']);
$stmt->bindParam(6, $_SESSION['ville_p2']);
$stmt->bindParam(7, $_SESSION['id_categorie_personne_p2']);
$stmt->bindParam(8, $_SESSION['id_pays_p2']);
$stmt->bindParam(9, $_SESSION['civilite_p2']);

$id_personne = executeInsertion($conn, $stmt);

if (!$id_personne) {
    $_SESSION['insert_failed'] = "Erreur lors de l'insertion d'une personne.";
    header('Location: ../View/formulaire1.php');
    exit();
}
$stmt = $conn->prepare("INSERT INTO `personne_patient` (id_personne, id_patient) VALUES (?, ?)");
$stmt->bindParam(1, $id_personne);
$stmt->bindParam(2, $lastid_patient);
if (executeInsertion($conn, $stmt) === false) {
    $_SESSION['insert_failed'] = "Erreur lors de la liaison personne-patient.";
    header('Location: ../View/formulaire1.php');
    exit();
}
$_SESSION['insert_success'] = "La pré-admission a bien été effectuée.";
header('Location: ../View/pannel.php');
