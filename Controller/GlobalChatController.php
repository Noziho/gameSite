<?php

namespace App\Controller;

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
}