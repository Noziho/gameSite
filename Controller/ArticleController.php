<?php

class ArticleController extends \App\Controller\AbstractController
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