<?php

use App\Controller\AbstractController;

class ErrorController extends AbstractController
{

    public function index()
    {

    }

    public function error404 ($askPage) {
        $this->render('error/404');
    }
}