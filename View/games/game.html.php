<?php
use App\Controller\AbstractController;
use App\Model\Entity\Article;

$messages = [
        "Success: L'article à bien été supprimer.",
        "Error: L'article demander n'existe pas ou à déjà été supprimer.",
        "Success: L'article à bien été modifier.",
        "Success: L'article à bien été ajouter."
];


if (isset($_GET['f'])) {
    $index = (int)$_GET['f'];
    if ($index > count($messages)) {
        header("Location: /?c=article");
        exit();
    }
    $message = $messages[$index]; ?>
    <div class="error-message <?= strpos($message, "Error: ") === 0 ? 'error' : 'success' ?>"><?= $message ?></div>
    <?php
}

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
            <a
                    href="#forza"><img class="swiper_img" src="/assets/img/Forza%20horizon%205.jpg" alt="Forza horizon img">
            </a>
        </div>

        <div class="swiper-slide">
            <a href="#sea_of_thieves">
                <img class="swiper_img" src="/assets/img/sea%20of%20thieves.jpg" alt="Sea of thieves img">
            </a>
        </div>

        <div class="swiper-slide">
            <a href="#lost_ark">
                <img class="swiper_img" src="/assets/img/lost_ark.jpg" alt="Lost ark img">
            </a>
        </div>
    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>

</div>

<?php
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
        <div class="news-container">
            <?= html_entity_decode($articleData->getContent()) ?>
        <?php
            if (AbstractController::isAdmin()){?>
            <div class="edit-delete-container">
                <a class="edit_delete" href="/?c=article&a=edit-game&id=<?= $articleData->getId() ?>">Modifier l'article</a>
            </div>

            <div class="edit-delete-container">
                <a class="edit_delete" href="/?c=article&a=delete-game&id=<?= $articleData->getId() ?>">Supprimer l'article</a>
            </div><?php
            }
        ?>

        </div><?php
    }
    ?>

</div>
