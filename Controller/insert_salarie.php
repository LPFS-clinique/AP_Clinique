<?php
global $conn;
require_once('../Model/config.php');

function executeInsertion($stmt)
{
    return $stmt->execute();
}

if (isset($_POST['add_button'])) {
    $query= "INSERT INTO `salarie` (mail_s, nom_s, prenom_s, id_poste, id_civilite) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $_POST['mail']);
    $stmt->bindParam(2, $_POST['nom_salarie']);
    $stmt->bindParam(3, $_POST['prenom_salarie']);
    $stmt->bindParam(4, $_POST['id_poste']);
    $stmt->bindParam(5, $_POST['id_civilite']);
    $stmt->execute(); // Exécution de la requête

    // Récupération de l'identifiant de la dernière ligne insérée
    $lastInsertedId = $conn->lastInsertId();

    // Utilisation de l'identifiant dans la deuxième requête
    $query= "INSERT INTO `medecin` (id_medecin, id_service, id_salarie) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $_POST['id_medecin']);
    $stmt->bindParam(2, $_POST['id_service']);
    $stmt->bindParam(3, $lastInsertedId); // Utilisation de l'identifiant récupéré
    $stmt->execute(); // Exécution de la deuxième requête

}elseif (isset($_POST['Delete'])){ var_dump($_POST);
    $nom_s = $_POST['id_salarie'];
    $query= "DELETE FROM `salarie` WHERE nom_s ='$nom_s'";
    $stmt = $conn->prepare($query);
    
   
    echo "DELETE";

    $result_salarie = $stmt->fetchAll();

    $success = executeInsertion($stmt);

//---------------------------------------------

}else if (isset($_POST['Update'])){
    $nom_s = $_POST['id_salarie'];
    $query= "UPDATE `salarie` SET nom_s='$nom_s'";
    $stmt = $conn->prepare($query);
   
    echo "UPDATE";

    $result_salarie = $stmt->fetchAll();

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