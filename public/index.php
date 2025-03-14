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
        call_user_func([new $controller(), $method]);
        break;
}
