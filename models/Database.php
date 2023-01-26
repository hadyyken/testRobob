<?php

class Database
{

    private static $db;
    private MySQLi $connection;

    public function __construct()
    {
        $this->connection =
            new MySQLi
            (
                DB_HOST,
                DB_USER,
                DB_PASS,
                DB_NAME,
            );
    }

    function __destruct()
    {
        $this->connection->close();
    }

    public static function getConnection(): MySQLi
    {
        if (self::$db == null) {
            self::$db = new Database();
        }
        return self::$db->connection;
    }


}