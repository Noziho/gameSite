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

    public function addGame ()
    {
        if (isset($_POST['submit'])) {

            if (ArticleManager::addArticle($_POST['content'], $_SESSION['user']->getId())) {
                header("Location: /?c=article");
            }
        }


    }
}