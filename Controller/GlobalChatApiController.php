<?php

namespace App\Controller;


use App\Model\Entity\AllChatEntity;
use App\Model\Manager\GlobalChatManager;
use DateTime;

class GlobalChatApiController extends AbstractController
{

    public function message(string $chat)
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

        $payload = file_get_contents('php://input');
        $payload = json_decode($payload);

        if (empty($payload->content)) {
            http_response_code(400);
            exit;
        }

        if (!isset($_SESSION['user']) || AbstractController::isMuted()) {
            http_response_code(403);
            exit;
        }

        $content = filter_var($payload->content, FILTER_SANITIZE_STRING);
        $dateTime = new DateTime();
        $time = $dateTime->format('H:i:s');
        $user = $_SESSION['user'];

        $message = (new AllChatEntity())
            ->setContent($content)
            ->setAuthor($user)
            ->setDateTime($time);
        ;


        if (GlobalChatManager::addMessage($message, $chat)) {
            echo json_encode([
                'id' => $message->getId(),
                'content' => $message->getContent(),
                'author' => $message->getAuthor()->getUsername(),
                'time' => $message->getDateTime(),
            ]);
            http_response_code(200);
            exit;
        }
    }

    public function index()
    {
        // TODO: Implement index() method.
    }
}