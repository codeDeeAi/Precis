<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Request as Request;
use App\Core\Traits\Utils\CommonHelpers;
use App\Core\Traits\Utils\Routes as RouteHelpers;

/**
 * Class Router
 * 
 * @author Adeola Bada <dunsin.bada@gmail.com>
 * @package App\Core
 */
class Router
{
    use CommonHelpers, RouteHelpers;

    protected array $routes = [];

    public function __construct(
        protected Request $request,
        protected Response $response
    ) {
        $this->request = $request;
        $this->response = $response;

        // Register Routes
    }

    /**
     * Register a route with Get method
     */
    public function get(string $path, bool|string|array|callable $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    /**
     * Resolve and Execute all routes
     */
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod($toLowerCase = true);
        $callback = $this->routes['get'][$path] ?? false;

        if ($callback === false) {
            return $this->response->setStatusCode(404);
        } else if (is_string($callback)) {
            // Render view
            return $this->toView($callback);
        } else if (is_array($callback)) {
            // Map to controller view
        }
        call_user_func($callback);
    }
}
