<?php

namespace App\Model\Manager;

use App\Model\DB_Connect;
use App\Model\Entity\AllChatEntity;
use DateTime;

class GlobalChatManager {

    public static function getAll(string $table): array
    {
        $messages = [];

        $query = DB_Connect::dbConnect()->query("SELECT * FROM " . $table);

        if ($query) {
            foreach ($query->fetchAll() as $messageData) {
                $messages[] = self::makeMessage($messageData);
            }
        }
        return$messages;

    }

    public static function addMessage (AllChatEntity $message, string $table): bool
    {
        $stmt = DB_Connect::dbConnect()->prepare("
            INSERT INTO ". $table ." (content, user_fk, time) VALUES (:content, :author, :time)
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

    private static function makeMessage($data): AllChatEntity
    {
        return (new AllChatEntity())
            ->setId($data['id'])
            ->setContent($data['content'])
            ->setAuthor(UserManager::getUserById($data['user_fk']))
            ->setDateTime($data['time']);
    }

    public static function messageExist(int $id, string $table): string
    {
        $query = DB_Connect::dbConnect()->query("SELECT count(*) as cnt FROM " . $table . " WHERE id = $id");
        return $query ? $query->fetch()['cnt'] : 0;
    }

    public static function deleteMessage(int $id, string $table): void
    {
        $query = DB_Connect::dbConnect()->query("DELETE FROM ".$table." WHERE id = $id ");
        $query->execute();
    }

    public static function getMessagesByUserId (int $user_fk, string $table): array
    {
        $messages = [];

        $query = DB_Connect::dbConnect()->query("SELECT * FROM " . $table . " WHERE user_fk = $user_fk ORDER BY id DESC LIMIT 100");
        if ($query) {
            foreach ($query->fetchAll() as $messageData) {
                $messages[] = self::makeMessage($messageData);
            }
        }

        return $messages;
    }

    public static function deleteMessages (int $user_fk, int $limit, string $table): void
    {
        $stmt = DB_Connect::dbConnect()->prepare("
            DELETE FROM ". $table ." WHERE user_fk = :user_fk ORDER BY id DESC LIMIT $limit ");

        $stmt->bindParam(':user_fk', $user_fk);


        $stmt->execute();
    }

}