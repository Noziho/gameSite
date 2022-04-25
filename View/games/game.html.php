<?php
if (isset($data['articles']))
{
    $articles = $data['articles'];
}
?>

<div class="swiper">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        <div class="swiper-slide">
            <a href="https://google.fr"><img class="swiper_img" src="/assets/img/Forza%20horizon%205.jpg"
                                             alt="Forza horizon img"></a>
        </div>

        <div class="swiper-slide">
            <img class="swiper_img" src="/assets/img/sea%20of%20thieves%20test.png" alt="Sea of thieves img">
        </div>

        <div class="swiper-slide">
            <img class="swiper_img" src="/assets/img/Lost%20ark.jpg" alt="Lost ark img">
        </div>
    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>

</div>

<?php

use App\Controller\AbstractController;

if (AbstractController::isAdmin()) {
    ?>
    <div id="add-article-container">
        <form action="/?c=article&a=add-game" method="post">
            <textarea name="content" id="add-news" placeholder="Taper votre article ici !"></textarea>
            <input class="news-button" type="submit" name="submit">
        </form>
    </div><?php
}
?>

<div class="container">
    <?php
    foreach ($articles as $articleData) {
        /* @var Article $articleData */?>
        <div class="news-container"><?= $articleData->getContent() ?></div><?php
    }
    ?>

</div>
