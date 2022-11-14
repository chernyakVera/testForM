<?php
//Точка входа
session_start();

try {
    spl_autoload_register(function (string $className) {
        require_once __DIR__ . DIRECTORY_SEPARATOR .'..' . DIRECTORY_SEPARATOR  . $className . '.php';
    });

    $route = $_GET['route'] ?? '';
    $routes = require __DIR__ . DIRECTORY_SEPARATOR .'..' . DIRECTORY_SEPARATOR .'src' . DIRECTORY_SEPARATOR . 'routes.php';

    $isRouteFound = false;
    foreach ($routes as $pattern => $controllerAndAction) {
        preg_match($pattern, $route, $matches);
        if (!empty($matches)) {
            $isRouteFound = true;
            break;
        }
    }

    if (!$isRouteFound) {
        throw new \Exception('Такой страницы не существует.');
    }

    unset($matches[0]);

    $controllerName = $controllerAndAction[0];
    $actionName = $controllerAndAction[1];

    $controller = new $controllerName();
    $controller->$actionName(...$matches);
}
catch (\Exception $e) {
    $error = $e->getMessage();
    require __DIR__ . DIRECTORY_SEPARATOR .'..' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'notFound.php';
}

$c = 1;





















