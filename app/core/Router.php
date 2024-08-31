<?php

// class Router {
//     private $routes;

//     public function __construct() {
//         $this->routes = [];
//     }

//     public function addRoute($method, $uri, $controller, $action) {
//         $this->routes[] = [
//             'method' => $method,
//             'uri' => $uri,
//             'controller' => $controller,
//             'action' => $action
//         ];
//     }

//     public function route(Request $request) {
//         foreach ($this->routes as $route) {
//             if ($route['method'] === $request->getMethod() && $route['uri'] === $request->getUri()) {
//                 return [
//                     'controller' => $route['controller'],
//                     'action' => $route['action']
//                 ];
//             }
//         }
//         return null;
//     }
// }

class Router {
    private $routes = [];

    // Define a static method for GET routes
    public static function get($uri, $action) {
        $router = self::getInstance();
        $router->addRoute('GET', $uri, $action);
    }

    // Define a static method for POST routes
    public static function post($uri, $action) {
        $router = self::getInstance();
        $router->addRoute('POST', $uri, $action);
    }

    // Define a static method for PUT routes
    public static function put($uri, $action) {
        $router = self::getInstance();
        $router->addRoute('PUT', $uri, $action);
    }

    // Define a static method for DELETE routes
    public static function delete($uri, $action) {
        $router = self::getInstance();
        $router->addRoute('DELETE', $uri, $action);
    }

    // Add a route to the router
    private function addRoute($method, $uri, $action) {
        $this->routes[] = [
            'method' => $method,
            'uri' => $this->parseUri($uri),
            'action' => $action
        ];
    }

    // Parse URI to handle dynamic segments
    private function parseUri($uri) {
        return preg_replace('/\{[a-zA-Z0-9_]+\}/', '([^/]+)', $uri);
    }


    // Match the current request to a route
    public function route(Request $request) {
        foreach ($this->routes as $route) {
            $pattern = '#^' . $route['uri'] . '$#';
            if ($route['method'] === $request->getMethod() && preg_match($pattern, $request->getUri(), $matches)) {
                array_shift($matches); // Remove the full match
                return [
                    'action' => $route['action'],
                    'params' => $matches
                ];
            }
        }
        return null;
    }

    // Singleton pattern to get the single instance of Router
    public static function getInstance() {
        static $instance = null;
        if ($instance === null) {
            $instance = new self();
        }
        return $instance;
    }
}