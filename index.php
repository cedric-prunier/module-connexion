<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Intranet_Laplateforme_Cannes</title>
        <link rel="stylesheet" href="./index.css" />
        <link rel="shortcut icon" href="./images/shortcut_icon.png" />
</head>

<body>
        <nav class="navbar">
                <ul class="logo">
                        <li><img src="./images/logo_laplateforme.png" alt="logo la plateforme" height="30" /></li>
                        <li class="search-container">
                                <input type="text" class="search-input" placeholder="Recherche" />
                                <button class="search-button"><i class="fa fa-search"></i><img src="./images/search.png"
                                                alt="search" height="10" /></button>
                        </li>
                </ul>

                <ul class="navlinks">
                        <?php
                        session_start();

                        if (isset($_SESSION['login'])) {
                                // Utilisateur connecté
                                if ($_SESSION['login'] === 'admin') {
                                        echo '<li class="projet"><a href="admin.php">Administration</a></li>';
                                }
                                echo '<li class="projet"><a href="profil.php">Profil</a></li>';
                                echo '<li><a href="logout.php">Déconnexion</a></li>';
                                echo '<li>Bonjour, ' . $_SESSION['login'] . '</li>';
                        } else {
                                // Aucun utilisateur connecté
                                echo '<li class="projet"><a href="inscription.php">Inscription</a></li>';
                                echo '<li class="projet"><a href="connexion.php">Connexion</a></li>';
                        }
                        ?>
                </ul>
                <div class="burger">
                        <span></span>
                </div>
        </nav>

        <div class="login" id="fenetre-login">
                <h1>Déconnexion</h1>
                <input type="submit" name="valider" value="Valider" />
                <button type="button" onclick="login.classList.remove('loginok');"><img src="./images/cross.png" alt=""
                                height="15" /></button>
        </div>

        <header></header>
        <footer>
                <p>© La Plateforme - Établissement d'enseignement supérieur technique privé - Tous droits réservés. |
                        Mentions légales | Cookies | Référent handicap : Jessica Soriano</p>
                <div>
                        <a href="https://twitter.com/LaPlateformeIO" target="_blank"><img src="./images/twitter.svg"
                                        alt="twiter" height="20" /></a>
                        <a href="https://www.instagram.com/LaPlateformeIO/" target="_blank"><img
                                        src="./images/instagram.svg" alt="instagram" height="20" /></a>
                        <a href="https://www.linkedin.com/school/laplateformeio/" target="_blank"><img
                                        src="./images/linkedin-in.svg" alt="linkedin" height="20" /></a>
                        <a href="https://www.facebook.com/LaPlateformeIO" target="_blank"><img
                                        src="./images/facebook-f.svg" alt="facebook" height="20" /></a>
                </div>
        </footer>
</body>

<script>
        const burger = document.querySelector(".burger");
        const navlinks = document.querySelector(".navlinks");
        burger.addEventListener("click", () => {
                navlinks.classList.toggle("mobile-menu");
        });
</script>
<script>
        const menuburger = document.querySelector(".burger");

        menuburger.addEventListener("click", () => {
                menuburger.classList.toggle("cross");
        });
</script>
<script>
        const body = document.querySelector("body");

        body.addEventListener("click", (e) => {
                if (e.target !== user && e.target !== login && !login.contains(e.target)) {
                        if (login.classList.contains("loginok")) {
                                login.classList.remove("loginok");
                        }
                }
        });
</script>
<script>
        // Script pour lancer la recherche quand on clique sur le bouton
        document.querySelector(".search-button").addEventListener("click", function () {
                let query = document.querySelector(".search-input").value;
                if (query) {
                        // ici, mettez votre code pour effectuer la recherche
                        console.log("Recherche pour: " + query);
                }
        });
</script>

</html>