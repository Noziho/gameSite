<?php

if (isset($data['news'])) {
    $news = $data['news'];
}?>

<div class="container">
    <?php
        foreach ($news as $newsData) {
            /* @var News $newsData */?>
            <div class="news-container"><?= $newsData->getContent() ?></div><?php
        }
    ?>

</div>
