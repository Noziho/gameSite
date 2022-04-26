<?php
use App\Controller\AbstractController;
use App\Model\Entity\User;

AbstractController::ifDisconnect();

if (isset($data['user'])) {
    /* @var User $user */
    $user = $data['user'];
}?>

<h1>Votre profile</h1>

<p>Pseudo: <?= $user->getUsername() ?></p>
<p>Mail: <?= $user->getEmail() ?></p>

<a href="/?c=user&a=delete"><button>Supprimez votre compte</button></a>
<span class="warning">/!\ Attention cette action est irréversible !</span>


