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

    <script src="https://cdn.tiny.cloud/1/17u3v5r44xd0j0sjmegnk4mohqq8o1dxqdpcbkn6ncuvbxdq/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

</head>
<body>
<header>
    <div>
        <h1>GameSite</h1>
        <i class="fas fa-bars" id="button_menu"></i>
    </div>

    <nav class="header_menu">
        <a class="link_menu" href="/?c=home">Accueil</a>
        <a class="link_menu" href="/?c=article">Nos jeux</a>
        <a class="link_menu" href="/?c=user&a=contact">Contact</a>
        <?php
            if (!isset($_SESSION['user'])){?>
                <a class="link_menu" href="/?c=user&a=login">Connexion</a>/<a href="?c=user&a=register">Inscription</a>
                <?php
            }
            else {?>
                <a class="link_menu" href="/?c=user&a=profile">Profil</a>
                <a class="link_menu" href="/?c=user&a=dislog">Se déconnecter</a><?php
            }
        ?>
    </nav>
</header>

<main><?= $html ?></main>


<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.js"></script>
<script src="https://kit.fontawesome.com/f06b2f84ad.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="/assets/js/tinymce.js"></script>
<script src="/assets/js/Swiper.js"></script>
<script src="/assets/js/app.js"></script>
</body>
</html>
