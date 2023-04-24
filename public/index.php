<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Application;
use \Dotenv\Dotenv;
use App\Core\Config;
use App\Routes\Init as RegisterRouteFiles;
use App\Routes\Web as WebRoutes;

Dotenv::createUnsafeImmutable(__DIR__ . '/../')->load();

# Initialize application
$app = new Application();

# Register route files
(new RegisterRouteFiles($app))->handle([
    WebRoutes::class
]);

# Run application
$app->run();
