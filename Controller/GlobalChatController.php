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
        }

        echo json_encode($messages);
    }
}