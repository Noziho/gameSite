<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>GameSite</title>
    <meta name="viewport" content="width=device-width,
  user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
</head>
<body>
<header>
    <div><input type="text" id="searchBar" placeholder="Recherche ..."></div>

    <nav>
        <a href="/?c=home">Accueil</a>
        <a href="/?c=home&a=game">Nos jeux</a>
        <a href="/?c=user&a=contact">Contact</a>
        <?php
            if (!isset($_SESSION['user'])){?>
                <a href="/?c=user&a=login">Connexion</a>/<a href="?c=user&a=register">Inscription</a>
                <?php
            }
            else {?>
                <a href="/?c=user&a=dislog">Se déconnecter</a><?php
            }
        ?>
    </nav>
</header>

<main><?= $html ?></main>




<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="/assets/js/Swiper.js"></script>
<script src="/assets/js/app.js"></script>
</body>
</html>
