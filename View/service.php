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

?>

<!DOCTYPE html>
<html lang="fr">

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
                <a href="pannel.php" class="block py-2 px-4 text-gray-300 hover:bg-gray-800 hover:text-white">Médecins</a>
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
                    <u><h3 class="text-3xl font-semibold mb-4">Gestion des services</h3></u>
                    <br>
                    
                    <form action = "../Controller/insert_service.php" method="POST" class="w-full max-w-2xl bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <div class="mb-4">
                            <label for="nom_service" class="block text-gray-700 text-sm font-bold mb-2">nom du service</label>
                            <input type="nom_service" id="nom_service" name="nom_service" class="w-full p-3 border rounded">
                        </div>  
                    
                        <br>
                        <br>
                            <input type="submit" value="Créer" name="add_button" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700"></input>
                            <input type="submit" value="Update" name="update_button" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-700"></input>
                            <input type="submit" value="Delete" name="delete_button" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-700"></input>
                        </div>
                    </form>
                    
        
                    
                    <!-- Afficher la liste des services existants avec des options de modification et de suppression -->
                    <div class="mt-8">
                        <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        
                        <div class="mb-4">
                        <label for="id_service" class="block text-gray-700 text-sm font-bold mb-2">Services :</label>
                        <select id="id_service" name="id_service" required class="shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <?php
                            foreach ($result_service as $row) {
                            echo "<option value='" . $row['id_service'] . "'>" . $row['nom_service'] . "</option>";
                        };

                        ?>
                        </select>
                        
                        
                        
                        
                        <!-- Exemple d'élément de la liste -->
                            <!-- Répéter pour chaque service existant -->
                        </ul>
                    </div>
                </div>

            
            </div>
        </main>
    </div>

</body>

</html>