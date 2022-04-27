<?php

namespace App\Model\Manager;

use App\Model\DB_Connect;
use App\Model\Entity\GlobalChat;
use DateTime;

class ChatManager {

    private const TABLE = "ndmp22_global_chat";

    public static function getAll(): array
    {
        $messages = [];

        $query = DB_Connect::dbConnect()->query("SELECT * FROM " . self::TABLE);

        if ($query) {
            foreach ($query->fetchAll() as $messageData) {
                $messages[] = self::makeMessage($messageData);
            }
        }
        return$messages;

    }

    public static function addMessage (GlobalChat &$message): bool
    {
        $stmt = DB_Connect::dbConnect()->prepare("
            INSERT INTO ". self::TABLE ." (content, user_fk, time) VALUES (:content, :author, :time)
        ");

        $dateTime = new DateTime();
        $date = $dateTime->format('H:i:s');

        $stmt->bindValue(':content', $message->getContent());
        $stmt->bindValue(':author', $message->getAuthor()->getId());
        $stmt->bindValue(':time', $date);

        $result = $stmt->execute();
        $message->setId(DB_Connect::dbConnect()->lastInsertId());
        return $result;
    }

    private static function makeMessage($data): GlobalChat
    {
        return (new GlobalChat())
            ->setId($data['id'])
            ->setContent($data['content'])
            ->setAuthor(UserManager::getUserById($data['user_fk']))
            ->setDateTime($data['time']);
    }

}