<?php

namespace App\Controller;

use App\Model\Entity\AllChatEntity;
use App\Model\Manager\GlobalChatManager;

class GlobalChatController extends AbstractController
{

    public function index()
    {
        $this->render('chat/selectChat');
    }

    public function global()
    {
        $this->render('chat/global');
    }

    public function forza ()
    {
        $this->render('chat/forza');
    }

    public function lostArk ()
    {
        $this->render('chat/lostark');
    }

    public function sot () {
        $this->render('chat/seaofthieves');
    }

    public function checkTable (string $chat): string
    {

        if ($chat === 'lostark') {
            $chat = 'ndmp22_lost_ark_chat';
        }
        else if ($chat === 'forza') {
            $chat = 'ndmp22_forza_chat';
        }
        else if ($chat === 'sot') {
            $chat = 'ndmp22_sot_chat';
        }
        else if ($chat === 'global') {
            $chat = 'ndmp22_global_chat';
        }
        return $chat;
    }

    public function getAll(string $chat): void
    {
        $chat = $this->checkTable($chat);

            $messages = [];
            foreach (GlobalChatManager::getAll($chat) as $key => $message) {
                /* @var AllChatEntity $message */
                $messages[$key]['content'] = $message->getContent();
                $messages[$key]['author'] = $message->getAuthor()->getUsername();
                $messages[$key]['time'] = $message->getDateTime();
            }

            echo json_encode($messages);
    }

    /**
     * @param int|null $id
     * @return void
     * delete 1 target message
     */
    public function deleteMessage(string $chat, int $id = null): void
    {
        if (null === $id) {
            header("Location: /?c=home");
        }

        $chat = $this->checkTable($chat);

        if (AbstractController::isAdmin() || AbstractController::isModerator()) {
            if (GlobalChatManager::messageExist($id, $chat)) {
                GlobalChatManager::deleteMessage($id, $chat);
                header("Location: /?c=user&a=users-list&f=2");
            } else {
                header("Location: /?c=user&a=users-list&f=4");
            }
        } else {
            header("Location: /?c=home");
        }

    }

    /**
     * @param int|null $id
     * @return void
     * delete X last messages.
     */
    public function deleteMessages(string $chat, int $id = null): void
    {
        if (null === $id) {
            header("Location: /?c=home");
            exit();
        }

        $chat = $this->checkTable($chat);

        if (AbstractController::isAdmin() || AbstractController::isModerator()) {
            if (isset($_POST['submit'])) {
                if (!AbstractController::formIsset('limitNumber')) {
                    header("Location: /?c=user&a=users-list&f=3");
                    exit();

                }
                $limit = filter_var($_POST['limitNumber'], FILTER_SANITIZE_NUMBER_INT);

                if (!filter_var($limit, FILTER_VALIDATE_INT)) {
                    header("Location: /?c=user&a=users-list&f=5");
                    exit();
                }

                GlobalChatManager::deleteMessages($id, $limit, $chat);
                header("Location: /?c=user&a=users-list&f=6");

            } else {
                header("Location: /?c=user&a=users-list&f=7");
            }
            exit();
        } else {
            header("Location: /?c=home");
        }

    }
}