<?php

use App\Model\Entity\Article;

if (isset($data['game'])) {
    /** @var Article $article  **/
    $article = $data['game'];
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
