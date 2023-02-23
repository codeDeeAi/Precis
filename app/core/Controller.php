<?php

declare(strict_types=1);

namespace App\Core;

class Controller
{
    protected Application $app;

    public function __construct()
    {
        // TODO Make app a global function, to instanciate once in index page and used globally
        $this->app = (new Application());
    }
}