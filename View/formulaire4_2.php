<?php
require_once('../Model/config.php');
session_start();
global $conn;

var_dump($_SESSION);

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

function getCategorieP($cat_p)
{
    global $conn;
    $query = "SELECT id_categorie_personne, categorie_personne FROM categorie_personne";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}
$result_civilite = getCivilites($conn);
$result_pays = getPays($conn);
$result_categorie = getCategorieP($conn);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Coordonnées Personne Page 2</title>
    <link href="./css/output.css" rel="stylesheet">
    <script src="./js/retourPage.js"></script>
    <script src="./js/checkForm4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script>

</head>

<body class="bg-gray-100 flex justify-center items-center min-h-screen p-4">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full max-w-2xl">
        <h1 class="text-3xl font-semibold mb-6 text-center">Coordonnées Personne page 2</h1>
        <form action="./formulaire5.php" method="post" class="space-y-6">

            <!-- Section Coordonnées de la personne-->
            <div>
                <div class="mb-4">
                    <label for="nom_p2" class="block text-gray-700 text-sm font-bold mb-2">Nom :</label>
                    <input type="text" id="nom_p2" maxlength="50" name="nom_p2" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4">
                    <label for="prenom_p2" class="block text-gray-700 text-sm font-bold mb-2">Prénom :</label>
                    <input type="text" id="prenom_p2" maxlength="50" name="prenom_p2" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4">
                    <label for="num_tel_p2" class="block text-gray-700 text-sm font-bold mb-2">Téléphone :</label>
                    <input type="tel" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="01-23-45-67-89" id="num_tel_p2" maxlength="10" name="num_tel_p2" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4">
                    <label for="adresse_p2" class="block text-gray-700 text-sm font-bold mb-2">Adresse :</label>
                    <input type="text" id="adresse_p2" maxlength="50" name="adresse_p2" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4">
                    <label for="ville_p2" class="block text-gray-700 text-sm font-bold mb-2">Ville :</label>
                    <input type="text" id="ville_p2" maxlength="85" name="ville_p2" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4">
                    <label for="codePostal_p2" class="block text-gray-700 text-sm font-bold mb-2">Code Postal :</label>
                    <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" id="codePostal_p2" maxlength="5" max="99999" oninput="limitLength(this, 5)" name="codePostal_p2" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4">
                    <label for="id_pays_p2" class="block text-gray-700 text-sm font-bold mb-2">Pays :</label>
                    <select id="id_pays_p2" name="id_pays_p2" class="shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full" required>
                        <?php
                        foreach ($result_pays as $row) {
                            $selected = ($row['nom_fr_fr'] == 'France') ? 'selected' : '';
                            echo "<option value='" . $row['id'] . "' $selected>" . $row['nom_fr_fr'] . "</option>";
                        };
                        ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="civilite_p2" class="block text-gray-700 text-sm font-bold mb-2">Civilité :</label>
                    <select id="civilite_p2" name="civilite_p2" class="shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full" required>
                        <?php foreach ($result_civilite as $row) : ?>
                            <option value="<?= $row['id_civilite'] ?>"><?= $row['type_civ'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label for="id_categorie_personne_p2" class="text-gray-700 text-sm font-bold mb-2">Catégorie de la personne :</label>
                    <?php foreach ($result_categorie as $categorie) : ?>
                        <div class="checkbox inline-flex">
                            <label>
                                <input type="radio" name="id_categorie_personne_p2" value="<?php echo $categorie['id_categorie_personne']; ?>" required>
                                <?php echo $categorie['categorie_personne']; ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
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