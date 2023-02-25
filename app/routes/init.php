<?php

declare(strict_types=1);

namespace App\Routes;

use App\Core\Application;
use App\Core\Interfaces\RouteInit;

class Init implements RouteInit
{
    public function __construct(protected Application $app)
    {
        $this->app = $app;
    }

    public function handle(array $route_classes = []): void
    {
        $registered = [];

        foreach ($route_classes as $route_class) {
            $registered = array_merge($registered, (new $route_class)->routes());
        }

        $this->app->router->registerRoutes(
            $registered
        );
    }
}
