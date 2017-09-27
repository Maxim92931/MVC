<?php

namespace Scraps;

class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = $_SERVER['DOCUMENT_ROOT'] . '/config/routes.php';
        $this->routes = include($routesPath);
    }

    public function run()
    {
        $uri = $this->getUri();

        if (empty($uri)) {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/UserController.php';
            $controllerObj = new UserController();
            $controllerObj->authorization();
            return;
        }

        $is404 = true;
        foreach ($this->routes as $name => $path) {
            if (preg_match("|$name|", $uri)) {
                $segments = explode('/', preg_replace("|$name|", $path, $uri));
                $controller = ucfirst(array_shift($segments)) . 'Controller';
                $action = array_shift($segments);

                if (strpos($action, "?") != 0) {
                    $action = substr($action, 0, strpos($action, "?"));
                }

                $scrapId = array_shift($segments);

                $controllerFile = $_SERVER['DOCUMENT_ROOT'] . '/controllers/' . $controller . '.php';
                $controller = '\Scraps\\' . $controller;

                if (file_exists($controllerFile)) {
                    $is404 = false;
                    require_once $controllerFile;

                    $controllerObj = new $controller();
                    $result = $controllerObj->$action($scrapId);

                    break;
                }
            }
        }
        if ($is404) {
            header("HTTP/1.0 404 Not Found");
            require $_SERVER['DOCUMENT_ROOT'] . '/error.php';
            exit();
        }
    }

    private function getUri()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
}