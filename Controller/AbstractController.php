<?php

namespace App\Controller;

use App\Model\Entity\Role;
use App\Model\Entity\User;
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
        require __DIR__ . "/../View/" . $template . ".html.php";
        $html = ob_get_clean();
        require __DIR__ . "/../View/base.html.php";
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
            header("Location: /?c=home");
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

    public static function ifNotAdmin(): void
    {
        if (!self::isAdmin()) {
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

}