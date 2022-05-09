<?php

namespace App\Controller;

use App\Model\Entity\AllChatEntity;
use App\Model\Manager\LostArkChatManager;

class LostArkChatController extends AbstractController
{

    public function index()
    {
        $this->render('chat/selectChat');
    }

    public function lostArk()
    {
        $this->render('chat/lostark');
    }

    public function getAll(): void
    {
        $messages = [];
        foreach (LostArkChatManager::getAll() as $key => $message) {
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
    public function deleteMessage(int $id = null): void
    {
        if (null === $id) {
            header("Location: /?c=home");
        }

        if (AbstractController::isAdmin() || AbstractController::isModerator()) {
            if (LostArkChatManager::messageExist($id)) {
                LostArkChatManager::deleteMessage($id);
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
    public function deleteMessages(int $id = null): void
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

                LostArkChatManager::deleteMessages($id, $limit);
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