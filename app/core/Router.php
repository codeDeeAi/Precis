<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Request as Request;
use App\Core\Traits\Utils\CommonHelpers;
use App\Core\Traits\Utils\Routes as RouteHelpers;
use Exception;

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
     * @param String $method
     * @param String $path
     * @param Boolean|String|Array|Callable $callback
     * @param String|Array|Callable $middleware
     * @return Array
     */
    public function route(
        string $method,
        string $path,
        bool|string|array|callable $callback,
        string|array|callable $middleware = []
    ) {
        if (!$this->validateRequestMethod($method)) {
            throw new Exception("Not a valid request method", 500);
        }

        $this->routes[strtolower($method)][$path] = $this->createRouteAction(
            $callback = $callback,
            $middleware = $middleware,
        );
        return;
    }

    /**
     * Resolve and Execute all routes
     */
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod($toLowerCase = true);
        $route_actions = $this->routes[$method][$path] ?? false;
        $callback = $route_actions['action'] ?? false;
        $middleware = $route_actions['middleware'] ?? [];

        $this->runMiddleware($middleware = $middleware);

        $this->handleRouteCallback($callback = $callback);
    }

    /**
     * Register Routes
     * @param Array $routes (accepts array['method', 'path', 'action']
     * @return void
     */
    public function registerRoutes(array $routes): void
    {
        foreach ($routes as $index => $route) {
            if (!isset($route['method'])) {
                throw new Exception($route['method'] . " is not a supported request type, on registerRoutesFunction::$index", 500);
            } else if (!isset($route['path'])) {
                throw new Exception($route['path'] . " path is required on registerRoutesFunction::$index", 500);
            } else if (!isset($route['action'])) {
                throw new Exception($route['action'] . " action is required on registerRoutesFunction::$index", 500);
            } else {
                $this->route(
                    $method = $route['method'],
                    $path = $route['path'],
                    $callback = $route['action'],
                    $middleware = $route['middleware'] ?? []
                );
            }
        }
    }

    /**
     * Validate request methods
     * @param String $method
     * @return Boolean
     */
    private function validateRequestMethod(string $method): bool
    {
        if (!in_array($method, ['get', 'GET', 'post', 'POST', 'put', 'PUT', 'PATCH', 'patch', 'delete', 'DELETE'])) {
            throw new Exception("Not a valid request method", 500);
            return false;
        }
        return true;
    }

    /**
     * Create route action
     * @param Boolean|String|Array|Callable $callback
     * @param String|Array|Callable $middleware
     * @return Array
     */
    private function createRouteAction(
        bool|string|array|callable $callback,
        string|array|callable $middleware = []
    ): array {
        return [
            'action' => $callback,
            'middleware' => $middleware,
        ];
    }

    /**
     * Create route action
     * @param String|Array|Callable $middleware
     * @return void
     */
    private function runMiddleware(
        string|array|callable $middleware = []
    ): void {

        if (is_callable($middleware)) {
            call_user_func($middleware);
        }
        if (is_string($middleware) && !empty($middleware)) {
            call_user_func(new $middleware);
        }
        if (is_array($middleware) && !empty($middleware)) {
            foreach ($middleware as $value) {
                call_user_func(new $value);
            }
        }
    }

    /**
     * Handle/Process route callback
     * @param Boolean|String|Array|Callable $callback
     * @return void
     */
    private function handleRouteCallback(
        bool|string|array|callable $callback
    ): void {
        if ($callback === false) {
            $this->response->setStatusCode(404);
        } else if (is_string($callback)) {
            ## Render view
            $this->toView($callback);
        } else if (is_array($callback)) {
            ## Controller to action
            $class = new $callback[0];
            $action = $callback[1];
            call_user_func([$class, $action]);
        } else if (is_callable($callback)) {
            call_user_func($callback);
        }
        return;
    }
}
