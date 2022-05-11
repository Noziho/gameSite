<?php

use App\Controller\AbstractController;

?>

<div class="container">
    <div class="global-chat-container">
        <h1>Général chat</h1>
        <div class="global-chat">

        </div>
        <?php
        if (AbstractController::isDisconnect()) {?>
        <p class="send-message">Vous devez vous connecter pour envoyer des messages.</p><?php
        }
        elseif (!AbstractController::isMuted()) { ?>
                <div>
                    <input class="send-message" type="text" name="message"
                           placeholder="Écrivez votre message, appuyez sur entrer pour l'envoyer !" minlength="1" maxlength="1000" required>
                </div><?php
            } else { ?>
                <p class="send-message">Vous êtes mute</p><?php
            }?>

    </div>

</div>

<script src="/assets/js/GlobalChatMessage.js"></script>