<?php
$messages = [
    "Success: Un mail de confirmation vous à été envoyez, pour activer votre compte veuillez consulter vos mail.",
    "Error: Un ou plusieurs champ ne sont pas présent",
    "Error: La longueur du champ 'Mail' n'est pas valide, elle doit être comprise entre 8 et 150 caractères",
    "Error: La longueur du champ 'Pseudo' n'est pas valide, il doit être compris entre 4 et 40 caractères. ",
    "Error: La longueur du champ 'Mot de passe' n'est pas valide, il doit être compris entre 8 et 80 caractères. ",
    "Error: L'adresse email n'est pas valide ou n'est pas au format: mail@example.com.",
    "Error: Une erreur est survenu lors de l'enregistrement, veuillez réessayer plus tard, si le problème persiste contacter le support.",

];


if (isset($_GET['f'])) {
    $index = (int)$_GET['f'];
    $message = $messages[$index]; ?>
    <div class="error-message <?= strpos($message, "Error: ") === 0 ? 'error' : 'success' ?>"><?= $message ?></div>
    <?php
}

?>
<div class="container">
    <div id="container-register-form">
        <form action="?c=user&a=register" method="post">
            <div>
                <label for="email">Mail:</label>
                <input id="email" type="email" name="email" minlength="6" maxlength="150" required>
            </div>

            <div>
                <label for="username">Pseudo:</label>
                <input id="username" type="text" name="username" minlength="4" maxlength="40" required>
            </div>

            <div>
                <label for="password">Mot de passe:</label>
                <input id="password" type="password" name="password" minlength="8" maxlength="80" required>
            </div>

            <div>
                <label for="password-repeat">Répéter le mot de passe:</label>
                <input id="password-repeat" type="password" name="password-repeat" minlength="8" maxlength="80" required>
            </div>

            <input type="submit" name="submit" value="S'inscrire" required>

        </form>
    </div>
</div>

