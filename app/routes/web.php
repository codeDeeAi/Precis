<?php

declare(strict_types=1);

namespace App\Routes;

use App\Core\Interfaces\RouteFile;
use App\Controllers\HomeController;
use App\Middlewares\Test;

class Web implements RouteFile
{
    /**
     * Register routes
     * @return Array routes
     */
    public function routes(): array
    {
        return [
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
        ];
    }
}
