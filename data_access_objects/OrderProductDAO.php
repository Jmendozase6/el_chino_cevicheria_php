<?php

require_once __DIR__ . '/../datasource/db_connection.php';

class OrderProductDAO
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = DbConnection::connect();
    }

    public function getMostSellProducts(): false|array
    {
        try {
            $sql =
                /** @lang text */
                "SELECT product_id, SUM(quantity) AS total_quantity
                FROM order_product
                GROUP BY product_id
                ORDER BY total_quantity DESC
                LIMIT 2";
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    public function getOrders(): array
    {
        try {
            $sql =
                /** @lang text */
                "SELECT *
                FROM `order`";
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    public function getOrdersByDate($fromDate, $toDate)
    {
        try {
            $sql =
                /** @lang text */
                "SELECT *
                FROM `order`
                WHERE created_at BETWEEN ? AND ?";
            $query = $this->conn->prepare($sql);
            $query->bindParam(1, $fromDate);
            $query->bindParam(2, $toDate);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    public function getTotalSell($fromDate, $toDate)
    {
        {
            $sql =
                /** @lang text */
                "SELECT COALESCE(SUM(total), 0) AS total_sales
                FROM `order`
                WHERE created_at BETWEEN ? AND ?";
            $query = $this->conn->prepare($sql);
            $query->bindParam(1, $fromDate);
            $query->bindParam(2, $toDate);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function getOrdersByDay(): array
    {
        try {
            $sql =
                /** @lang text */
                "SELECT *
                FROM `order`
                WHERE created_at = curdate()";
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    public function getOrdersWithUsers($fromDate, $toDate, $limit = 3): false|array
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

    public function createOrderProduct($orderId, $productId, $quantity): bool
    {
        try {
            $sql =
                /** @lang text */
                "INSERT INTO order_product (order_id, product_id, quantity) VALUES (?, ?, ?)";
            $query = $this->conn->prepare($sql);
            $query->bindParam(1, $orderId);
            $query->bindParam(2, $productId);
            $query->bindParam(3, $quantity);
            return $query->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getOrdersProductsByOrderId($orderId): array
    {
        try {
            $sql =
                /** @lang text */
                "SELECT p.name, p.description, p.image, p.price, op.quantity, (p.price * op.quantity) as subtotal
                    FROM order_product as op
                             INNER JOIN product as p
                             ON op.product_id = p.id
                WHERE op.order_id = ?";
            $query = $this->conn->prepare($sql);
            $query->bindParam(1, $orderId);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

}
