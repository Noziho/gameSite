<?php


use App\Controller\AbstractController;

class HomeController extends AbstractController
{

    public function index()
    {
        $this->render('home/home');
    }

    public function game()
    {
        $this->render('games/game');
    }
}