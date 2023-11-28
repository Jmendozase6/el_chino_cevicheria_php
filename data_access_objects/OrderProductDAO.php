<?php

require_once __DIR__ . '/../datasource/db_connection.php';

class OrderProductDAO
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = DbConnection::connect();
    }

    public function getMostSellProduct()
    {
        $sql =
            /** @lang text */
            "SELECT product_id, SUM(quantity) AS total_quantity
                FROM order_product
                GROUP BY product_id
                ORDER BY total_quantity DESC
                LIMIT 1";
        $query = $this->conn->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getTotalSell($fromDate, $toDate)
    {
        {
            $sql =
                /** @lang text */
                "SELECT SUM(total) as total_sales FROM `order` WHERE created_at BETWEEN ? AND ?";
            $query = $this->conn->prepare($sql);
            $query->bindParam(1, $fromDate);
            $query->bindParam(2, $toDate);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        }
    }

    public
    function getOrdersWithUsers($fromDate, $toDate, $limit = 3): false|array
    {
        $sql =
            /** @lang text */
            "SELECT o.id, o.total, u.name, u.img, o.created_at
            FROM `order` as o
                     JOIN user as u ON o.user_id = u.id
            WHERE o.created_at BETWEEN ? AND ?
                LIMIT $limit";
        $query = $this->conn->prepare($sql);
        $query->bindParam(1, $fromDate);
        $query->bindParam(2, $toDate);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
