<?php


use App\Controller\AbstractController;

class ErrorController extends AbstractController
{

    public function index()
    {

    }

    /**
     * @param $askPage
     * @return void
     */
    public function error404 ($askPage) {
        $this->render('error/404');
    }
}