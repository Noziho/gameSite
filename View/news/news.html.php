<?php
use App\Controller\AbstractController;
use App\Model\Entity\News;

AbstractController::ifDisconnect();


if (AbstractController::isAdmin()) {?>
    <div id="add-news-container">
        <form action="/?c=news&a=add-news" method="post">
            <textarea name="content" id="add-news" placeholder="Taper vos actualités ici !"></textarea>
            <input class="news-button" type="submit" name="submit">
        </form>
    </div><?php
}
?>

<h1>Actualités</h1>
<div class="container">
    <?php
    if (isset($data['news'])) {
        $news = $data['news'];

        foreach ($news as $newsData) {
            /* @var News $newsData */?>
            <div class="news-container"><?= $newsData->getContent() ?></div><?php
        }
    }
    ?>

</div>
