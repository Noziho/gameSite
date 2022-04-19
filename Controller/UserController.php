<?php


use App\Controller\AbstractController;

class UserController extends AbstractController
{

    public function index()
    {
        $this->render('user/profile');
    }

    public function register()
    {
        $this->render('user/register');
    }

    public function login()
    {
        $this->render('user/login');
    }

    public function contact()
    {
        $this->render('user/contact');
    }
}