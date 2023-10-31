<?php
include_once 'config.php';

class Connection
{
    private static $con;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (isset(self::$con)) {
            echo 'Es nulo';
            self::connect();
        }
        echo 'No Es nulo';
        return self::$con;
    }

    private static function connect()
    {
        self::$con = new PDO(
            DRIVER . ':host=' . HOST . ';dbname=' . BASE . ';port=' . PORT,
            USER,
            PASS
        );
    }
}
