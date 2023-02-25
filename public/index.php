<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\HomeController;
use App\Core\Application;
use App\Middlewares\Test;

$app = new Application();

$app->router->registerRoutes(
    [
        [
            'method' => 'GET',
            'path' => '/',
            'action' => [HomeController::class, 'index']
        ],
        [
            'method' => 'POST',
            'path' => '/post',
            'action' => [HomeController::class, 'store']
        ],
        [
            'method' => 'GET',
            'path' => '/test',
            'action' => [HomeController::class, 'test'],
            'middleware' => Test::class
        ],

    ]
);

// var_dump($app->router->routes);

$app->run();
