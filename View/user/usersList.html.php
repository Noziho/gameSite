<?php

use App\Controller\AbstractController;
use App\Model\Entity\Role;
use App\Model\Entity\User;

$messages = [
    "Success: L'utilisateur à été modifier avec succès.",
];


if (isset($_GET['f'])) {
    $index = (int)$_GET['f'];
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
                <p>Id: <?= $user->getId() ?></p>
                <p>Mail: <?= $user->getEmail() ?></p>
                <p>Pseudo: <?= $user->getUsername() ?></p>
                <?php
                foreach ($user->getRole() as $role) {
                    /* @var Role $role */ ?>
                    <p>Rôle actuel: <?= $role->getName(); ?></p><?php
                    if ($role->getName() != "admin") {?>
                            <div id="delete_edit_button">
                                <a id="deleteUser" href="/?c=user&a=delete-user&id=<?= $user->getId() ?>">Supprimez l'utilisateur</a><br>
                            </div>
                        <form action="/?c=user&a=edit-user&id=<?= $user->getId() ?>" method="post">
                            <label for="role">Mofidiez le rôle:</label>
                            <select name="role" id="role">
                                <option value="1">Utilisateur</option>
                                <option value="2">Modérateur</option>
                            </select>
                            <input id="editUser" type="submit" name="submit" value="Modifiez">
                        </form><?php
                    }
                }?>


            </div><?php

        } ?>
    </div>
</div>
