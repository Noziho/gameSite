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
        $query = DB_Connect::dbConnect()->query("SELECT * FROM " . self::TABLE);

        if ($query) {
            foreach ($query->fetchAll() as $articlesData) {
                $articles[] = self::makeArticle($articlesData);

            }
        }
        return $articles;
    }

    public static function getArticleById(int $id): ?Article
    {
        $query = DB_Connect::dbConnect()->query("SELECT * FROM " . self::TABLE . " WHERE id = $id");
        return $query->execute() ? self::makeArticle($query->fetch()) : null;
    }

    public static function addArticle(string $content, int $user_fk): bool
    {
        $stmt = DB_Connect::dbConnect()->prepare("
            INSERT INTO " . self::TABLE . " (content, user_fk)
            VALUES(:content, :user_fk)
        ");

        $stmt->bindParam(":content", $content);
        $stmt->bindValue(":user_fk", $user_fk);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }


    /**
     * @param array $data
     * @return Article
     */
    public static function makeArticle(array $data): Article
    {
        return (new Article())
            ->setId($data['id'])
            ->setContent($data['content'])
            ->setUserFk(UserManager::getUserById($data['user_fk']));
    }

    public static function articleExist(int $id): string
    {
        $query = DB_Connect::dbConnect()->query("SELECT count(*) as cnt FROM " . self::TABLE . " WHERE id = $id");
        return $query ? $query->fetch()['cnt'] : 0;
    }

    public static function deleteArticle(int $id): void
    {
        DB_Connect::dbConnect()->query("DELETE FROM " . self::TABLE . " WHERE id = $id ");
    }

    public static function editArticle(int $id, string $content): void
    {
        $stmt = DB_Connect::dbConnect()->prepare("UPDATE " . self::TABLE . " SET content = :content WHERE id = $id");
        $stmt->bindParam(':content', $content);

        $stmt->execute();

    }
}