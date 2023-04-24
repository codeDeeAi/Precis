<?php

declare(strict_types=1);

namespace App\Core;

use Exception;
use PDO;
use PDOException;

class Database
{
    protected $connection;
    protected $servername;
    protected $database;
    protected $username;

    public function __construct(
        string $servername,
        string $database,
        string $username,
        string $password
    ) {
        $this->servername = $servername;
        $this->database = $database;
        $this->username = $username;

        try {
            $this->connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception('Database Connection failed : ' . $e->getMessage(), 500);
        }
    }

    /**
     * Execute Database Query
     * @param String $query
     * @return Int|Boolean
     */
    public function query(string $query): int|false
    {
        try {
            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->connection->prepare($query);

            $result = $this->connection->exec($query);

            return $result;
        } catch (PDOException $e) {
            throw new Exception("Error Processing Request, {$e->getMessage()}", 500);
        }

        $conn = null;
    }

    // public function runMigrations()
    // {
    //     $this->query("CREATE TABLE Users (
    //   id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //   username VARCHAR(255) NOT NULL,
    //   birthdate DATE NOT NULL,
    //   user_address VARCHAR(255) NOT NULL,
    //   credit_card VARCHAR(255) NOT NULL,
    //   credit_card_expiry VARCHAR(19) NOT NULL,
    //   credit_card_cvv VARCHAR(3) NOT NULL,
    //   avatar VARCHAR(255) NOT NULL
    //   )");
    // }
}
