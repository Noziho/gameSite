<?php

use App\Model\Entity\Article;

if (isset($data['game'])) {
    /** @var Article $article  **/
    $article = $data['game'];
}
$messages = [
    "Success: L'article à été modifier.",

];


if (isset($_GET['f'])) {
    $index = (int)$_GET['f'];
    if ($index > count($messages)) {
        header("Location: /?c=article&a=edit-game&id=". $article->getId());
        exit();
    }
    $message = $messages[$index]; ?>
    <div class="error-message <?= strpos($message, "Error: ") === 0 ? 'error' : 'success' ?>"><?= $message ?></div>
    <?php
}
?>

<div class="container">
    <div>
        <div id="add-article-container">
            <form action="/?c=article&a=edit-game&id=<?= $article->getId() ?>" method="post">
                <textarea name="content" id="add-news" placeholder="Taper votre article ici !">
                    <?= $article->getContent() ?>
                </textarea>
                <input class="news-button" type="submit" name="submit">
            </form>
        </div>
    </div>
</div>
