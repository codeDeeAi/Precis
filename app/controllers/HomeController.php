<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller as BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        $this->app->view->toView(
            $path = 'homepage',
            $data = []
        );
    }
}
