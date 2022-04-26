<?php

use App\Controller\AbstractController;

AbstractController::isConnected();

$messages = [
    "Error: Vous devez confirmer votre compte pour pouvoir vous connecter veuillez consulter vos mail.",
    "Error: Les identifiants ne sont pas valides.",
    "Error: Une erreur est survenu lors de la connexion veuillez réessayer plus tard, si le problème persiste contacter le support.",

];


if (isset($_GET['f'])) {
    $index = (int)$_GET['f'];
    $message = $messages[$index]; ?>
    <div class="error-message <?= strpos($message, "Error: ") === 0 ? 'error' : 'success' ?>"><?= $message ?></div>
    <?php
}

?>

<div class="container">
    <div id="container-login-form">
        <form action="?c=user&a=login" method="post">
            <div>
                <label for="email">Mail:</label>
                <input id="email" type="email" name="email" minlength="6" maxlength="150">
            </div>

            <div>
                <label for="password">Mot de passe:</label>
                <input id="password" type="password" name="password" minlength="8" maxlength="80">
            </div>


            <input type="submit" name="submit" value="Connexion">
        </form>
    </div>
</div>

