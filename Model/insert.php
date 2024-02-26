<?php
require_once('../Model/config.php');
session_start();

global $conn;
extract($_SESSION);

function executeInsertion($stmt)
{
    return $stmt->execute();
}

// Insertion dans la table `hospitalisation`
$stmt = $conn->prepare("INSERT INTO `hospitalisation` (date, heure, id_medecin, num_type_chambre, id_type_hospitalisation) VALUES (?, ?, ?, ?, ?)");
$stmt->bindParam(1, $_SESSION['date_admission']);
$stmt->bindParam(2, $_SESSION['heure_admission']);
$stmt->bindParam(3, $_SESSION['medecin']);
$stmt->bindParam(4, $_SESSION['chambre']);
$stmt->bindParam(5, $_SESSION['type_hospitalisation']);
$success = executeInsertion($stmt);


// Insertion dans la table `couverture_sociale`
$stmt = $conn->prepare("INSERT INTO `couverture_sociale` (nom_secu, assure, ald, nom_mutu, num_mutu) VALUES (?, ?, ?, ?, ?)");
$stmt->bindParam(1, $_SESSION['nom_secu']);
$stmt->bindParam(2, $_SESSION['assure']);
$stmt->bindParam(3, $_SESSION['ald']);
$stmt->bindParam(4, $_SESSION['nom_mutu']);
$stmt->bindParam(5, $_SESSION['num_mutu']);
$success = $success && executeInsertion($stmt);


// Insertion dans la table `documents`
$stmt = $conn->prepare("INSERT INTO `documents` (ci_recto, ci_verso, cv, mutuelle, livret_fam) VALUES (?, ?, ?, ?, ?)");

$ci_recto_content = file_get_contents($_FILES['carte_identite_recto']['tmp_name']);
var_dump($ci_recto_content);
$ci_verso_content = file_get_contents($_FILES['carte_identite_verso']['tmp_name']);
$cv_content = file_get_contents($_FILES['carte_vitale']['tmp_name']);
$mutuelle_content = file_get_contents($_FILES['carte_mutuelle']['tmp_name']);
$livret_fam_content = file_get_contents($_FILES['livret_famille']['tmp_name']);

// $ci_verso_content = file_get_contents($_FILES["carte_identite_recto"]);

$stmt->bindParam(1, $ci_recto_content, PDO::PARAM_LOB);
$stmt->bindParam(2, $ci_verso_content, PDO::PARAM_LOB);
$stmt->bindParam(3, $cv_content, PDO::PARAM_LOB);
$stmt->bindParam(4, $mutuelle_content, PDO::PARAM_LOB);
$stmt->bindParam(5, $livret_fam_content, PDO::PARAM_LOB);

// Exécution de l'insertion
$success = $stmt->execute();

// Récupération de l'id du patient
$id_hosp = $conn->lastInsertId('hospitalisation');
$id_doc = $conn->lastInsertId('documents');
$id_secu = $conn->lastInsertId('couverture_sociale');

// Insertion dans la table `patient`
$stmt2 = $conn->prepare("INSERT INTO `patient`(num_secu, nom_naissance, nom_epouse, prenom, ddn, adresse, cp, ville, mail, num_tel, id_hosp, id_civilite, id_doc, id_secu, id_pays) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt2->bindParam(1, $_SESSION['num_secu']);
$stmt2->bindParam(2, $_SESSION['nom_naissance_pt']);
$stmt2->bindParam(3, $_SESSION['nom_epouse']);
$stmt2->bindParam(4, $_SESSION['prenom_pt']);
$stmt2->bindParam(5, $_SESSION['date_naissance_pt']);
$stmt2->bindParam(6, $_SESSION['adresse_pt']);
$stmt2->bindParam(7, $_SESSION['code_postal_pt']);
$stmt2->bindParam(8, $_SESSION['ville_pt']);
$stmt2->bindParam(9, $_SESSION['email_pt']);
$stmt2->bindParam(10, $_SESSION['telephone_pt']);
$stmt2->bindParam(11, $id_hosp);
$stmt2->bindParam(12, $_SESSION['civilite_pt']);
$stmt2->bindParam(13, $id_doc);
$stmt2->bindParam(14, $id_secu);
$stmt2->bindParam(15, $_SESSION['id_pays_pt']);

$success2 = executeInsertion($stmt2);

$success2 = $stmt2->execute();

$lastid_patient = $conn->lastInsertId('patient');


// Insertion dans la table `personne`
$stmt3 = $conn->prepare("INSERT INTO `personne` (nom, prenom, adresse, num_tel, cp, ville, id_categorie_personne, id_pays, id_civilite, id_patient) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt3->bindParam(1, $_SESSION['nom_p1']);
$stmt3->bindParam(2, $_SESSION['prenom_p1']);
$stmt3->bindParam(3, $_SESSION['adresse_p1']);
$stmt3->bindParam(4, $_SESSION['num_tel_p1']);
$stmt3->bindParam(5, $_SESSION['codePostal_p1']);
$stmt3->bindParam(6, $_SESSION['ville_p1']);
$stmt3->bindParam(7, $_SESSION['id_categorie_personne_p1']);
$stmt3->bindParam(8, $_SESSION['id_pays_p1']);
$stmt3->bindParam(9, $_SESSION['civilite_p1']);
$stmt3->bindParam(10, $lastid_patient);
$success3 = executeInsertion($stmt3);


$stmt3 = $conn->prepare("INSERT INTO `personne` (nom, prenom, adresse, num_tel, cp, ville, id_categorie_personne, id_pays, id_civilite, id_patient) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt3->bindParam(1, $_SESSION['nom_p2']);
$stmt3->bindParam(2, $_SESSION['prenom_p2']);
$stmt3->bindParam(3, $_SESSION['adresse_p2']);
$stmt3->bindParam(4, $_SESSION['num_tel_p2']);
$stmt3->bindParam(5, $_SESSION['codePostal_p2']);
$stmt3->bindParam(6, $_SESSION['ville_p2']);
$stmt3->bindParam(7, $_SESSION['id_categorie_personne_p2']);
$stmt3->bindParam(8, $_SESSION['id_pays_p2']);
$stmt3->bindParam(9, $_SESSION['civilite_p2']);
$stmt3->bindParam(10, $lastid_patient);
$success3 = $success3 && executeInsertion($stmt3);


if ($success && $success2 && $success3) {
    $_SESSION['insert_success'] = "La pré-admission a bien été effectuée.";
    header('Location: ../View/pannel.php');
} else {
    $_SESSION['insert_failed'] = "Une erreur s'est produite.";
    header('Location: ../View/formulaire1.php');
}
