<?php
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


$keys = array_keys($_POST);
foreach ($keys as $input_name) {
    $_SESSION[$input_name] = $_POST[$input_name];
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Sécurité Sociale</title>
    <link href="./css/output.css" rel="stylesheet">
    <script src="./js/retourPage.js"></script>
    <script src="./js/checkForm3.js"></script>
</head>

<body class="bg-gray-100 flex justify-center items-center min-h-screen p-4">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full max-w-2xl">
        <div class="mb-6 text-center">
            <h1 class="text-3xl font-semibold mb-2">Formulaire de Sécurité Sociale</h1>
            <p>Remplissez ce formulaire avec attention pour assurer la sécurité de vos données.</p>
        </div>

        <form action="./formulaire4_1.php" method="post">
            <div class="mb-4">
                <label for="nom_secu" class="block text-gray-700 text-sm font-bold mb-2">Organisme de Sécurité Sociale</label>
                <input type="text" id="nom_secu" name="nom_secu" maxlength="45" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="num_secu" class="block text-gray-700 text-sm font-bold mb-2">Numéro de Sécurité Sociale</label>
                <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" id="num_secu" name="num_secu" maxlength="15" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <div id="erreurNumSecu" class="text-red-500"></div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Le patient est-il assuré ?</label>
                <div class="mt-2">
                    <label class="inline-flex items-center">
                        <input type="radio" name="assure" value="1" class="form-radio text-blue-500" required>
                        <span class="ml-2">Oui</span>
                    </label>
                    <label class="inline-flex items-center ml-6">
                        <input type="radio" name="assure" value="0" class="form-radio text-blue-500" required>
                        <span class="ml-2">Non</span>
                    </label>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Le patient est-il en ALD ?</label>
                <div class="mt-2">
                    <label class="inline-flex items-center">
                        <input type="radio" name="ald" value="1" class="form-radio text-blue-500" required>
                        <span class="ml-2">Oui</span>
                    </label>
                    <label class="inline-flex items-center ml-6">
                        <input type="radio" name="ald" value="0" class="form-radio text-blue-500" required>
                        <span class="ml-2">Non</span>
                    </label>
                </div>
            </div>

            <div class="mb-4">
                <label for="nom_mutu" class="block text-gray-700 text-sm font-bold mb-2">Nom de la mutuelle</label>
                <input type="text" id="nom_mutu" name="nom_mutu" maxlength="45" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="num_mutu" class="block text-gray-700 text-sm font-bold mb-2">Numéro Adhérent</label>
                <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" id="num_mutu" name="num_mutu" maxlength="20" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Chambre Particulière</label>
                <div class="mt-2">
                    <label class="inline-flex items-center">
                        <input type="radio" name="chambre_particuliere" value="1" class="form-radio text-blue-500" required>
                        <span class="ml-2">Oui</span>
                    </label>
                    <label class="inline-flex items-center ml-6">
                        <input type="radio" name="chambre_particuliere" value="0" class="form-radio text-blue-500" required>
                        <span class="ml-2">Non</span>
                    </label>
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

    <input type="hidden" value="<?php echo $_SESSION['date_naissance_pt']; ?>" id="date_naissance"></input>
    <input type="hidden" value="<?php echo $_SESSION['civilite_pt']; ?>" id="civilite_pt_cache"></input>
</body>

</html>