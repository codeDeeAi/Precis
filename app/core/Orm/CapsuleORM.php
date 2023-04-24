<?php

declare(strict_types=1);

namespace App\Core\Orm;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use App\Core\Config;

final class CapsuleORM
{
    protected $manager;
    /**
     * Class Builder ORM
     * 
     * @author Adeola Bada <dunsin.bada@gmail.com>
     * @package App\Core\Orm
     */
    public function __construct()
    {
        $this->manager = new Capsule;

        $this->addConnection();
    }

    private function addConnection(): void
    {

        $config = Config::main();

        $database_credentials = [
            'driver' => $config['DATABASE_DRIVER'] ?? 'mysql',
            'host' => $config['DATABASE_HOST'] ?? 'localhost',
            'database' => $config['DATABASE_NAME'] ?? '',
            'username' => $config['DATABASE_USERNAME'] ?? '',
            'password' => $config['DATABASE_PASSWORD'] ?? '',
            'charset' => $config['DATABASE_CHARSET'] ?? 'utf8',
            'collation' => $config['DATABASE_COLLATION'] ?? 'utf8_unicode_ci',
            'prefix' => $config['DATABASE_PREFIX'] ?? '',
        ];

        $this->manager->addConnection($database_credentials);
    }

    public function boot(): void
    {
        $this->manager->setEventDispatcher(new Dispatcher(new Container));

        // Make this Capsule instance available globally via static methods... (optional)
        $this->manager->setAsGlobal();

        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $this->manager->bootEloquent();
    }

    public function getManager(): mixed
    {
        return $this->manager;
    }
};
