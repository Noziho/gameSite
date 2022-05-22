<?php

use App\Controller\AbstractController;
use App\Model\Entity\News;

AbstractController::ifDisconnect();

$messages = [
    "Success: L'actualité à bien été supprimer",
    "Error: L'actualité n'existe pas ou à déjà été supprimer",
];


if (isset($_GET['f'])) {
    $index = (int)$_GET['f'];
    if ($index > count($messages)) {
        header("Location: /?c=news");
        exit();
    }
    $message = $messages[$index]; ?>
    <div class="error-message <?= strpos($message, "Error: ") === 0 ? 'error' : 'success' ?>"><?= $message ?></div>
    <?php
}


if (AbstractController::isAdmin()) { ?>
    <div id="add-news-container">
        <form action="/?c=news&a=add-news" method="post">
            <textarea name="content" id="add-news" placeholder="Taper vos actualités ici !"></textarea>
            <input class="news-button" type="submit" name="submit">
        </form>
    </div><?php
}
?>

<h1 id="news-title">Actualités</h1>
<div class="container">
    <?php
    if (isset($data['news'])) {
        $news = $data['news'];

        foreach ($news as $newsData) {
            /* @var News $newsData */ ?>
            <div class="news-container">
                <?= html_entity_decode($newsData->getContent()) ?>
            <?php
                if (AbstractController::isAdmin()) {?>
                    <div class="edit-delete-container">
                    <a class="edit_delete" href="/?c=news&a=edit-news&id=<?= $newsData->getId() ?>">Modifier</a>
                </div>

                <div class="edit-delete-container">
                    <a class="edit_delete" href="/?c=news&a=delete-news&id=<?= $newsData->getId() ?>">Supprimez</a>
                </div><?php
                }
            ?>

            </div><?php
        }
    }
    ?>

</div>
