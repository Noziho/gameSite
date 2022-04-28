<?php

use App\Model\Entity\GlobalChat;

?>

<div class="container">
    <div class="global-chat-container">
        <div class="global-chat">
            <?php
            if (isset($data['messages'])) {
                $messages = $data['messages'];

                foreach ($messages as $message) {
                    /** @var GlobalChat $message * */ ?>
                    <div class="globalChatMessage">
                        <p class="message"><?= $message->getContent() ?></p>
                        <p class="message"><?= $message->getDateTime() ?></p>
                        <a href="/?c=globalChat&a=delete-message&id=<?= $message->getId() ?>">Supprimez</a>
                    </div><?php

                }
            } ?>
        </div>
        <form action="/?c=globalChat&a=delete-messages&id=<?= (int)$_GET['id'] ?>" method="post">
            <label for="limitNumber">Supprimez X derniers messages:</label>
            <select name="limitNumber" id="limitNumber">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
                <option value="30">30</option>
                <option value="35">35</option>
                <option value="40">40</option>
                <option value="45">45</option>
                <option value="50">50</option>
            </select>
            <input class="news-button" type="submit" name="submit" value="Supprimez">
        </form>
    </div>

</div>



