<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller as BaseController;
use App\Middlewares\Test;
use App\Core\Request;
use App\Core\Traits\Utils\CommonHelpers;

class HomeController extends BaseController
{
    use CommonHelpers;

    /**
     * Load functions  like middleware etc that runs before 
     * other controller methods
     * @return void
     */
    public function load(): void
    {
        // new Test();
    }

    public function index()
    {
        $this->app->view->toView(
            $path = 'homepage',
            $data = []
        );
    }

    public function store()
    {
        $this->dd(Request::getBody(), Request::getQuery());
    }

    public function test()
    {
        $this->dd(Request::server());
    }
}
