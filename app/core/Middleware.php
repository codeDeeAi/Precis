<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Interfaces\Middleware as InterfacesMiddleware;
use App\Core\Request;
use App\Core\Response;

/**
 * Class Middleware
 * 
 * @author Adeola Bada <dunsin.bada@gmail.com>
 * @package App\Core
 */
class Middleware implements InterfacesMiddleware
{
    protected Application $app;
    protected Request $request;
    protected Response $response;

    public function __construct()
    {
        $this->app = Application::$app;
        $this->request = new Request();
        $this->response = new Response();
        $this->handle();
    }
    /**
     * Handle method
     */
    public function handle()
    {
    }
}
