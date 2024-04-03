<?php
session_unset();
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link href="./css/output.css" rel="stylesheet">
        <title>Page de Connexion</title>
    </head>

    <body class="bg-gray-100 h-screen flex justify-center items-center">

    

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col w-full sm:w-3/4 md:w-1/2 lg:w-1/3 xl:w-1/4 mx-auto">
            <div class="mb-4">
                <img class="mx-auto w-full" src="../images/lpfs_logo.png" alt="Logo lpf" />
            </div>
            <h1 class="mb-6 text-center text-sm sm:text-base md:text-lg font-bold">Connexion</h1>
            <form action="../Controller/ValidationConnexion.php" method="post" id="loginForm">
                <div id="message" class="text-red-500 mb-4">
                    <?php
                    if (isset($_SESSION['error'])) {
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    }
                    ?>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="identifiant">Identifiant :</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="identifiant" name="identifiant" required>
                </div>

                <div class="mb-6">
                    <div id="message" class="text-red-500 mb-4"></div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="mdp">Mot de passe :</label>
                    <div class="flex">
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password" id="mdp" name="mdp" required>
                        <button type="button" id="togglePassword" class="ml-2 py-2 px-3 bg-gray-200 rounded focus:outline-none">Montrer</button>
                    </div>
                </div>



                <div class="mb-4">
                    <img src="../Controller/captcha.php" alt="Captcha Image">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="captcha">Veuillez entrer le code ci-dessus :</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="captcha" name="captcha" required>
                </div>

                <div class="flex items-center justify-between">
                    <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" value="Se connecter" id="submitButton">
                </div>
            </form>
        </div>

        <script>
            document.getElementById("captcha").addEventListener("input", function() {
                if (this.value.length === 5) {
                    enableSubmit();
                }
            });


            document.getElementById("togglePassword").addEventListener("click", function() {
                let passwordInput = document.getElementById("mdp");
                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    this.innerText = "Cacher";
                } else {
                    passwordInput.type = "password";
                    this.innerText = "Montrer";
                }
            });
        </script>
    </body>
</html>