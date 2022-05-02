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
                <a href="/?c=user&a=delete" id="delete_profile">Supprimez votre compte</a>
            </div>
            <p id="warning">/!\ Attention cette action est irréversible !</p>
            <?php
            if (AbstractController::isAdmin() || AbstractController::isModerator()) {?>
                <a class="edit_delete" href="/?c=user&a=users-list">Listes des utilisateurs</a><?php
            }?>
        </div>
    </div>
</div>




