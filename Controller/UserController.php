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
        if (isset($_POST['submit']))
        {
            $email = trim(filter_var($_POST['email']), FILTER_SANITIZE_EMAIL);
            $username = trim(filter_var($_POST['username']), FILTER_SANITIZE_STRING);
            $password = password_hash($_POST['password'], PASSWORD_ARGON2I);

            $confirm_code_range = 12;
            $confirm_code = "";

            for ($i = 0; $i < $confirm_code_range; $i++) {
                $confirm_code .= mt_rand(0, 9);
            }
            if (UserManager::register($email, $username, $password, $confirm_code))
            {
                header("Location: /?c=home");
            }
            else {
                $this->render('error/404');
            }
        }
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