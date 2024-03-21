<?php
global $conn;
require_once('../Model/config.php');
session_start();

$query = "Select * from civilite";
$stmt = $conn->prepare($query);
$stmt->execute();
$result_civilite = $stmt->fetchAll();

$query2 = "Select * from poste";
$stmt2 = $conn->prepare($query2);
$stmt2->execute();
$result_poste = $stmt2->fetchAll();

$query3 = "Select * from services ";
$stmt3 = $conn->prepare($query3);
$stmt3->execute();
$result_service = $stmt3->fetchAll();

$query4= "SELECT nom_salarie , prenom_salarie FROM `salarie` WHERE id_poste = 14 " ;
$stmt4 = $conn->prepare($query4);
$stmt4->execute();
$result_salarie = $stmt4->fetchAll();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Panel Administrateur</title>
</head>

<body class="bg-gray-100 font-sans">

    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white">
            <div class="p-4">
                <!-- Logo -->
                <img src="../images/lpfs_logo.png" alt="Logo" class="w-25 h-25 mb-4 mx-auto rounded-full">
                <h1 class="text-2xl font-bold">Admin Panel</h1>
            </div>
            <nav class="mt-4">
                <a href="service.php" class="block py-2 px-4 text-gray-300 hover:bg-gray-800 hover:text-white">Services</a>
                <a href="#" class="block py-2 px-4 text-gray-300 hover:bg-gray-800 hover:text-white">Médecins</a>
                <a href="./formulaire1.php" class="block py-2 px-4 text-gray-300 hover:bg-gray-800 hover:text-white">Pré Admission</a>
            </nav>
        </aside>

        <!-- Main content -->
        <main class="flex-1 flex flex-col overflow-hidden">
            <!-- Top bar -->
            <div class="bg-gray-800 p-4">
                <h2 class="text-white text-lg font-semibold">Bienvenue, Administrateur ! Vous avez les autorisations pour la modification des éléments suivants ↓</h2>
            </div>

                <!-- Exemple de formulaire pour créer / modifier / supprimer un service -->
                <div class="mb-8">
                    <u><h3 class="text-3xl font-semibold mb-4">Gestion des médecins</h3></u>
                    <br>
                    
                    <form action = "../Controller/insert_salarie.php" method="POST" class="w-full max-w-2xl bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        <div class="mb-4">
                            <label for="mail" class="block text-gray-700 text-sm font-bold mb-2">Mail</label>
                            <input type="mail" id="mail" name="mail" class="w-full p-3 border rounded">
                        </div>
                        <div class="mb-4">
                            <label for="nom_salarie" class="block text-gray-700 text-sm font-bold mb-2">Nom du salarié</label>
                            <input type="text" id="nom_salarie" name="nom_salarie" class="w-full p-3 border rounded">
                        </div>
                        <div class="mb-4">
                            <label for="prenom_salarie" class="block text-gray-700 text-sm font-bold mb-2">Prénom du salarié</label>
                            <input type="text" id="prenom_salarie" name="prenom_salarie" class="w-full p-3 border rounded">
                        </div>
                        
                        <div class="mb-4">
                            <label for="id_poste" class="block text-gray-700 text-sm font-bold mb-2">Poste du salarié</label>
                            <select id="id_poste" name="id_poste" class="shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <?php
                            foreach ($result_poste as $row) {
                            echo "<option value='" . $row['id_poste'] . "'>" . $row['nom_poste'] . "</option>";
                        };

                        ?>
                        </select>
                        <br>
                        <br>
                        
                
                        </div>

                        <div class="mb-4">
                        <label for="id_civilite" class="block text-gray-700 text-sm font-bold mb-2">Civilité du salarié :</label>
                        <select id="id_civilite" name="id_civilite" required class="shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <?php
                            foreach ($result_civilite as $row) {
                            echo "<option value='" . $row['id_civilite'] . "'>" . $row['type_civ'] . "</option>";
                        };

                        ?>
                        </select>

                        <div class="mb-4">
                        <label for="id_service" class="block text-gray-700 text-sm font-bold mb-2">Service du médecin :</label>
                        <select id="id_service" name="id_service" required class="shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <?php
                            foreach ($result_service as $row) {
                            echo "<option value='" . $row['id_service'] . "'>" . $row['nom_service'] . "</option>";
                        };

                        ?>
                        </select>

                        <br>
                        <br>
                            <button type="submit"name="formulaire1" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Créer</button>
                            <input type="submit" value="Update" name="update_button2" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-700"></input>
                            <input type="submit" value="Delete" name="delete_button2" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-700"></input>
                        </div>
                    </form>

                    <!-- Afficher la liste des services existants avec des options de modification et de suppression -->
                
                        </ul>
                    </div>
                    
                <div class="mt-8">
                        <h4 class="text-xl font-semibold mb-4">Liste des médecins ↓</h4>
                        <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <select id="id_salarie" name="id_salarie" required class="shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <?php
                            foreach ($result_salarie as $row) {
                            echo "<option value='" . $row['id_salarie'] . "'>" . $row['nom_salarie'] . "</option>";
                        };

                        ?>
                        </select>

                </div>

            
            </div>
        </main>
    </div>

</body>

</html>