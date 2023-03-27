<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Interfaces\Migration;
use App\Core\Database;
use App\Core\Application;
use Exception;

class Migrations implements Migration
{
    protected Database $database;

    public string $table;

    public string $up_query;

    public string $down_query;

    public function __construct()
    {
        $this->database = Application::$app->database;
    }

    /**
     * Runs Migrations
     * @return Void
     */
    public function up()
    {
        $this->database->query("$this->up_query");
    }

    /**
     * Runs Rollback Migrations
     * @throws Exception
     * @return Void
     */
    public function down()
    {
        if (!$this->checkTableExists()) {
            throw new Exception("Error rolling back migration for table $this->table : Table does not exist in database", 500);
        } else {
            $this->database->query("$this->down_query");
        }
    }


    /**
     * Check if table exists in database
     * @return Bool
     */
    private function checkTableExists(): bool
    {
        $result = $this->database->query("select 1 from `$this->table` LIMIT 1");

        return ($result) ? true : false;
    }
}
