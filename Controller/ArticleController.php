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

    public function addGame()
    {
        if (isset($_POST['submit'])) {

            if (ArticleManager::addArticle($_POST['content'], $_SESSION['user']->getId())) {
                header("Location: /?c=article");
            }
        }
    }

    public function deleteGame(int $id = null)
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
}