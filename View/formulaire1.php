<?php
require_once('../Model/config.php');
global $conn;
session_start();

session_unset();
!var_dump($_SESSION);


$query = "Select s.nom_salarie , s.id_salarie from medecin m
          Inner join salarie s on m.id_salarie = s.id_salarie 
          Where id_poste = 14 ";
$stmt = $conn->prepare($query);
$stmt->execute();
$result_salarie = $stmt->fetchAll();

$query = "Select num_chambre, type FROM chambre";
$stmt = $conn->prepare($query);
$stmt->execute();
$result_chambre = $stmt->fetchAll();

$query = "Select id_type_hospitalisation , type FROM type_hospitalisation";
$stmt = $conn->prepare($query);
$stmt->execute();
$result_type_hospitalisation = $stmt->fetchAll();

if (isset($_SESSION['insert_failed'])) {
    echo $_SESSION['insert_failed'];
    unset($_SESSION['insert_failed']);
}

?>
<!DOCTYPE html>
<html lang="fr">
<link href="./css/output.css" rel="stylesheet">
<script src="./js/retourPage.js"></script>
<script src="./js/checkForm1.js"></script>


<head>
    <meta charset="UTF-8">
    <title>Formulaire d'Hospitalisation</title>
</head>

<body class="bg-gray-100 flex justify-center items-center min-h-screen p-4">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full max-w-2xl">
        <div class="mb-6 text-center">
            <h1 class="text-3xl font-semibold mb-2">Bienvenue ! 👋</h1>
            <p>Nous vous remercions de bien vouloir remplir ce formulaire avec attention.</p>
        </div>

        <form action="./formulaire2.php" method="post" class="space-y-6">
            <h2 class="text-2xl font-bold text-center mb-6">Formulaire d'Hospitalisation</h2>

            <div class="mb-4">
                <label for="date_admission" class="block text-gray-700 text-sm font-bold mb-2">Date d'hospitalisation :</label>
                <input type="date" id="date_admission" name="date_admission" required class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>


            <div class="mb-4">
                <label for="heure_admission" class="block text-gray-700 text-sm font-bold mb-2">Heure d'inscription :</label>
                <input type="time" id="heure_admission" name="heure_admission" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div>
                <label for="type_hospitalisation" class="block text-gray-700 text-sm font-bold mb-2">Type d'hospitalisation :</label>
                <select id="type_hospitalisation" name="type_hospitalisation" required class="shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <?php
                    foreach ($result_type_hospitalisation as $row) {
                        echo "<option value='" . $row['id_type_hospitalisation'] . "'>" . $row['type'] . "</option>";
                    };
                    ?>
                </select>
            </div>

            <div>
                <label for="medecin" class="block text-gray-700 text-sm font-bold mb-2">Médecins :</label>
                <select id="medecin" name="medecin" required class="shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <?php
                    foreach ($result_salarie as $row) {
                        echo "<option value='" . $row['id_salarie'] . "'>" . $row['nom_salarie'] . "</option>";
                    };

                    ?>
                </select>
            </div>

            <div>
                <label for="chambre" class="block text-gray-700 text-sm font-bold mb-2">Type de chambre :</label>
                <select id="chambre" name="chambre" required class="shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <?php
                    foreach ($result_chambre as $row) {
                        echo "<option value='" . $row['num_chambre'] . "'>" . $row['type'] . "</option>";
                    };

                    ?>
                </select>
            </div>

            <!-- Bouton Soumettre -->
            <div class="flex items-center justify-between mt-6">
                <button type="button" onclick="retourPagePrecedente()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Retour
                </button>
                <input type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            </div>
        </form>
    </div>

</body>

</html>