<?php

// $router->addRoute('GET', '/users', 'UserController', 'index');
// $router->addRoute('GET', '/users/create', 'UserController', 'create');
// $router->addRoute('POST', '/users', 'UserController', 'store');

Router::get('/users', [UserController::class, 'index']);

Router::get('/users/create', [UserController::class, 'create']);
Router::post('/users', [UserController::class, 'store']);

Router::get('/users/{id}', [UserController::class, 'edit']);
Router::post('/users/{id}/update', [UserController::class, 'update']);

Router::get('/users/{id}/delete', [UserController::class, 'delete']);
