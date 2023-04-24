<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Interfaces\Controller as InterfacesController;

/**
 * Class Controller
 * 
 * @author Adeola Bada <dunsin.bada@gmail.com>
 * @package App\Core
 */
class Controller implements InterfacesController
{
    protected Application $app;

    public function __construct()
    {
        // TODO Make app a global function, to instanciate once in index page and used globally
        $this->app = Application::$app;
        $this->load();
    }

    /**
     * Load functions  like middleware etc that runs before 
     * other controller methods
     * @return void
     */
    public function load(): void
    {
    }
}
