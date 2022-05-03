<?php


$messages = [
    "Error: Un champ est manquant.",
    "Error: La longueur du mot de passe doit-être comprise entre 8 et 25 caractères.",
    "Error: Le password doit contenir au moins une minuscule, une majuscule, un chiffre et faire une longueur minimal de 8 caractères.",


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

<h1>Réinitialisation de votre mot de passe</h1>

<div class="container">
    <div id="new-password">
        <form action="/?c=user&a=new-password&mi=<?= $_GET['mi'] ?>" method="post">
            <label for="password">Nouveau mot de passe</label>
            <input type="password" name="password" id="password" minlength="8" maxlength="25" required>

            <input type="submit" name="submit">
        </form>
    </div>
</div>
