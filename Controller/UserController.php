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
        if (isset($_POST['submit'])) {
            $email = trim(filter_var($_POST['email']), FILTER_SANITIZE_EMAIL);
            $username = trim(filter_var($_POST['username']), FILTER_SANITIZE_STRING);
            $password = password_hash($_POST['password'], PASSWORD_ARGON2I);

            $confirm_code_range = 12;
            $confirm_code = "";

            for ($i = 0; $i < $confirm_code_range; $i++) {
                $confirm_code .= mt_rand(0, 9);
            }
            if (UserManager::register($email, $username, $password, $confirm_code)) {
                $user = UserManager::getUserByUserName($username);
                $id = $user->getId();
                $message =
                    '<html lang="en">
                           <head>
                                <meta charset="UTF-8">
                                <meta name="viewport"
                                      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                                 <title>Document</title>
                            </head>
                            <body>
                                 <p>Pour finalisez votre inscription veuillez cliquer sur le lien ci-dessous :</p>
                                 <div style="display: flex; justify-content: center; align-items: center">
                                        <button style="width: 50%; padding: 1.2rem; border: 1px solid black; background: cornflowerblue; border-radius: 6px"><a style="text-decoration: none; color: white" href="http://localhost:8000/?c=user&a=check-mail&us='.$username.'&id='.$id.'">Confirmez votre compte</a></button>
                                 </div>
                           </body>
                    </html>
                ';

                $to = $email;
                $subject = "Confirmation de votre compte gameSite";
                $headers = array(
                    'Reply-To' => 'gameSiteSupport@gmail.com',
                    'X-Mailer' => 'PHP/' . phpversion(),
                    'Mime-Version' => '1.0',
                    'Content-type' => 'text/html; charset=utf-8'

                );

                mail($to, $subject, $message, $headers, '-f gameSiteSupport@gmail.com');

                header("Location: /?c=home");
            } else {
                $this->render('error/404');
            }
        }
    }

    public function login()
    {
        $this->render('user/login');

        if (isset($_POST['submit'])) {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password_decode = $_POST['password'];
            UserManager::login($email, $password_decode);
            header("Location: /?c=home");
        }
    }

    public function dislog()
    {
        session_destroy();
        session_unset();
        header("Location: /?c=home");
    }

    public function contact()
    {
        $this->render('user/contact');
    }

    public function checkMail(string $us, int $id)
    {
        if (UserManager::userExist($id)) {
            UserManager::editConfirmationStatus(UserManager::getUserByUserName($us));
            header("Location: /?c=user&a=login");
        }
        else {
            header("Location: /?c=home");
        }


    }

    public function profile()
    {
        $this->render('user/profile', [
            "user" => UserManager::getUserById($_SESSION['user']->getId()),
        ]);
    }

    public function delete ()
    {
        if (isset($_SESSION['user'])){
            UserManager::deleteUser($_SESSION['user']->getId());
            self::dislog();
            header("Location: /?c=home");
        }

    }
}