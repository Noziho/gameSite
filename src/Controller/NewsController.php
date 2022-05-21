<?php


namespace App\Controller;


use App\Model\Manager\NewsManager;
use App\Model\Manager\UserManager;

class NewsController extends AbstractController
{

    public function index()
    {
        $this->render('news/news', [
            'news' => NewsManager::getAll(),
        ]);
    }


    public function addNews()
    {
        $this->render('news/news');
        if (isset($_POST['submit'])) {
            $content = $_POST['content'];
            $content = self::sanitizeHtmlData($content);

            if (NewsManager::addNews($content, $_SESSION['user']->getId())) {
                header("Location: /?c=news");
                exit();
            }
            header("Location: /?c=news&f=error");
        }
    }

    public function editNews(int $id = null)
    {
        if (null === $id) {
            header("Location: /?c=news");
            exit();
        }
        if (AbstractController::isAdmin()) {
            if (NewsManager::newsExist($id)) {
                $this->render('news/editNews', [
                    'news' => NewsManager::getNewsById($id),
                ]);
            }
            else {
                header("Location /?c=news&f=1");
            }

            if (isset($_POST['submit'])) {
                $content = $_POST['content'];
                $content = self::sanitizeHtmlData($content);

                NewsManager::editNews($id, $content);

            }
        }
        else {
            header("Location /?c=home");
            exit();
        }
    }

    public function deleteNews(int $id = null)
    {

        if (null === $id) {
            header("Location: /?c=news");
            exit();
        }

        if (AbstractController::isAdmin()) {
            if (NewsManager::newsExist($id)) {

                NewsManager::deleteNews($id);
                header("Location: /?c=news&f=0");
            }
            else {
                header("Location /?c=news&f=1");
            }
        }
        else {
            header("Location /?c=home");
            exit();
        }
    }

}