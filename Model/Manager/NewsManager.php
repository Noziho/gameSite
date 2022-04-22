<?php


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

        $query = DB_Connect::dbConnect()->query("SELECT * FROM " . self::TABLE);

        if ($query) {
            foreach ($query->fetchAll() as $newsData) {
                $news[] = (new News())
                    ->setId($newsData['id'])
                    ->setContent($newsData['content'])
                    ->setUserFk($newsData['user_fk']);
            }
        }
        return $news;
    }
}