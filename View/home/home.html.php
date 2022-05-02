<?php
$messages = [
    "Success: Connexion réussi ! Bienvenue !",
    "Error: Vous avez été déconnecter",
];


if (isset($_GET['f'])) {
    $index = (int)$_GET['f'];
    if ($index > count($messages)) {
        header("Location: /?c=home");
        exit();
    }
    $message = $messages[$index]; ?>
    <div class="error-message <?= strpos($message, "Error: ") === 0 ? 'error' : 'success' ?>"><?= $message ?></div>
    <?php
}

?>

<div id="menu-container">
    <div class="menu">
        <a href="?c=article">
            <div class="home-menu"><i class="fas fa-gamepad"></i></div>
        </a>

        <a href="/?c=globalChat">
            <div class="home-menu"><i class="fas fa-comments"></i></div>
        </a>

        <a href="/?c=news">
            <div class="home-menu"><i class="far fa-newspaper"></i></div>
        </a>

        <a href="/?c=user&a=contact">
            <div class="home-menu"><i class="fas fa-envelope"></i></div>
        </a>

        <a href="">
            <div class="home-menu"><i class="fab fa-discord"></i></div>
        </a>

    </div>
</div>

<footer id="home-footer">
    <div>footer</div>
</footer>

