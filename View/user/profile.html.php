<?php
if (isset($data['user'])) {
    /* @var User $user */
    $user = $data['user'];
}?>

<h1>Votre profile</h1>

<p>Pseudo: <?= $user->getUsername() ?></p>
<p>Mail: <?= $user->getEmail() ?></p>




