<?php

require_once 'app/core/Request.php';
require_once 'app/core/Router.php';
require_once 'app/core/Controller.php';
require_once 'app/helpers/Redirect.php';
require_once 'app/helpers/View.php';
require_once 'app/controllers/UserController.php';
require_once 'app/core/Database.php';
require_once 'app/core/QueryBuilder.php';
require_once 'app/core/Model.php';
require_once 'app/models/User.php';
require_once 'app/helpers/functions.php';

$request = new Request();
// $router = new Router();
$router = Router::getInstance();

require_once 'routes/web.php';

// Route the request
$route = $router->route($request);

if ($route) {
    list($controllerClass, $method) = $route['action'];
    $controller = new $controllerClass($request);
    call_user_func_array([$controller, $method], $route['params']);
} else {
    http_response_code(404);
    echo 'Page not found';
}

// Get the URL path
// $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// // Remove the leading slash
// $path = ltrim($path, '/');

// // Split the path into segments
// $segments = explode('/', $path);

// // Get the controller and action from the segments
// $controller = $segments[0];
// $action = $segments[1] ?? 'index';

// // Route the request
// $route = $router->route($request);

// if ($route) {
//     $controller = new $route['controller']($request);
//     $action = $route['action'];
//     $controller->$action();
// } else {
//     http_response_code(404);
//     echo 'Page not found';
// }