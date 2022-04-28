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

    public function global ()
    {
        $this->render('chat/global');
    }

    public function getAll() :void
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

    public function deleteMessage (int $id = null)
    {

        if (null === $id) {
            header("Location: /?c=home");
        }

        if (!AbstractController::isAdmin()) {
            header("Location: /?c=home");
        }
        if (ChatManager::messageExist($id)) {
            ChatManager::deleteMessage($id);
            header("Location: /?c=user&a=users-list&f=2");
        }
        else {
            header("Location: /?c=user&a=users-list&f=3");
        }
    }
}