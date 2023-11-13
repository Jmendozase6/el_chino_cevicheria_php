<?php

include_once 'config.php';

class DbConnection
{

    public static function connect()
    {
        try {
            $pdo = new PDO(
                DRIVER . ':host=' . HOST . ';dbname=' . BASE . ';port=' . PORT,
                USER,
                PASS
            );
            $pdo->exec("set names utf8");
            return $pdo;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}
