<?php

use data_transfer_objects\OrderDTO;

require_once __DIR__ . '/../datasource/db_connection.php';

class OrderDAO
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = DbConnection::connect();
    }

    public function createOrder(OrderDTO $orderDTO): string|bool
    {
        try {
            $sql = /** @lang text */
                "INSERT INTO `order` (user_id, payment_id, total, order_status) VALUES (?, ?, ?, ?)";
            $query = $this->conn->prepare($sql);
            $query->bindValue(1, $orderDTO->getUserId());
            $query->bindValue(2, $orderDTO->getPaymentId());
            $query->bindValue(3, $orderDTO->getTotal());
            $query->bindValue(4, $orderDTO->getOrderStatus());
            $query->execute();
            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getOrders(): array
    {
        try {
            $sql = /** @lang text */
                "SELECT * FROM orders";
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function getOrdersByUserId($userId): array
    {
        try {
            $sql = /** @lang text */
                "SELECT * FROM `order` WHERE user_id = ?";
            $query = $this->conn->prepare($sql);
            $query->bindValue(1, $userId);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function updateOrderStatus($orderId, $orderStatus): bool
    {
        $sql = /** @lang text */
            "UPDATE orders SET order_status = ? WHERE id = ?";
        $query = $this->conn->prepare($sql);
        $query->bindValue(1, $orderStatus);
        $query->bindValue(2, $orderId);
        $query->execute();
        return $query->rowCount() > 0;
    }

}
