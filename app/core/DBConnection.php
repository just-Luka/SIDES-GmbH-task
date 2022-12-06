<?php

namespace App\core;

use App\config\Database;

class DBConnection
{
    private $connection;
    private static $instance = null;

    private function __construct()
    {
        $this->connection = new \mysqli(
            Database::SERVERNAME,
            Database::USERNAME,
            Database::PASSWORD,
            Database::DBNAME
        );
    }

    /**
     * @return DBConnection|null
     */
    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new DBConnection();
        }

        return self::$instance;
    }

    /**
     * @return \mysqli
     */
    public function getConnection()
    {
        return $this->connection;
    }
}