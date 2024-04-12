<?php
require_once('../Model/config.php');
session_start();
$admin = array(3, 4, 5);
$medecin = array(15, 16, 17);
if ($_SESSION['id_poste'] != 18) {
}else{
    if  (in_array($_SESSION['id_poste'], $admin)) {
    header('Location: ../View/pannel.php?permissionForm=denied');
    exit;
    }else {
        header('Location: ../View/medecinpread.php/?permissionForm=denied');
        exit;
    }
}


function getCivilites($conn)
{
    $query = "SELECT * FROM civilite";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getPays($conn)
{
    $query = "SELECT id, nom_fr_fr FROM pays";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

$result_civilite = getCivilites($conn);
$result_pays = getPays($conn);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Coordonnées Personne</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./js/retourPage.js"></script>
    <script src="./js/checkForm4.js"></script>
</head>

<body class="bg-gray-100 flex justify-center items-center min-h-screen p-4">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full max-w-2xl">
        <h1 class="text-3xl font-semibold mb-6 text-center">Coordonnées Personne</h1>
        <form action="./formulaire5.php" method="post" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Section Coordonnées de la personne de confiance -->
                <div>
                    <div class="mb-4">
                        <label for="nom_pc" class="block text-gray-700 text-sm font-bold mb-2">Nom de la personne de confiance:</label>
                        <input type="text" id="nom_pc" maxlength="50" name="nom_pc" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <div class="mb-4">
                        <label for="prenom_pc" class="block text-gray-700 text-sm font-bold mb-2">Prénom :</label>
                        <input type="text" id="prenom_pc" maxlength="50" name="prenom_pc" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <div class="mb-4">
                        <label for="num_tel_pp" class="block text-gray-700 text-sm font-bold mb-2">Téléphone :</label>
                        <input type="number" id="num_tel_pp" maxlength="10" name="num_tel_pp" pattern="[0-9]{10}" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <div class="mb-4">
                        <label for="adresse_pc" class="block text-gray-700 text-sm font-bold mb-2">Adresse :</label>
                        <input type="text" id="adresse_pc" maxlength="50" name="adresse_pc" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <div class="mb-4">
                        <label for="ville_pc" class="block text-gray-700 text-sm font-bold mb-2">Ville :</label>
                        <input type="text" id="ville_pc" maxlength="85" name="ville_pc" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <div class="mb-4">
                        <label for="codePostal_pc" class="block text-gray-700 text-sm font-bold mb-2">Code Postal :</label>
                        <input type="number" id="codePostal_pc" maxlength="5" max="99999" oninput="limitLength(this, 5)" name="codePostal_pc" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <div class="mb-4">
                        <label for="id_pays_pc" class="block text-gray-700 text-sm font-bold mb-2">Pays :</label>
                        <select id="id_pays_pc" name="id_pays_pc" requiredd class="shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full" required>
                            <?php
                            foreach ($result_pays as $row) {
                                $selected = ($row['nom_fr_fr'] == 'France') ? 'selected' : '';
                                echo "<option value='" . $row['id'] . "' $selected>" . $row['nom_fr_fr'] . "</option>";
                            };
                            ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="civilite_pc" class="block text-gray-700 text-sm font-bold mb-2">Civilité :</label>
                        <select id="civilite_pc" name="civilite_pc" requiredd class="shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full" required>
                            <?php foreach ($result_civilite as $row) : ?>
                                <option value="<?= $row['id_civilite'] ?>"><?= $row['type_civ'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div hidden>
                        <label for="id_categorie_personne_pc" class="block text-gray-700 text-sm font-bold mb-2">Catégorie de la personne :</label>
                        <select id="id_categorie_personne_pc" name="id_categorie_personne_pc" requiredd class="shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full" required>
                            <option value="1">1</option>
                        </select>
                    </div>
                </div>

                <!-- Section Coordonnées de la personne à prévenir -->
                <div>
                    <div class="mb-4">
                        <label for="nom_pp" class="block text-gray-700 text-sm font-bold mb-2">Nom de la personne à prévenir:</label>
                        <input type="text" id="nom_pp" maxlength="50" name="nom_pp" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <div class="mb-4">
                        <label for="prenom_pp" class="block text-gray-700 text-sm font-bold mb-2">Prénom :</label>
                        <input type="text" id="prenom_pp" maxlength="50" name="prenom_pp" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <div class="mb-4">
                        <label for="num_tel_pc" class="block text-gray-700 text-sm font-bold mb-2">Téléphone :</label>
                        <input type="number" id="num_tel_pc" maxlength="10" max="9999999999" name="num_tel_pc" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <div class="mb-4">
                        <label for="adresse_pp" class="block text-gray-700 text-sm font-bold mb-2">Adresse :</label>
                        <input type="text" id="adresse_pp" maxlength="50" name="adresse_pp" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <div class="mb-4">
                        <label for="ville_pp" class="block text-gray-700 text-sm font-bold mb-2">Ville :</label>
                        <input type="text" id="ville_pp" maxlength="85" name="ville_pp" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <div class="mb-4">
                        <label for="codePostal_pp" class="block text-gray-700 text-sm font-bold mb-2">Code Postal :</label>
                        <input type="number" id="codePostal_pp" maxlength="5" max="99999" oninput="limitLength(this, 5)" name="codePostal_pp" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <div class="mb-4">
                        <label for="id_pays_pp" class="block text-gray-700 text-sm font-bold mb-2">Pays :</label>
                        <select id="id_pays_pp" name="id_pays_pp" class="shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full" required>
                            <?php
                            foreach ($result_pays as $row) {
                                $selected = ($row['nom_fr_fr'] == 'France') ? 'selected' : '';
                                echo "<option value='" . $row['id'] . "' $selected>" . $row['nom_fr_fr'] . "</option>";
                            };
                            ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="civilite_pp" class="block text-gray-700 text-sm font-bold mb-2">Civilité :</label>
                        <select id="civilite_pp" name="civilite_pp" class="shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none" required>
                            <?php
                            foreach ($result_civilite as $row) {
                                echo "<option value='" . $row['id_civilite'] . "'>" . $row['type_civ'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div hidden>
                        <label for="id_categorie_personne_pp" class="block text-gray-700 text-sm font-bold mb-2">Catégorie de la personne :</label>
                        <select id="id_categorie_personne_pp" name="id_categorie_personne_pp" requiredd class="shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none" required>
                            <option value="2">2</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between mt-6">
                <button type="button" onclick="retourPagePrecedente()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Retour
                </button>
                <input type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            </div>
        </form>
    </div>
</body>

<?php
$keys = array_keys($_POST);
foreach ($keys as $input_name) {
    $_SESSION[$input_name] = $_POST[$input_name];
}
?>

</html>