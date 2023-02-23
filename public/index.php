<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\HomeController;
use App\Core\Application;

$app = new Application();

$app->router->registerRoutes(
    [
        [
            'method' => 'GET',
            'path' => '/',
            'action' => [HomeController::class, 'index']
        ],
        [
            'method' => 'GET',
            'path' => '/test',
            'action' => 'contact'
        ],

    ]
);

$app->run();
