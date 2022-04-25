<?php

namespace App\Model\Manager;



use App\Model\DB_Connect;
use App\Model\Entity\Article;

class ArticleManager
{
    const TABLE = "ndmp22_article";

    /**
     * @return array
     * get all article on DB.
     */
    public static function getAll(): array
    {
        $articles = [];
        $query = DB_Connect::dbConnect()->query("SELECT * FROM ".self::TABLE);

        if ($query) {
            foreach ($query->fetchAll() as $articlesData) {
                $articles[] = self::makeArticle($articlesData);

            }
        }
        return $articles;
    }

    public static function addArticle (string $content, int $user_fk): bool
    {
        $stmt = DB_Connect::dbConnect()->prepare("
            INSERT INTO ".self::TABLE." (content, user_fk)
            VALUES(:content, :user_fk)
        ");

        $stmt->bindParam(":content", $content);
        $stmt->bindValue(":user_fk", $user_fk);

        if ($stmt->execute())
        {
            return true;
        }
        return false;
    }


    /**
     * @param array $data
     * @return Article
     */
    public static function makeArticle (array $data): Article
    {
        return (new Article())
            ->setId($data['id'])
            ->setContent($data['content'])
            ->setUserFk(UserManager::getUserById($data['user_fk']));
    }
}