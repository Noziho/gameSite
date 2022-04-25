<?php
$messages = [
    "Success: Votre message à bien été envoyer au support",
    "Error: Un champ est manquant",
    "Error: L'adresse mail n'est pas au format: mail@example.com",

];

if (isset($_GET['f'])) {
    $index = (int)$_GET['f'];
    $message = $messages[$index]; ?>
    <div class="error-message <?= strpos($message, "Error: ") === 0 ? 'error' : 'success' ?>"><?= $message ?></div>
    <?php
}

?>
<div class="container">
    <div id="container-contact-form">
        <form action="/?c=user&a=contact" method="post">
            <div>
                <label for="email">Votre email:</label>
                <input type="email" id="email" name="email">
            </div>

            <div>
                <label for="subject">Objet de la demande:</label>
                <input type="text" id="subject" name="subject" placeholder="Objet de la demande" minlength="4" maxlength="60">
            </div>

            <div>
                <label for="message">Demande pour le support:</label>
                <textarea name="message" id="message" cols="60" rows="10" placeholder="Votre demande..."></textarea>
            </div>

            <input type="submit" name="submit">
        </form>
    </div>
</div>