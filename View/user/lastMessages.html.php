<?php

use App\Model\Entity\AllChatEntity;

?>

<div class="container">
    <!-- For Global Chat -->
    <div class="global-chat-container">
        <h1>Chat général</h1>
        <div class="global-chat">
            <?php

            if (isset($data['GlobalChatMessages'])) {
                $globalMessages = $data['GlobalChatMessages'];

                foreach ($globalMessages as $globalMessage) {
                    /** @var AllChatEntity $globalMessage * */ ?>
                    <div class="globalChatMessage">
                        <p class="message"><?= $globalMessage->getContent() ?></p>
                        <p class="message"><?= $globalMessage->getDateTime() ?></p>
                        <a href="/?c=globalChat&a=delete-message&id=<?= $globalMessage->getId() ?>">Supprimez</a>
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

    <!-- For LostArk Chat -->
    <div class="global-chat-container">
        <h1>Lost Ark Chat</h1>
        <div class="global-chat">
            <?php
            if (isset($data['LostArkChatMessages'])) {
                $lostArkMessages = $data['LostArkChatMessages'];

                foreach ($lostArkMessages as $lostArkMessage) {
                    /** @var AllChatEntity $lostArkMessage * */ ?>
                    <div class="globalChatMessage">
                    <p class="message"><?= $lostArkMessage->getContent() ?></p>
                    <p class="message"><?= $lostArkMessage->getDateTime() ?></p>
                    <a href="/?c=lostArkChat&a=delete-message&id=<?= $lostArkMessage->getId() ?>">Supprimez</a>
                    </div><?php

                }
            } ?>
        </div>
        <form action="/?c=lostArkChat&a=delete-messages&id=<?= (int)$_GET['id'] ?>" method="post">
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

    <!-- For Forza Horizon 5 Chat -->
    <div class="global-chat-container">
        <h1>Forza Chat</h1>
        <div class="global-chat">
            <?php
            if (isset($data['ForzaChatMessages'])) {
                $forzaMessages = $data['ForzaChatMessages'];

                foreach ($forzaMessages as $forzaMessage) {
                    /** @var AllChatEntity $lostArkMessage * */ ?>
                    <div class="globalChatMessage">
                    <p class="message"><?= $forzaMessage->getContent() ?></p>
                    <p class="message"><?= $forzaMessage->getDateTime() ?></p>
                    <a href="/?c=forzaChat&a=delete-message&id=<?= $forzaMessage->getId() ?>">Supprimez</a>
                    </div><?php

                }
            } ?>
        </div>
        <form action="/?c=forzaChat&a=delete-messages&id=<?= (int)$_GET['id'] ?>" method="post">
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

    <!-- For Forza Horizon 5 Chat -->
    <div class="global-chat-container">
        <h1>Sea Of Thieves Chat</h1>
        <div class="global-chat">
            <?php
            if (isset($data['SeaOfThievesChatMessages'])) {
                $seaOfThievesMessages = $data['SeaOfThievesChatMessages'];

                foreach ($seaOfThievesMessages as $seaOfThievesMessage) {
                    /** @var AllChatEntity $lostArkMessage * */ ?>
                    <div class="globalChatMessage">
                    <p class="message"><?= $seaOfThievesMessage->getContent() ?></p>
                    <p class="message"><?= $seaOfThievesMessage->getDateTime() ?></p>
                    <a href="/?c=seaOfThievesChat&a=delete-message&id=<?= $seaOfThievesMessage->getId() ?>">Supprimez</a>
                    </div><?php

                }
            } ?>
        </div>
        <form action="/?c=seaOfThievesChat&a=delete-messages&id=<?= (int)$_GET['id'] ?>" method="post">
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



