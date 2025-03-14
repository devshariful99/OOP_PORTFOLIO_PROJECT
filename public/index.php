<?php

require_once "../vendor/autoload.php";

use App\Controllers\LoginController;
use App\Controllers\UserController;
use FastRoute\RouteCollector;

$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('GET', '/', [LoginController::class, 'login']);
    $r->addRoute('POST', '/login', [LoginController::class, 'loginCheck']);
    $r->addRoute('GET', '/logout', [LoginController::class, 'logout']);

    $r->addRoute('GET', '/dashboard', [UserController::class, 'dashboard']);
    $r->addRoute('GET', '/user/index', [UserController::class, 'index']);
    $r->addRoute('GET', '/user/create', [UserController::class, 'create']);
    $r->addRoute('POST', '/user/store', [UserController::class, 'store']);
    $r->addRoute('GET', '/user/edit/{id:\d+}', [UserController::class, 'edit']);
    $r->addRoute('POST', '/user/update/{id:\d+}', [UserController::class, 'update']);
    $r->addRoute('GET', '/user/delete/{id:\d+}', [UserController::class, 'delete']);
    $r->addRoute('GET', '/user/status/{id:\d+}', [UserController::class, 'status']);
});



$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo "404 Not Found";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        echo "405 Method Not Allowed";
        break;
    case FastRoute\Dispatcher::FOUND:
        [$controller, $method] = $routeInfo[1];
        $vars = $routeInfo[2]; // Contains parameters like ['id' => 5]
        call_user_func_array([new $controller(), $method], $vars); // Properly call controller method with parameters
        break;
}
