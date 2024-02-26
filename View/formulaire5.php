<?php
session_start();

$dateNaissance = new DateTime($_SESSION['date_naissance_pt']);
$aujourdhui = new DateTime('now');
$age = $aujourdhui->diff($dateNaissance)->y;
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Formulaire d'Hospitalisation</title>
    <link href="./css/output.css" rel="stylesheet">
    <script src="./js/retourPage.js"></script>
    <script src="./js/checkForm5.js"></script>

</head>

<body class="bg-gray-100 flex justify-center items-center min-h-screen p-4">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full max-w-2xl">

        <div class="mb-6 text-center">
            <h1 class="text-3xl font-semibold mb-2">Pièces à joindre 📄 </h1>
            <p>Merci de remplir les critères du formulaire. <br> ( PNG , PDF ) ⚠️</p>
        </div>

        <form action="../Model/insert.php" method="post" enctype="multipart/form-data" class="space-y-6">
            <div class="mb-4">
                <label for="carte_identite_recto" class="block text-gray-700 text-sm font-bold mb-2">Carte d'identité (Recto) :</label>
                <input type="file" id="carte_identite_recto" name="carte_identite_recto" accept="image/*" required class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="carte_identite_verso" class="block text-gray-700 text-sm font-bold mb-2">Carte d'identité (Verso) :</label>
                <input type="file" id="carte_identite_verso" name="carte_identite_verso" accept="image/*" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="carte_vitale" class="block text-gray-700 text-sm font-bold mb-2">Carte Vitale :</label>
                <input type="file" id="carte_vitale" name="carte_vitale" accept="image/*" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="carte_mutuelle" class="block text-gray-700 text-sm font-bold mb-2">Carte de Mutuelle :</label>
                <input type="file" id="carte_mutuelle" name="carte_mutuelle" accept="image/*" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4" id="div_livret_famille">
                <label for="livret_famille" class="block text-gray-700 text-sm font-bold mb-2">Livret de Famille :</label>
                <input type="file" id="livret_famille" name="livret_famille" accept="image/*" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
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


<input type="hidden" value="<?php echo $age; ?>" id="ageUser"></input>

<?php
$keys = array_keys($_POST);
foreach ($keys as $input_name) {
    $_SESSION[$input_name] = $_POST[$input_name];
}
var_dump($_SESSION);
echo $age;
?>

</html>