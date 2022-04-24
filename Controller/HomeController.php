<?php


namespace App\Controller;


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