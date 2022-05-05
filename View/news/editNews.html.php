<?php

use App\Model\Entity\Article;

if (isset($data['news'])) {
    /** @var Article $news  **/
    $news = $data['news'];
}
$messages = [
    "Success: L'actu à été modifier.",

];


if (isset($_GET['f'])) {
    $index = (int)$_GET['f'];
    if ($index > count($messages)) {
        header("Location: /?c=news&a=edit-news&id=". $news->getId());
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
            <form action="/?c=news&a=edit-news&id=<?= $news->getId() ?>" method="post">
                <textarea name="content" id="edit-news" placeholder="Taper votre actu ici !">
                    <?= $news->getContent() ?>
                </textarea>
                <input class="news-button" type="submit" name="submit">
            </form>
        </div>
    </div>
</div>