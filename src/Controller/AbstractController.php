<?php

namespace App\Controller;

use App\Model\Entity\Role;
use App\Model\Manager\UserManager;


abstract class AbstractController
{

    abstract public function index();

    /**
     * @param string $template
     * @param array $data
     * @return void
     * Render function for printing view.
     */
    public function render(string $template, array $data = []): void
    {
        ob_start();
        require __DIR__ . "/../../View/" . $template . ".html.php";
        $html = ob_get_clean();
        require __DIR__ . "/../../View/base.html.php";
    }

    /**
     * Checking if form are isset
     * @param ...$inputNames
     * @return bool
     */
    public static function formIsset(...$inputNames): bool
    {
        foreach ($inputNames as $name) {
            if (!isset($_POST[$name]) || empty($_POST[$name])) {
                return false;
            }
        }
        return true;
    }

    public static function ifDisconnect(): void
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /?c=home&f=2");
        }
    }

    public static function isAdmin(): bool
    {
        if (isset($_SESSION['user'])) {
            $id = $_SESSION['user']->getId();

            $user = UserManager::getUserById($id);

            foreach ($user->getRole() as $role) {
                /* @var Role $role */
                if ($role->getName() === 'admin') {
                    return true;
                }
            }
        }
        return false;
    }

    public static function isModerator(): bool
    {
        if (isset($_SESSION['user'])) {
            $id = $_SESSION['user']->getId();

            $user = UserManager::getUserById($id);

            foreach ($user->getRole() as $role) {
                /* @var Role $role */
                if ($role->getName() === 'modérateur') {
                    return true;
                }
            }
        }
        return false;
    }

    public function checkRange(string $value, int $min, int $max, string $redirect): void
    {
        if (strlen($value) < $min || strlen($value) > $max) {
            header("Location: " . $redirect);
            exit();
        }
    }

    public static function isConnected(): void
    {
        if (isset($_SESSION['user'])) {
            header("Location: /?c=home");
            exit();
        }
    }


    public static function isMuted (): bool
    {
        if (isset($_SESSION['user'])) {
            $id = $_SESSION['user']->getId();

            $user = UserManager::getUserById($id);

            foreach ($user->getRole() as $role) {
                /* @var Role $role */
                if ($role->getName() === 'mute') {
                    return true;
                }
            }
        }
        return false;
    }

    public static function isDisconnect (): bool
    {
        if (!isset($_SESSION['user'])) {
            return true;
        }
        return false;
    }

    public static function sanitizeHtmlData ($data): string
    {
        //ENT_QUOTES for replace double quote with simple quotes.
        $data = html_entity_decode($data, ENT_QUOTES, 'UTF-8');
        $data = strip_tags($data, "<div><p><img><h1><h2><h3><h4></h4><h5><br><span><em><i><u>");
        // Pattern for replace event attribute 'on' like 'onclick' 'onkeyup'...
        preg_replace('/(<.+?)(?<=\s)on[a-z]+\s*=\s*(?:([\'"])(?!\2).+?\2|(?:\S+?\(.*?\)(?=[\s>])))(.*?>)/i', "$1 $3", $data );
        return htmlentities($data);
    }

}