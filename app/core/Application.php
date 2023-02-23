<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Router;
use App\Core\Request;
use App\Core\View;

class Application
{
    # Properties
    public Router $router;
    public View $view;
    public static SELF $app;

    /**
     * Class App
     * 
     * @author Adeola Bada <dunsin.bada@gmail.com>
     * @package App\Core
     */
    public function __construct()
    {
        self::$app = $this;
        $this->router = new Router(
            new Request,
            new Response
        );
        $this->view = new View();
    }

    public function run()
    {
        $this->router->resolve();
    }
}
