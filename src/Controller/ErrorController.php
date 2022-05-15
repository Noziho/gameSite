<?php

namespace App\Controller;


class ErrorController extends AbstractController
{

    public function index()
    {

    }

    /**
     * @param $askPage
     * @return void
     */
    public function error404 ($askPage): void
    {
        $this->render('error/404');
    }
}