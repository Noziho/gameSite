<?php

use App\Controller\AbstractController;
use App\Model\Entity\Role;
use App\Model\Entity\User;
use App\Model\Manager\UserManager;


$user = UserManager::getUserById($_SESSION['user']->getId());
/** @var  User $user */ ?>

<div class="container">
    <div class="global-chat-container">
        <h1>Général chat</h1>
        <div class="global-chat">

        </div>
        <?php
        if (!AbstractController::isMuted()) { ?>
                <div>
                    <input class="send-message" type="text" name="message"
                           placeholder="Écrivez votre message, appuyez sur entrer pour l'envoyer !">
                </div><?php
            } else { ?>
                <p class="send-message">Vous êtes mute</p><?php
            }
        ?>
    </div>

</div>