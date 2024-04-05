<?php
global $conn;
require_once('../Model/config.php');

function executeInsertion($stmt)
{
    return $stmt->execute();
}


$query= "INSERT INTO `salarie` (mail_s, nom_s, prenom_s, id_poste, id_civilite) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bindParam(1, $_POST['mail']);
$stmt->bindParam(2, $_POST['nom_salarie']);
$stmt->bindParam(3, $_POST['prenom_salarie']);
$stmt->bindParam(4, $_POST['id_poste']);
$stmt->bindParam(5, $_POST['id_civilite']);
$result_salarie = $stmt->fetchAll();

$success = executeInsertion($stmt);

$query= "INSERT INTO `medecin` (id_medecin, id_service, id_salarie) VALUES (?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bindParam(1, $_POST['id_medecin']);
$stmt->bindParam(2, $_POST['id_service']);
$stmt->bindParam(3, $_POST['id_salarie']);
$result_medecin= $stmt->fetchAll();

if (isset($_POST['delete_button2'])){
    $nom_salarie = $_POST['nom_salarie'];
    $query= "DELETE FROM `salarie` WHERE nom_salarie='$nom_salarie'";
    $stmt = $conn->prepare($query);
    
   
    echo "DELETE";

    $result_salarie = $stmt->fetchAll();

    $success = executeInsertion($stmt);

}else if (isset($_POST['update_button2'])){
    $nom_service = $_POST['nom_service'];
    $query= "UPDATE `services` SET nom_service='$nom_service'";
    $stmt = $conn->prepare($query);
   
    echo "UPDATE";

    $result_services = $stmt->fetchAll();

    $success = executeInsertion($stmt);

}
else{
    //no button pressed
    echo "NOTHING";
}

if ($success) {
    $_SESSION['insert_success'] = "L'ajout du médécin a bien été effectuée.";
    header('Location: ../View/pannel.php');
} else {
    $_SESSION['insert_failed'] = "Une erreur s'est produite.";
    header('Location: ../View/pannel.php');
}


?>

