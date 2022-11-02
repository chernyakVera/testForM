<?php
//Точка входа
session_start();

try {
    spl_autoload_register(function (string $className) {
        require_once __DIR__ . '/../' . $className . '.php';
    });

    $route = $_GET['route'] ?? '';
    $routes = require __DIR__ . '/../src/routes.php';

    $isRouteFound = false;
    foreach ($routes as $pattern => $controllerAndAction) {
        preg_match($pattern, $route, $matches);
        if (!empty($matches)) {
            $isRouteFound = true;
            break;
        }
    }

    if (!$isRouteFound) {
        throw new \Exception();
    }

    unset($matches[0]);

    $controllerName = $controllerAndAction[0];
    $actionName = $controllerAndAction[1];

    $controller = new $controllerName();
    $controller->$actionName(...$matches);
}
catch (\Exception $e) {
    require __DIR__ . '/../templates/user/signUp.php';
}

$c = 1;





















