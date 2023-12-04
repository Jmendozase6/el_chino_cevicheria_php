<?php

require_once __DIR__ . '/../datasource/db_connection.php';

class OrderStatusDAO
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = DbConnection::connect();
    }

    public function getOrderStatus(): array
    {
        try {
            $sql = /** @lang text */
                'SELECT * FROM order_status';
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

}