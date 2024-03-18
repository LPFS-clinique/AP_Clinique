<?php
global $conn;
require_once('../Model/config.php');

function executeInsertion($stmt)
{
    return $stmt->execute();
}



if (isset($_POST['add_button'])){
    //add action
    $query= "INSERT INTO `services` (id_service, nom_service) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $_POST['id_service']);
    $stmt->bindParam(2, $_POST['nom_service']);

    $result_services = $stmt->fetchAll();

    $success = executeInsertion($stmt);

}else if (isset($_POST['delete_button'])){
    $nom_service = $_POST['nom_service'];
    $query= "DELETE FROM `services` WHERE nom_service='$nom_service'";
    $stmt = $conn->prepare($query);
   
    echo "DELETE";

    $result_services = $stmt->fetchAll();

    $success = executeInsertion($stmt);

}else if (isset($_POST['update_button'])){
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

//just to test some stuff like to see if the code above execute properly
if ($success) {
    $_SESSION['insert_success'] = "L'ajout du service a bien été effectuée.";
    header('Location: ../View/service.php');
} else {
    $_SESSION['insert_failed'] = "Une erreur s'est produite.";
    header('Location: ../View/service.php');
}

?>