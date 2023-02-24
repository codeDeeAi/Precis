<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller as BaseController;
use App\Core\Request;
use App\Core\Traits\Utils\CommonHelpers;

class HomeController extends BaseController
{
    use CommonHelpers;

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
}