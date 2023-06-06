<?php
// Connexion à la base de données (à adapter avec vos propres informations)
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "moduleconnexion";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
        die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

// Vérification du formulaire de connexion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupération des valeurs du formulaire
        $login = $_POST["login"];
        $password = $_POST["password"];

        // Requête pour vérifier l'utilisateur correspondant
        $sql = "SELECT * FROM utilisateurs WHERE login = '$login' AND password = '$password'";
        $result = $conn->query($sql);

        // Vérification si un utilisateur correspondant a été trouvé
        if ($result->num_rows == 1) {
                // Utilisateur trouvé, création des variables de session
                session_start();
                $_SESSION["login"] = $login;
                $_SESSION["connected"] = true;

                // Redirection vers une page sécurisée (par exemple, index.php)
                header("Location: index.php");

                exit();
        } else {
                // Aucun utilisateur correspondant trouvé, affichage d'un message d'erreur
                echo "Identifiants invalides.";
        }
}

// Fermeture de la connexion à la base de données
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Intranet_Laplateforme_Cannes</title>
        <link rel="stylesheet" href="./connexion.css" />
        <link rel="shortcut icon" href="./images/shortcut_icon.png" />
</head>

<body>
        <form class="login" action="connexion.php" method="post">
                <img class="logo" src="./images/logo_laplateforme.png" alt="logo plateforme" />
                <br />
                <h1>Connexion intranet</h1>
                <div class="identifiant">
                        <div class="input">
                                <input type="text" name="login" placeholder="Login" />

                                <input type="password" name="password" placeholder="Mot de passe" id="password" />
                        </div>
                        <button class="eye" type="button" onclick="togglePassword()" id="toggle-password"><img
                                        src="./images/eye-open.svg" alt="" /></button>
                </div>

                <div>
                        <input type="checkbox" name="remember" id="remember" />
                        <label class="remember" for="remember" id="remember">Se souvenir de moi</label><br />
                </div>

                <a href="#">Mot de passe oublié ?</a>

                <a href="./inscription.php"> Créer un compte </a>

                <div>
                        <input type="submit" name="valider" value="Valider" />
                        <input type="reset" name="reset" value="Effacer" />
                </div>
        </form>
        <header></header>
</body>
<script>
        function togglePassword() {
                const passwordInput = document.getElementById("password");
                const togglePasswordButton = document.getElementById("toggle-password");
                const img = togglePasswordButton.querySelector("img");

                if (passwordInput.type === "password") {
                        passwordInput.type = "text";
                        img.src = "./images/eye-closed.svg";
                } else {
                        passwordInput.type = "password";
                        img.src = "./images/eye-open.svg";
                }
        }
</script>

</html>