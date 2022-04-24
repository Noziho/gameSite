<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../Router.php';
require __DIR__ . '/../Config.php';

use App\Router;

session_start();

try {
    Router::route();
}
catch (ReflectionException $e) {
    echo "Une erreur est survenu avec le rooter";
}