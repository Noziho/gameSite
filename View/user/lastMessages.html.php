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
    </div>

</div>



