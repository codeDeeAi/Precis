<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Router;
use App\Core\Request;
use App\Core\View;
use App\Core\Database;
use App\Core\Config;
use App\Core\Orm\CapsuleORM;
use App\Core\Traits\Utils\CommonHelpers;
use \Illuminate\Database\Capsule\Manager as CapsuleManager;


/**
 * Class Application
 * 
 * @author Adeola Bada <dunsin.bada@gmail.com>
 * @package App\Core
 */
class Application
{
    use CommonHelpers;

    # Properties
    public Router $router;
    public View $view;
    public ?Database $database = null;
    public $cli;
    public static SELF $app;
    public CapsuleManager $capsule;

    public function __construct()
    {
        self::$app = $this;
        $this->router = new Router(
            new Request,
            new Response
        );
        $this->view = new View();

        $capsule = new CapsuleORM();

        $capsule->boot();

        $this->capsule = $capsule->getManager();

        if (isset(Config::main()['USE_DATABASE']) && Config::main()['USE_DATABASE'] == true) {
            $this->database = new Database(
                $servername = Config::main()['DATABASE_HOST'],
                $database = Config::main()['DATABASE_NAME'],
                $username = Config::main()['DATABASE_USERNAME'],
                $password = Config::main()['DATABASE_PASSWORD']
            );
        };
    }

    public function run()
    {
        $this->router->resolve();
    }
}
