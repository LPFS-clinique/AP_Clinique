<?php
session_start();
require_once('../Model/config.php');

if (!isset($_SESSION['id_login'])) {
    header('Location: ./index.php');
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changement de mot de passe</title>
    <link href="./css/output.css" rel="stylesheet">
    <script defer src="/View/js/checkPasswords.js"></script>
</head>

<body class="bg-gray-200 py-10">
    <div id="message" class="text-red-500 mb-4">
        <?php
        if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        }
        ?>
    </div>


    <div class="max-w-md mx-auto bg-white p-5 rounded-lg shadow-md">
        <h1 class="text-xl font-bold mb-5">Changement de mot de passe</h1>

        <form action="../Controller/formulaire_modif_mdp.php" method="POST">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2" for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" value="<?php echo $_SESSION['username']; ?>" readonly>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2" for="newPassword">Nouveau mot de passe</label>
                <input type="password" id="newPassword" name="newPassword" class="mt-1 p-2 w-full border rounded-md" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2" for="repeatNewPassword">Répétez le nouveau mot de passe</label>
                <input type="password" id="repeatNewPassword" name="repeatNewPassword" class="mt-1 p-2 w-full border rounded-md" required>
            </div>

            <div id="passwordConditions">
                Votre mot de passe doit contenir :
                <ul>
                    <li id="condition-length">De 16 à 30 caractères</li>
                    <li id="condition-lowercase">Au moins une minuscule</li>
                    <li id="condition-uppercase">Au moins une majuscule</li>
                    <li id="condition-digit">Au moins un chiffre</li>
                    <li id="condition-specialchar">Au moins un caractère spécial (ex : @, $, !, %, *, ?, &)</li>
                </ul>
            </div>

            <div class="mb-4">
                <img src="../Controller/captcha.php" alt="Captcha Image">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="captchaUser">Veuillez entrer le code ci-dessus :</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="captcha" name="captchaUser" required>
            </div>


            <div class="flex items-center justify-between">
                <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" value="Changer le mot de passe" id="submitButton" disabled>
            </div>
        </form>
    </div>

</body>

</html>