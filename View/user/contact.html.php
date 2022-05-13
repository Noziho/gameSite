<?php
$messages = [
    "Success: Votre message à bien été envoyer au support",
    "Error: Un champ est manquant",
    "Error: La longueur du champ 'Objet de la demande' n'est pas valide, il doit être compris entre 4 et 60 caractères. ",
    "Error: La longueur du champ 'Demande pour le support' n'est pas valide, il doit être compris entre 20 et 255 caractères. ",
    "Error: La longueur du champ 'Votre mail' n'est pas valide, il doit être compris entre 6 et 150 caractères. ",
    "Error: L'adresse mail n'est pas au format: mail@example.com",

];

if (isset($_GET['f'])) {
    $index = (int)$_GET['f'];
    if ($index > count($messages)) {
        header("Location: /?c=user&a=contact");
        exit();
    }
    $message = $messages[$index]; ?>
    <div class="error-message <?= strpos($message, "Error: ") === 0 ? 'error' : 'success' ?>"><?= $message ?></div>
    <?php
}

?>
<div class="container">
    <div id="container-contact-form">
        <form action="/?c=user&a=contact" method="post">
            <div>
                <label for="email">Votre mail:</label>
                <input type="email" id="email" name="email" minlength="6" maxlength="150" required>
            </div>

            <div>
                <label for="subject">Objet de la demande:</label>
                <input id="subject" type="text" name="subject" placeholder="Objet de la demande" minlength="4" maxlength="60" required>
            </div>

            <div>
                <label for="message">Demande pour le support:</label>
                <textarea id="message" name="message" cols="60" rows="10" placeholder="Votre demande..." minlength="20" maxlength="255" required></textarea>
            </div>

            <input type="submit" name="submit">
        </form>
    </div>
</div>