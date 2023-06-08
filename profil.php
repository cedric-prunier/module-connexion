<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["connected"]) || $_SESSION["connected"] !== true) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: connexion.php");
    exit();
}

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

// Récupération des informations de l'utilisateur depuis la base de données
$login = $_SESSION["login"];
$sql = "SELECT * FROM utilisateurs WHERE login = '$login'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $login = $row["login"];
    $nom = $row["nom"];
    $prenom = $row["prenom"];
    $password = $row["password"];
} else {
    echo "Erreur : impossible de récupérer les informations de l'utilisateur.";
    exit();
}

// Traitement du formulaire de modification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des nouvelles valeurs du formulaire
    $nouveaulogin = $_POST["login"];
    $nouveauNom = $_POST["nom"];
    $nouveauPrenom = $_POST["prenom"];
    $nouveaupassword = $_POST["password"];

    // Mise à jour des informations dans la base de données
    $sql = "UPDATE utilisateurs SET login = '$nouveaulogin', nom = '$nouveauNom', prenom = '$nouveauPrenom', password = '$nouveaupassword' WHERE login = '$login'";

    if ($conn->query($sql) === TRUE) {
        echo "Informations mises à jour avec succès.";
        // Mettre à jour les valeurs dans la session
        $_SESSION["login"] = $nouveaulogin;
        $_SESSION["nom"] = $nouveauNom;
        $_SESSION["prenom"] = $nouveauPrenom;
        $_SESSION["password"] = $nouveaupassword;


    } else {
        echo "Erreur lors de la mise à jour des informations : " . $conn->error;
    }

}

// Fermeture de la connexion à la base de données
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Modifier le profil</title>
    <link rel="stylesheet" href="profil.css">
</head>

<body>
    <section>
        <form class="formulaire" action="profil.php" method="post">

            <img src="./images/logo_laplateforme.png" alt="logo laplateforme" />
            <br />

            <h1>Modifier votre profil</h1>

            <br />

            <label for="login">Login</label>
            <br>
            <input type="text" id="login" name="login" value="<?php echo $login; ?>" required>

            <br />

            <label for="prenom">Prénom</label>
            <br>
            <input type="text" id="prenom" name="prenom" value="<?php echo $prenom; ?>" required>

            <br>

            <label for="nom">Nom</label>
            <br>
            <input type="text" id="nom" name="nom" value="<?php echo $nom; ?>" required>

            <br />

            <label for="password">Mot de passe</label>
            <br>
            <input type="password" id="password" name="password" value="<?php echo $password; ?>" required>

            <br />
            <li class="options">
                <input type="submit" name="valider" value="Valider &#10004;" />
                <br />
            </li>

        </form>
    </section>
</body>

</html>