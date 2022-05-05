<?php

use App\Router;
use Symfony\Component\ErrorHandler\Debug;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../Router.php';
require __DIR__ . '/../Model/DB_Connect.php';
require __DIR__ . '/../Config.php';

session_start();

try {
    Router::route();
}
catch (ReflectionException $e) {
    echo "Une erreur est survenu avec le rooter";
}