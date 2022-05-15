<?php

use App\Controller\AbstractController;

AbstractController::isConnected();

$messages = [
    "Error: Vous devez confirmer votre compte pour pouvoir vous connecter veuillez consulter vos mail.",
    "Error: Un ou plusieurs champ sont manquant.",
    "Error: Les identifiants ne sont pas valides.",
    "Error: Une erreur est survenu lors de la connexion veuillez réessayer plus tard, si le problème persiste contacter le support.",
    "Success: Mot de passe changer avec succès",
    "Success: Votre compte à été confirmer avec succès !",

];


if (isset($_GET['f'])) {
    $index = (int)$_GET['f'];
    if ($index > count($messages)) {
        header("Location: /?c=user&a=login");
        exit();
    }
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
                <input id="email_login" type="email" name="email" minlength="6" maxlength="150" required>
            </div>

            <div>
                <label for="password">Mot de passe:</label>
                <input id="password_login" type="password" name="password" minlength="8" maxlength="25" required>
            </div>
            <a id="forgotPassword" href="/?c=user&a=forgot-password">J'ai oublier mon mot de passe ?</a>

            <input type="submit" name="submit" value="Connexion">
        </form>
    </div>
</div>

