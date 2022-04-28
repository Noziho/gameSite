<?php


namespace App\Controller;

use App\Model\Entity\User;
use App\Model\Manager\ChatManager;
use App\Model\Manager\UserManager;

class UserController extends AbstractController
{

    public function index()
    {
        $this->render('home/home');
    }

    /**
     * @return void
     * Simple function for add an user in database + send a confirmation mail for activate account.
     */
    public function register(): void
    {
        $this->render('user/register');
        if (isset($_POST['submit'])) {
            if (!$this::formIsset('email', 'username', 'password', 'password-repeat', 'submit')) {
                header("Location: /?c=user&a=register&f=1");
                exit();
            }

            $email = trim(filter_var($_POST['email']), FILTER_SANITIZE_EMAIL);
            $username = trim(filter_var($_POST['username']), FILTER_SANITIZE_STRING);
            $password_repeat = $_POST['password-repeat'];
            $password = password_hash($_POST['password'], PASSWORD_ARGON2I);

            if (!password_verify($password_repeat, $password)) {
                header("Location: /?c=user&a=register&f=2");
                exit();
            }

            $this::checkRange($email, 6, 150, '/?c=user&a=register&f=3');
            $this::checkRange($username, 4, 40, '/?c=user&a=register&f=4');
            $this::checkRange($password_repeat, 8, 80, '/?c=user&a=register&f=5');


            $uppercase = preg_match('@[A-Z]@', $password_repeat);
            $lowercase = preg_match('@[a-z]@', $password_repeat);
            $number = preg_match('@\d@', $password_repeat);

            if (!$uppercase || !$lowercase || !$number || strlen($password_repeat) < 8 || strlen($password_repeat) > 25) {
                header("Location: /?c=user&a=register&f=6");
                exit();
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("Location: /?c=user&a=register&f=7");
                exit();
            }
            if (UserManager::mailExist($email)) {
                header("Location: /?c=user&a=register&f=8");
                exit();
            }

            if (UserManager::usernameExist($username)) {
                header("Location: '/?c=user&a=register&f=9");
                exit();
            }

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
                                        <button style="width: 50%; padding: 1.2rem; border: 1px solid black; background: cornflowerblue; border-radius: 6px"><a style="text-decoration: none; color: white" href="http://localhost:8000/?c=user&a=check-mail&us=' . $username . '&id=' . $id . '">Confirmez votre compte</a></button>
                                 </div>
                           </body>
                    </html>
                ';

                $to = $email;
                $subject = "Confirmation de votre compte gameSitee";
                $headers = array(
                    'Reply-To' => 'gameSiteSupport@gmail.com',
                    'X-Mailer' => 'PHP/' . phpversion(),
                    'Mime-Version' => '1.0',
                    'Content-type' => 'text/html; charset=utf-8'

                );

                mail($to, $subject, $message, $headers, '-f gameSiteSupport@gmail.com');

                header("Location: /?c=user&a=register&f=0");
            } else {
                header("Location: /?c=user&a=register&f=10");
            }
        }
    }

    /**
     * @return void
     * Function for print login page + login a user
     */
    public function login(): void
    {
        $this->render('user/login');

        if (isset($_POST['submit'])) {
            if (!$this::formIsset('email', 'password', 'submit')) {
                header("Location: /?c=user&a=login&f=1");
                exit();
            }
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password_decode = $_POST['password'];
            UserManager::login($email, $password_decode);

        }
    }

    /**
     * @return void
     * Simple function for disconnect a user
     */
    public function dislog(): void
    {
        session_destroy();
        session_unset();
        header("Location: /?c=home");
    }

    public function contact()
    {
        $this->render('user/contact');
        if (isset($_POST['submit'])) {
            if (!$this::formIsset('email', 'subject', 'message', 'submit')) {
                header("Location: /?c=user&a=contact&f=1");
                exit();
            }
            $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
            $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
            $reply_to = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

            $this::checkRange($subject, 4, 60, '/?c=user&a=contact&f=2');
            $this::checkRange($message, 20, 255, '/?c=user&a=contact&f=3');
            $this::checkRange($reply_to, 6, 150, '/?c=user&a=contact&f=4');

            if (!filter_var($reply_to, FILTER_VALIDATE_EMAIL)) {
                header("Location: /?c=user&a=contact&f=5");
                exit();
            }
            $headers = array(
                'Reply-To' => $reply_to,
                'X-Mailer' => 'PHP/' . phpversion(),
                'Mime-Version' => '1.0',
                'Content-type' => 'text/html; charset=utf-8'

            );

            mail('gamesitensup@gmail.com', $subject, $message, $headers, '-f ' . $reply_to);
            header("Location: /?c=user&a=contact&f=0");
        }
    }


    /**
     * @param string $us
     * @param int $id
     * @return void
     * Function for edit the confirmation status on DB.
     */
    public function checkMail(string $us, int $id): void
    {
        if (UserManager::userExist($id)) {

            $user = UserManager::getUserByUserName($us);

            if ($user->getConfirm() === 1) {
                header("Location: /?c=home");
                exit();
            }

            UserManager::editConfirmationStatus($user);
            header("Location: /?c=user&a=login");
        } else {
            header("Location: /?c=home");
        }


    }

    public function profile()
    {
        $this->render('user/profile', [
            "user" => UserManager::getUserById($_SESSION['user']->getid()),
        ]);
    }

    /**
     * @return void
     * Simple function for delete the logged user.
     */
    public function delete(): void
    {
        if (isset($_SESSION['user'])) {
            UserManager::deleteUser($_SESSION['user']->getId());
            self::dislog();
            header("Location: /?c=home");
        }

    }

    public function usersList()
    {
        AbstractController::ifNotAdmin();

        $this->render('user/usersList', [
            'users' => UserManager::getAll(),
        ]);
    }

    public function deleteUser(int $id = null)
    {
        AbstractController::ifNotAdmin();

        if (null === $id) {
            header("Location: /?c=home");
        }
        UserManager::deleteUser($id);
        header("Location: /?c=user&a=users-list");
    }

    public function editUser(int $id = null)
    {
        AbstractController::ifNotAdmin();

        if (null === $id) {
            header("Location: /?c=home");
        }
        $currentId = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $role = filter_var($_POST['role'], FILTER_SANITIZE_NUMBER_INT);
        UserManager::editUser($currentId, $role);
        header("Location: /?c=user&a=users-list&f=0");
    }

    public function mute(int $id = null)
    {
        AbstractController::ifNotAdmin();

        if (null === $id) {
            header("Location: /?c=home");
            exit();
        }

        if (UserManager::muteUser($id)) {
            header("Location: /?c=user&a=users-list&f=1");
        }
    }

    public function lastMessages(int $id = null)
    {
        if (!AbstractController::isAdmin()) {
            header("Location: /?c=home");
        }

        if (null === $id) {
            header("Location: /?c=home");
            exit();
        }
        $this->render('user/lastMessages', [
            'messages' => ChatManager::getMessagesByUserId($id),
        ]);
    }
}