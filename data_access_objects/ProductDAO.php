<?php

require_once __DIR__ . '/../datasource/db_connection.php';

class ProductDAO
{

    private PDO $conn;

    public function __construct()
    {
        $this->conn = DbConnection::connect();
    }

    public function createProduct($idCategory, $name, $description, $image, $price, $discount): bool
    {
        try {
            $sql =
                /** @lang text */
                "INSERT INTO product (id_category, name, description, image, price, discount) VALUES (?, ?, ?, ?, ?, ?)";
            $query = $this->conn->prepare($sql);
            $query->bindParam(1, $idCategory);
            $query->bindParam(2, $name);
            $query->bindParam(3, $description);
            $query->bindParam(4, $image);
            $query->bindParam(5, $price);
            $query->bindParam(6, $discount);
            return $query->execute();
        } catch (Exception $e) {
            return false;
        }
    }

    public function getProductById($id)
    {
        $sql =
            /** @lang text */
            "SELECT * FROM product WHERE id = :id";
        $query = $this->conn->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getProductByName($name)
    {
        $sql =
            /** @lang text */
            "SELECT * FROM product WHERE name LIKE '%?%'";
        $query = $this->conn->prepare($sql);
        $query->bindParam(1, $name);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getProductsByIdCategory($id): array
    {
        $sql =
            /** @lang text */
            "SELECT * FROM product WHERE id_category = ?";
        $query = $this->conn->prepare($sql);
        $query->bindParam(1, $id);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProducts($limit = 4): array
    {
        try {
            $sql =
                /** @lang text */
                "SELECT DISTINCT name, id, id_category, description, image, price, active, created_at, discount FROM product LIMIT $limit";
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }
}