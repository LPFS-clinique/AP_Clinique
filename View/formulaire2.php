<?php
require_once('../Model/config.php');

global $conn;

session_start();

$query = "Select * from civilite";
$stmt = $conn->prepare($query);
$stmt->execute();
$result_civilite = $stmt->fetchAll();

$query = "Select id, nom_fr_fr from pays";
$stmt = $conn->prepare($query);
$stmt->execute();
$result_pays = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Formulaire Patient</title>
    <link href="./css/output.css" rel="stylesheet">
    <script src="./js/retourPage.js" defer></script>
    <script src="./js/checkForm2.js" defer></script>
</head>

<body class="bg-gray-100 flex justify-center items-center min-h-screen p-4">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full max-w-2xl">
        <div class="mb-6 text-center">
            <h1 class="text-3xl font-semibold mb-2">Formulaire Patient 👋</h1>
            <p>Nous vous remercions de bien vouloir remplir ce formulaire avec attention.</p>
        </div>


        <form action="./formulaire3.php" method="post" class="space-y-6">
            <h2 class="text-2xl font-bold text-center mb-6">Informations du Patient</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="id_pays_pt" class="block text-gray-700 text-sm font-bold mb-2">Pays :</label>
                    <select id="id_pays_pt" name="id_pays_pt" required class="shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full" required>
                        <?php
                        foreach ($result_pays as $row) {
                            $selected = ($row['nom_fr_fr'] == 'France') ? 'selected' : '';
                            echo "<option value='" . $row['id'] . "' $selected>" . $row['nom_fr_fr'] . "</option>";
                        };
                        ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="nom_naissance_pt" class="block text-gray-700 text-sm font-bold mb-2">Nom de Naissance :</label>
                    <input type="text" id="nom_naissance_pt" name="nom_naissance_pt" maxlength="50" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div id="divNomEpouse" class="mb-4">
                    <label for="nom_epouse" class="block text-gray-700 text-sm font-bold mb-2">Nom d'Épouse :</label>
                    <input type="text" id="nom_epouse" name="nom_epouse" maxlength="50" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label for="prenom" class="block text-gray-700 text-sm font-bold mb-2">Prénom :</label>
                    <input type="text" id="prenom" name="prenom_pt" maxlength="50" required class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4">
                    <label for="date_naissance_pt" class="block text-gray-700 text-sm font-bold mb-2">Date de Naissance :</label>
                    <input type="date" id="date_naissance_pt" name="date_naissance_pt" required class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
            </div>


            <div>
                <label for="civilite_pt" class="block text-gray-700 text-sm font-bold mb-2">Civilité :</label>
                <select id="civilite_pt" name="civilite_pt" required class="shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <?php
                    foreach ($result_civilite as $row) {
                        echo "<option value='" . $row['id_civilite'] . "'>" . $row['type_civ'] . "</option>";
                    };
                    ?>
                </select>


                <div class="mb-4">
                    <label for="adresse_pt" class="block text-gray-700 text-sm font-bold mb-2">Adresse :</label>
                    <input type="text" id="adresse_pt" name="adresse_pt" maxlength="50" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>


                <div class="mb-4">
                    <label for="code_postal_pt" class="block text-gray-700 text-sm font-bold mb-2">Code Postal :</label>
                    <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" id="code_postal_pt" name="code_postal_pt" minlength="5" maxlength="5" max="99999" oninput="limitLength(this, 5)" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>


                <div class="mb-4">
                    <label for="ville_pt" class="block text-gray-700 text-sm font-bold mb-2">Ville :</label>
                    <input type="text" id="ville_pt" name="ville_pt" maxlength="85" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4">
                    <label for="email_pt" class="block text-gray-700 text-sm font-bold mb-2">Email :</label>
                    <input type="email" id="email_pt" name="email_pt" maxlength="55" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label for="telephone_pt" class="block text-gray-700 text-sm font-bold mb-2">N° de Téléphone :</label>
                    <input type="tel" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="01-23-45-67-89" id="telephone_pt" minlength="10" maxlength="10" name="telephone_pt" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
            </div>

            <div class="flex items-center justify-between mt-6">
                <button type="button" onclick="retourPagePrecedente()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Retour
                </button>
                <input type="submit" class=" bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            </div>
        </form>
    </div>

    </div>



</body>
<?php
$keys = array_keys($_POST);

foreach ($keys as $input_name) {
    $_SESSION[$input_name] = $_POST[$input_name];
}
var_dump($_SESSION);

?>

</html>