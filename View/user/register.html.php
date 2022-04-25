<div class="container">
    <div id="container-register-form">
        <form action="?c=user&a=register" method="post">
            <div>
                <label for="email">Mail:</label>
                <input id="email" type="email" name="email" minlength="6" maxlength="150">
            </div>

            <div>
                <label for="username">Pseudo:</label>
                <input id="username" type="text" name="username" minlength="4" maxlength="40">
            </div>

            <div>
                <label for="password">Mot de passe:</label>
                <input id="password" type="password" name="password" minlength="8" maxlength="80">
            </div>

            <div>
                <label for="password-repeat">Répéter le mot de passe:</label>
                <input id="password-repeat" type="password" name="password-repeat" minlength="8" maxlength="80">
            </div>

            <input type="submit" name="submit" value="S'inscrire">

        </form>
    </div>
</div>

