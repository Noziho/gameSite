<?php

namespace App\Controller;

use App\Model\Manager\ArticleManager;


class ArticleController extends AbstractController
{

    public function index()
    {
        $this->render('games/game', [
            'articles' => ArticleManager::getAll(),
        ]);
    }

    /**
     * @return void
     * add article into DB.
     */
    public function addGame(): void
    {
        if (isset($_POST['submit'])) {

            $content = strip_tags($_POST['content'],
                '<div><p><img src="" alt=""><h1><h2><h3><h4></h4><h5><br><span>');

            if (ArticleManager::addArticle($content, $_SESSION['user']->getId())) {
                header("Location: /?c=article");
            }
        }
    }


    /**
     * @param int|null $id
     * @return void
     * delete game article.
     */
    public function deleteGame(int $id = null): void
    {
        if (null === $id) {
            header("Location:/?c=article");
        }

        if (AbstractController::isAdmin())
        {
            if (ArticleManager::articleExist($id)) {
                ArticleManager::deleteArticle($id);
                header("Location:/?c=article&f=0");
                exit();
            }
            else {
                header("Location: /?c=article&f=1");
            }
        }
        else {
            header("Location: /?c=home");
        }
    }

    /**
     * @param int|null $id
     * @return void
     * edit article
     */
    public function editGame (int $id = null): void
    {

        if (null === $id) {
            header("Location:/?c=article");
        }

        if (AbstractController::isAdmin()) {
            if (ArticleManager::articleExist($id)) {
                $this->render('games/editGame', [
                    'game' => ArticleManager::getArticleById($id),
                ]);
            }
            else {
                header("Location: /?c=article&f=1");
                exit();
            }

            if (isset($_POST['submit'])) {
                $content = strip_tags($_POST['content'],
                    '<div><p><img><h1><h2><h3><h4></h4><h5><br><span>');
                ArticleManager::editArticle($id, $content);

                exit();
            }
        }
        else {
            header("Location: /?c=home");
        }
    }
}