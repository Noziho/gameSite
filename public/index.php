<?php
$page = $_GET['p'] ?? 'home';
$page = strip_tags($page);

redirect(sprintf(__DIR__.'/../%s.php', $page));

function redirect (string $pagename) {
    require file_exists($pagename) ? $pagename : __DIR__ . '/../404.php';
}