<?php

class OrderProductDAO
{
    private $conn;

    public function __construct()
    {
        $this->conn = DbConnection::connect();
    }

    public function getMostSellProduct()
    {
        $sql = /** @lang text */
            "SELECT product_id, SUM(quantity) AS total_quantity
                FROM order_product
                GROUP BY product_id
                ORDER BY total_quantity DESC
                LIMIT 1";
        $query = $this->conn->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getTotalSell()
    {
        $sql = /** @lang text */
            "SELECT SUM(total) as total_sales FROM `order`";
        $query = $this->conn->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * SELECT o.id, o.total, u.name
     * FROM `order` as o
     * JOIN user as u
     * ON o.user_id = u.id;
     */
    public function getOrdersWithUsers()
    {
        $sql = /** @lang text */
            "SELECT o.id, o.total, u.name
                FROM `order` as o
                JOIN user as u
                    ON o.user_id = u.id;";
        $query = $this->conn->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}