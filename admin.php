<?php
// Vérification de l'authentification

session_start();

if ($_SESSION['login'] !== 'admin') {
    // Redirection si l'utilisateur n'est pas authentifié en tant qu'admin
    header('Location: login.php');
    exit();
}
// Connexion à la base de données
$host = 'localhost';
$dbname = 'moduleconnexion';
$username = 'root';
$password = 'root';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
    exit();
}

// Récupération des informations des utilisateurs
$query = "SELECT * FROM utilisateurs";
$stmt = $db->query($query);
$utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrateur</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <h1>Liste des utilisateurs</h1>
    <?php if (!empty($utilisateurs)): ?>
        <table>
            <thead>
                <tr>
                    <?php foreach ($utilisateurs[0] as $key => $value): ?>
                        <th>
                            <?php echo $key; ?>
                        </th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($utilisateurs as $row): ?>
                    <tr>
                        <?php foreach ($row as $value): ?>
                            <td>
                                <?php echo $value; ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun résultat trouvé.</p>
    <?php endif; ?>
</body>

</html>