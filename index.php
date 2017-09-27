<?php

namespace Scraps;

ini_set('display_errors', 1);
error_reporting(E_ALL);

/*if (isset($_SESSION['user'])) {
    header('Location: scraps');
}*/

session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/components/Router.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/dbConfig.php';

$router = new Router();
$router->run();
