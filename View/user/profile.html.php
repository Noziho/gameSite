<?php
use App\Controller\AbstractController;
use App\Model\Entity\User;

AbstractController::ifDisconnect();

if (isset($data['user'])) {
    /* @var User $user */
    $user = $data['user'];
}?>

<div class="container">
    <div id="profile-container">
        <div>
            <h1>Votre profile</h1>

            <p>Pseudo: <?= $user->getUsername() ?></p>
            <p>Mail: <?= $user->getEmail() ?></p>

            <div id="deleteUserAccount">
                <a href="/?c=user&a=delete">Supprimez votre compte</a>
            </div>
            <span class="warning">/!\ Attention cette action est irréversible !</span>
            <?php
            if (AbstractController::isAdmin()) {?>
                <a class="news-button" href="/?c=user&a=userslist">Listes des utilisateurs</a><?php
            }?>
        </div>
    </div>
</div>




