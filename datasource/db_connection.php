<?php
include_once 'config.php';

class DbConnection
{

    public static function connect()
    {
        return new PDO(
            DRIVER . ':host=' . HOST . ';dbname=' . BASE . ';port=' . PORT,
            USER,
            PASS
        );
    }
}
