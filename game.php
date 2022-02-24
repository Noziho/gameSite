<?php

$title = 'Nos jeux';
require __DIR__. '/parts/header.php';
?>


    <div class="swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide">
                <a href="https://google.fr"><img class="swiper_img" src="/assets/img/Forza%20horizon%205.jpg" alt="Forza horizon img"></a>
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
require __DIR__ . '/parts/footer.php';
