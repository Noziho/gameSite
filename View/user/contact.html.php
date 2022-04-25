<div class="container">
    <div id="container-contact-form">
        <form action="/?c=user&a=contact" method="post">
            <div>
                <label for="email">Votre email:</label>
                <input type="email" id="email" name="email">
            </div>

            <div>
                <label for="subject">Objet de la demande:</label>
                <input type="text" id="subject" name="subject" placeholder="Objet de la demande">
            </div>

            <div>
                <label for="message">Demande pour le support:</label>
                <textarea name="message" id="message" cols="60" rows="10" placeholder="Votre demande..."></textarea>
            </div>

            <input type="submit" name="submit">
        </form>
    </div>
</div>