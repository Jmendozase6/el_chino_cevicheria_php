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
                "INSERT INTO `order` (user_id, payment_id, total, order_status, name_order, last_name_order, address_order, district_order, phone_order, comments_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $query = $this->conn->prepare($sql);
            $query->bindValue(1, $orderDTO->getUserId());
            $query->bindValue(2, $orderDTO->getPaymentId());
            $query->bindValue(3, $orderDTO->getTotal());
            $query->bindValue(4, $orderDTO->getOrderStatus());
            $query->bindValue(5, $orderDTO->getNameOrder());
            $query->bindValue(6, $orderDTO->getLastNameOrder());
            $query->bindValue(7, $orderDTO->getAddressOrder());
            $query->bindValue(8, $orderDTO->getDistrictOrder());
            $query->bindValue(9, $orderDTO->getPhoneOrder());
            $query->bindValue(10, $orderDTO->getCommentsOrder());
            $query->execute();
            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getQuantityOrdersDay(): array
    {
        try {
            $sql = /** @lang text */
                "SELECT COUNT(*) AS quantity
                    FROM `order`
                    WHERE created_at = curdate()";
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function getEarnedByDays(): array
    {
        try {
            $sql = /** @lang text */
                "SELECT 
                    SUM(IF(DAYOFWEEK(created_at) = 2 AND WEEK(created_at) = WEEK(NOW()), total, 0)) AS Lunes,
                    SUM(IF(DAYOFWEEK(created_at) = 3 AND WEEK(created_at) = WEEK(NOW()), total, 0)) AS Martes,
                    SUM(IF(DAYOFWEEK(created_at) = 4 AND WEEK(created_at) = WEEK(NOW()), total, 0)) AS Miércoles,
                    SUM(IF(DAYOFWEEK(created_at) = 5 AND WEEK(created_at) = WEEK(NOW()), total, 0)) AS Jueves,
                    SUM(IF(DAYOFWEEK(created_at) = 6 AND WEEK(created_at) = WEEK(NOW()), total, 0)) AS Viernes,
                    SUM(IF(DAYOFWEEK(created_at) = 7 AND WEEK(created_at) = WEEK(NOW()), total, 0)) AS Sábado,
                    SUM(IF(DAYOFWEEK(created_at) = 1 AND WEEK(created_at) = WEEK(NOW()), total, 0)) AS Domingo
                        FROM `order`";
            $query = $this->conn->prepare($sql);
            $query->execute();
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            return array_values($data[0]);
        } catch (PDOException $e) {
            return [0, 0, 0, 0, 0, 0, 0];
        }
    }

    public function getQuantityOrdersOfWeek(): array
    {
        try {
            $sql = /** @lang text */
                "SELECT
                    SUM(IF(DAYOFWEEK(created_at) = 2, 1, 0)) AS Lunes,
                    SUM(IF(DAYOFWEEK(created_at) = 3, 1, 0)) AS Martes,
                    SUM(IF(DAYOFWEEK(created_at) = 4, 1, 0)) AS Miércoles,
                    SUM(IF(DAYOFWEEK(created_at) = 5, 1, 0)) AS Jueves,
                    SUM(IF(DAYOFWEEK(created_at) = 6, 1, 0)) AS Viernes,
                    SUM(IF(DAYOFWEEK(created_at) = 7, 1, 0)) AS Sábado,
                    SUM(IF(DAYOFWEEK(created_at) = 1, 1, 0)) AS Domingo
                FROM `order`
                WHERE created_at = CURDATE();";

            $query = $this->conn->prepare($sql);
            $query->execute();
            $data = $query->fetchAll(PDO::FETCH_ASSOC);

            return array_values($data[0]);
        } catch (PDOException $e) {
            return [0, 0, 0, 0, 0, 0, 0];
        }
    }

    public function getQuantityOrdersByDay(): array
    {
        try {
            $sql = /** @lang text */
                "SELECT SUM(IF(DAYOFWEEK(created_at) = 2, 1, 0)) AS Lunes,
                   SUM(IF(DAYOFWEEK(created_at) = 3, 1, 0)) AS Martes,
                   SUM(IF(DAYOFWEEK(created_at) = 4, 1, 0)) AS Miércoles,
                   SUM(IF(DAYOFWEEK(created_at) = 5, 1, 0)) AS Jueves,
                   SUM(IF(DAYOFWEEK(created_at) = 6, 1, 0)) AS Viernes,
                   SUM(IF(DAYOFWEEK(created_at) = 7, 1, 0)) AS Sábado,
                   SUM(IF(DAYOFWEEK(created_at) = 1, 1, 0)) AS Domingo
                        FROM `order`";
            $query = $this->conn->prepare($sql);
            $query->execute();
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            return array_values($data[0]);
        } catch (PDOException $e) {
            return [0, 0, 0, 0, 0, 0, 0];
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

    public function getDailySales(): array
    {
        try {
            $sql = /** @lang text */
                "SELECT COALESCE(SUM(total), 0) AS total
                FROM `order`
                WHERE created_at = CURDATE()
                LIMIT 1";
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function updateOrderStatus($orderId, $orderStatus): bool
    {
        $sql = /** @lang text */
            "UPDATE `order` SET order_status = ? WHERE id = ?";
        $query = $this->conn->prepare($sql);
        $query->bindValue(1, $orderStatus);
        $query->bindValue(2, $orderId);
        $query->execute();
        return $query->rowCount() > 0;
    }

    public function getOrderById($orderId): array
    {
        try {
            $sql = /** @lang text */
                "SELECT * FROM `order` WHERE id = ?";
            $query = $this->conn->prepare($sql);
            $query->bindValue(1, $orderId);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

}
