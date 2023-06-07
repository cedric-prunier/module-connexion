<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les valeurs du formulaire
        $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
        $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
        $login = isset($_POST['login']) ? $_POST['login'] : '';
        $form_password = isset($_POST['password']) ? $_POST['password'] : '';
        $password_check = isset($_POST['password_check']) ? $_POST['password_check'] : '';

        // Vérifier si les mots de passe correspondent
        if ($form_password !== $password_check) {
                echo "Les mots de passe ne correspondent pas.";
                // Vous pouvez également rediriger l'utilisateur vers une page d'erreur ou afficher un message d'erreur approprié.
                exit;
        }

        // Encoder le mot de passe
        $hashed_password = password_hash($form_password, PASSWORD_DEFAULT);

        // Connexion à la base de données
        $servername = "localhost"; // Remplacez par l'adresse de votre serveur de base de données
        $username = "root"; // Remplacez par votre nom d'utilisateur de la base de données
        $password = "root"; // Remplacez par votre mot de passe de la base de données
        $dbname = "moduleconnexion"; // Remplacez par le nom de votre base de données

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Vérifier la connexion à la base de données
        if ($conn->connect_error) {
                die("La connexion à la base de données a échoué : " . $conn->connect_error);
        }

        // Vérifier si l'utilisateur existe déjà avec le même login
        $existing_user_query = "SELECT * FROM utilisateurs WHERE login='$login'";
        $existing_user_result = $conn->query($existing_user_query);
        if ($existing_user_result->num_rows > 0) {
                echo "Un utilisateur avec le même login existe déjà.";
                exit;
        }

        // Préparer et exécuter la requête d'insertion
        $sql = "INSERT INTO utilisateurs (nom, prenom, login, password) VALUES ('$nom', '$prenom', '$login', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
                echo "Les données ont été ajoutées avec succès à la base de données.";

                // Redirection vers la page de connexion
                header("Location: connexion.php");
                exit;
        } else {
                echo "Une erreur s'est produite lors de l'ajout des données à la base de données : " . $conn->error;
        }

        // Fermer la connexion à la base de données
        $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Intranet_Laplateforme_Cannes_inscription</title>
        <link rel="stylesheet" href="inscription.css" />
        <link rel="shortcut icon" href="./images/shortcut_icon.png" />
</head>

<body>
        <section>
                <form class="formulaire" action="inscription.php" method="post">
                        <ul>
                                <img src="./images/logo_laplateforme.png" alt="logo laplateforme" />
                                <br />
                                <li>
                                        <h1>Formulaire d'inscription</h1>
                                </li>
                                <br />
                                <li>
                                        <label for="nom">Nom</label>
                                        <input type="text" id="nom" name="nom" placeholder="Entrez votre nom" />
                                </li>
                                <br />
                                <li>
                                        <label for="prenom">Prénom</label>
                                        <input type="text" id="prenom" name="prenom"
                                                placeholder="Entrez votre prénom" />
                                </li>
                                <br />
                                <li>
                                        <label for="login">Identifiant</label>
                                        <input type="text" id="login" name="login"
                                                placeholder="Entrez votre identifiant" />
                                </li>
                                <br />
                                <li class="password">
                                        <label for="password">Mot de passe</label>
                                        <input type="password" id="password" name="password"
                                                placeholder="Entrez votre mot de passe" />
                                </li>
                                <br />
                                <li class="password_check">
                                        <label for="password_check">Confirmer MDP</label>
                                        <input type="password" id="password_check" name="password_check"
                                                placeholder="Entrez à nouveau votre MDP" />
                                </li>
                                <br />
                                <li class="options">
                                        <input type="submit" name="valider" value="Valider &#10004;" />
                                        <br />
                                        <input type="reset" name="reset" value="Effacer &#10005;" />
                                </li>
                        </ul>
                </form>
        </section>
</body>

</html>