<?php

use App\Controller\AbstractController;
use App\Model\Entity\Role;
use App\Model\Entity\User;


$messages = [
    "Success: L'utilisateur à été modifier.",
    "Success: L'utilisateur à été mute.",
    "Success: Le message de l'utilisateur à été supprimer.",
    "Error: Des champs sont manquant.",
    "Error: Le message à déjà été supprimer.",
    "Error: La valeur saisi n'est pas valide.",
    "Success: Les messages ont bien été supprimer.",
    "Error: Le boutton d'envoi est manquant.",
    "Success: L'utilisateur à été supprimer.",
    "Success: L'utilisateur à été demute.",
];


if (isset($_GET['f'])) {
    $index = (int)$_GET['f'];
    if ($index > count($messages)) {
        header("Location: /?c=user&a=users-list");
        exit();
    }
    $message = $messages[$index]; ?>
    <div class="error-message <?= strpos($message, "Error: ") === 0 ? 'error' : 'success' ?>"><?= $message ?></div>
    <?php
}

if (isset($data['users'])) {
    $users = $data['users'];
} ?>

<div class="container">
    <div id="usersListContainer"><?php
        foreach ($users as $user) {
            /* @var User $user */ ?>
            <div class="usersList">
            <p>Mail: <?= $user->getEmail() ?></p>
            <p>Pseudo: <?= $user->getUsername() ?></p>
            <?php
            foreach ($user->getRole() as $role) {
                /* @var Role $role */ ?>
                <p>Rôle actuel: <?= $role->getName(); ?></p><?php
            }

            if (AbstractController::isAdmin()) { ?>
                <p>Id: <?= $user->getId() ?></p>
                <form id="edit_role" action="/?c=user&a=edit-user-role&id=<?= $user->getId() ?>" method="post">
                        <label for="role">Mofidiez le rôle:</label>
                        <select name="role" id="role">
                            <option value="1">Utilisateur</option>
                            <option value="2">Modérateur</option>
                        </select>

                        <input id="editUser" type="submit" name="submit" value="Modifiez">
                    </form>

                    <div id="delete_edit_button">
                    <a id="deleteUser" href="/?c=user&a=delete-user&id=<?= $user->getId() ?>">Supprimez
                        l'utilisateur</a><br>
                    </div>
                <?php
            }

            if (AbstractController::isAdmin() || AbstractController::isModerator()) { ?>
                    <?php
                    foreach ($user->getRole() as $role) {
                        /* @var Role $role */
                        if ($role->getName() === 'mute') {?>
                            <div>
                                <a href="/?c=user&a=unmute&id=<?= $user->getId() ?>">Demute l'utilisateur</a>
                            </div><?php
                        }
                        elseif ($role->getName() === 'user') {?>
                            <div>
                                <a href="/?c=user&a=mute&id=<?= $user->getId() ?>">Muté l'utilisateur</a>
                            </div>

                            <div>
                                <a href="/?c=user&a=last-messages&id=<?= $user->getId() ?>">Voir les 100 derniers messages</a>
                            </div><?php
                        }
                    }
            } ?>
            </div><?php

        } ?>
    </div>
</div>

