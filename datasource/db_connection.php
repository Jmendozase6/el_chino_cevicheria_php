<?php

include_once 'constants.php';

class DbConnection
{

    public static function connect()
    {
        try {

            $isProduction = false;

            if ($isProduction) {
                $pdo = new PDO(
                    DRIVER . ':host=' . HOST . ';dbname=' . P_BASE . ';port=' . PORT,
                    P_USER,
                    P_PASS
                );
            } else {
                $pdo = new PDO(
                    DRIVER . ':host=' . HOST . ';dbname=' . D_BASE . ';port=' . PORT,
                    D_USER,
                    D_PASS
                );
            }
            $pdo->exec("set names utf8");
            return $pdo;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}
