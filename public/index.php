<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Application;

$app = new Application();

$app->router->get('/', function () use ($app) {
    $app->view->toView(
        $path = 'homepage',
        $data = [], 
        $base_path = 'app/views/',
        $extension = '.twig');
    // include_once __DIR__.'/../app/views/homepage.html';
    exit;
});

$app->router->get('/test', 'contact');

$app->run();
