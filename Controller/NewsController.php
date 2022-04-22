<?php

use App\Controller\AbstractController;

class NewsController extends AbstractController
{

    public function index()
    {
        $this->render('news/news', [
            'news' => NewsManager::getAll(),
        ]);
    }


    public function addNews ()
    {
        $this->render('news/add-news');
        if (isset($_POST['submit'])) {
            $content = $_POST['content'];

            if (NewsManager::addNews($content, $_SESSION['user']->getId())) {
                header("Location: /?c=news&a=add-news");
                exit();
            }
            header("Location: /?c=news&f=error");
        }
    }
}