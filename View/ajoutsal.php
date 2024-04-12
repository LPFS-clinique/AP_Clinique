<?php
require_once('../Model/config.php');
global $conn;
session_start();
if ($_SESSION['id_poste'] != 1) {
  header('Location: ../View/index.php?permission=denied');
  exit;
}


$query = "Select * 
FROM poste";
$stmt = $conn->prepare($query);
$stmt->execute();
$result_poste = $stmt->fetchAll();

$query = "Select *
FROM civilite";
$stmt = $conn->prepare($query);
$stmt->execute();
$result_civilite = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajoutsal</title>
</head>
<body>
<form action="../Controller/ajoutsal.php" method="POST" class="space-y-4">
  <div>
    <label for="mail_s" class="block text-sm font-medium text-gray-700">Email</label>
    <input type="email" name="mail_s" id="mail_s" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
  </div>

  <div>
    <label for="nom_s" class="block text-sm font-medium text-gray-700">Nom</label>
    <input type="text" name="nom_s" id="nom_s" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
  </div>

  <div>
    <label for="prenom_s" class="block text-sm font-medium text-gray-700">Prénom</label>
    <input type="text" name="prenom_s" id="prenom_s" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
  </div>

  <div>
  <label for="id_poste" class="block text-sm font-medium text-gray-700">ID Poste</label>
  <select name="id_poste" id="id_poste" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
    <?php foreach ($result_poste as $poste): ?>
      <option value="<?= $poste['id_poste']; ?>"><?= $poste['nom_poste']; ?></option>
    <?php endforeach; ?>
  </select>
</div>

<div>
  <label for="id_civilite" class="block text-sm font-medium text-gray-700">ID Civilité</label>
  <select name="id_civilite" id="id_civilite" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
    <?php foreach ($result_civilite as $civilite): ?>
      <option value="<?= $civilite['id_civilite']; ?>"><?= $civilite['type_civ']; ?></option>
    <?php endforeach; ?>
  </select>
</div>


  <div>
    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
      Ajouter salarié
    </button>
  </div>
</form>
</body>
</html>