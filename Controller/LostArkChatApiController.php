<?php

namespace App\Controller;

use App\Model\Entity\LostArkChat;
use App\Model\Manager\LostArkChatManager;
use DateTime;

class LostArkChatApiController extends AbstractController
{

    public function index()
    {

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

        $message = (new LostArkChat())
            ->setContent($content)
            ->setAuthor($user)
            ->setDateTime($time);
        ;


        if (LostArkChatManager::addMessage($message)) {
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
}