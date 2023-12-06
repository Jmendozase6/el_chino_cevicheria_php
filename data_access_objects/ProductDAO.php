<?php

require_once __DIR__ . '/../datasource/db_connection.php';

class ProductDAO
{

    private PDO $conn;

    public function __construct()
    {
        $this->conn = DbConnection::connect();
    }

    public function createProduct($idCategory, $name, $description, $image, $price, $discount): bool|string
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
            return $e->getMessage();
        }
    }

    public function updateProduct($id, $idCategory, $name, $description, $image, $price, $discount, $active): bool|string
    {
        try {
            if (empty($image)) {
                $sql =
                    /** @lang text */
                    "UPDATE product SET id_category = ?, name = ?, description = ?, price = ?, discount = ?, active = ? WHERE id = ?";
                $query = $this->conn->prepare($sql);
                $query->bindParam(1, $idCategory);
                $query->bindParam(2, $name);
                $query->bindParam(3, $description);
                $query->bindParam(4, $price);
                $query->bindParam(5, $discount);
                $query->bindParam(6, $active);
                $query->bindParam(7, $id);
            } else {
                $sql =
                    /** @lang text */
                    "UPDATE product SET id_category = ?, name = ?, description = ?, image = ?, price = ?, discount = ?, active = ? WHERE id = ?";
                $query = $this->conn->prepare($sql);
                $query->bindParam(1, $idCategory);
                $query->bindParam(2, $name);
                $query->bindParam(3, $description);
                $query->bindParam(4, $image);
                $query->bindParam(5, $price);
                $query->bindParam(6, $discount);
                $query->bindParam(7, $active);
                $query->bindParam(8, $id);
            }
            return $query->execute();
        } catch (Exception $e) {
            return $e->getMessage();
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


    public function deleteProductById($id): bool
    {
        try {
            $sql =
                /** @lang text */
                "DELETE FROM product WHERE id = ?";
            $query = $this->conn->prepare($sql);
            $query->bindParam(1, $id);
            return $query->execute();
        } catch (Exception $e) {
            return false;
        }
    }

    public function getProductsByIdCategory($id): array
    {
        try {
            $sql =
                /** @lang text */
                "SELECT * FROM product WHERE id_category = ? AND active = 1";
            $query = $this->conn->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    public function getProducts($limit = 4, $active = true): array
    {
        try {
            if ($active) {
                $sql =
                    /** @lang text */
                    "SELECT DISTINCT name, id, id_category, description, image, price, active, created_at, discount FROM product WHERE active = 1 ORDER BY id_category LIMIT $limit";
            } else {
                $sql =
                    /** @lang text */
                    "SELECT DISTINCT name, id, id_category, description, image, price, active, created_at, discount FROM product ORDER BY id_category LIMIT $limit";
            }
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }
}