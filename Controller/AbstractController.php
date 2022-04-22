<?php

namespace App\Controller;

use Role;
use User;

abstract class AbstractController
{

    abstract public function index ();

    /**
     * @param string $template
     * @param array $data
     * @return void
     * Render function for printing view.
     */
    public function render(string $template, array $data = [])
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
    public function formIsset (...$inputNames): bool
    {
        foreach ($inputNames as $name) {
            if (!isset($_POST[$name])) {
                return false;
            }
        }
        return true;
    }

    public static function ifDisconnect ()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /?c=home");
        }
    }

    public static function isAdmin (): bool
    {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            /* @var User $user */

            foreach ($user->getRole() as $role) {
                /* @var Role $role */
                if ($role->getName() === 'admin') {
                    return true;
                }
            }
        }
        return false;
    }


}