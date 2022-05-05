<?php

namespace App\Model\Manager;

use App\Model\DB_Connect;
use App\Model\Entity\News;

class NewsManager
{
    const TABLE = 'ndmp22_news';

    public static function addNews(string $content, int $user_fk):bool
    {
        $stmt = DB_Connect::dbConnect()->prepare("
            INSERT INTO " . self::TABLE . " (content, user_fk)
            VALUES (:content, :user_fk)
        ");

        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':user_fk', $user_fk);

        if ($stmt->execute()) {
            return true;
        }
        return false;


    }

    public static function getAll(): array
    {
        $news = [];

        $query = DB_Connect::dbConnect()->query("SELECT * FROM " . self::TABLE. " ORDER BY id DESC");

        if ($query) {
            foreach ($query->fetchAll() as $newsData) {
                $news[] = self::makeNews($newsData);
            }
        }
        return $news;
    }

    public static function makeNews(array $data): News
    {
        return (new News())
            ->setId($data['id'])
            ->setContent($data['content'])
            ->setUserFk($data['user_fk']);
    }

    public static function getNewsById(int $id): ?News
    {
        $query = DB_Connect::dbConnect()->query("SELECT * FROM " . self::TABLE . " WHERE id = $id");
        return $query->execute() ? self::makeNews($query->fetch()) : null;
    }

    public static function newsExist(int $id): string
    {
        $query = DB_Connect::dbConnect()->query("SELECT count(*) as cnt FROM " . self::TABLE . " WHERE id = $id");
        return $query ? $query->fetch()['cnt'] : 0;
    }

    public static function editNews(int $id, string $content): void
    {
        $stmt = DB_Connect::dbConnect()->prepare("UPDATE " . self::TABLE . " SET content = :content WHERE id = $id");
        $stmt->bindParam(':content', $content);

        $stmt->execute();
    }

    public static function deleteNews (int $id): void
    {

        DB_Connect::dbConnect()->query("DELETE FROM " . self::TABLE . " WHERE id = $id ");
    }
}