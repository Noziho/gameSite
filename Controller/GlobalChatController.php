<?php

namespace App\Controller;

use App\Model\Entity\GlobalChat;
use App\Model\Manager\ChatManager;

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

    public function getAll(): void
    {
        $messages = [];
        foreach (ChatManager::getAll() as $key => $message) {
            /* @var GlobalChat $message */
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
    public function deleteMessage(int $id = null): void
    {
        if (null === $id) {
            header("Location: /?c=home");
        }

        if (AbstractController::isAdmin() || AbstractController::isModerator()) {
            if (ChatManager::messageExist($id)) {
                ChatManager::deleteMessage($id);
                header("Location: /?c=user&a=users-list&f=2");
            } else {
                header("Location: /?c=user&a=users-list&f=4");
            }
        } else {
            header("Location: /?c=home");
        }

    }

    public function deleteMessages(int $id = null)
    {
        if (null === $id) {
            header("Location: /?c=home");
            exit();
        }

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

                ChatManager::deleteMessages($id, $limit);
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