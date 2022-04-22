<?php

use App\Controller\AbstractController;

class NewsController extends AbstractController
{

    public function index()
    {
        $this->render('news/news');
    }
}