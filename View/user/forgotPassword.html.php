<?php
$messages = [
    "Error: L'email n'est pas au format mail@exemple.com .",
    "Success: Un mail de réinitialisation de mot de passe vous à été envoyé.",
    "Error: Cette email ne correspond à aucun compte.",


];

if (isset($_GET['f'])) {
    $index = (int)$_GET['f'];
    if ($index > count($messages)) {
        header("Location: /?c=user&a=forgot-password");
        exit();
    }
    $message = $messages[$index]; ?>
    <div class="error-message <?= strpos($message, "Error: ") === 0 ? 'error' : 'success' ?>"><?= $message ?></div>
    <?php
}
?>
<h1>Oublie de mot de passe</h1>

<div class="container">
    <div id="container-login-form">
        <form action="/?c=user&a=forgot-password" method="post">
            <label for="email">Votre Email :</label>
            <input type="email" id="email" name="email">

            <input type="submit" name="submit">
        </form>
    </div>
</div>