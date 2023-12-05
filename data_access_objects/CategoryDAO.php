<?php

require_once __DIR__ . '/../datasource/db_connection.php';

class CategoryDAO
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = DbConnection::connect();
    }

    public function createCategory(string $name, string $img): bool
    {
        try {
            $sql =
                /** @lang text */
                "INSERT INTO category (name, img) VALUES (?, ?)";
            $query = $this->conn->prepare($sql);
            $query->bindParam(1, $name);
            $query->bindParam(2, $img);
            $query->execute();
            return $query->rowCount() > 0;
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function updateCategory(string $name, string $img, string $id): bool
    {
        try {
            if (empty($img)) {
                $sql = /** @lang text */
                    "UPDATE category SET name = ? WHERE id = ?";
                $query = $this->conn->prepare($sql);
                $query->bindParam(1, $name);
                $query->bindParam(2, $id);
            } else {
                $sql = /** @lang text */
                    "UPDATE category SET name = ?, img = ? WHERE id = ?";
                $query = $this->conn->prepare($sql);
                $query->bindParam(1, $name);
                $query->bindParam(2, $img);
                $query->bindParam(3, $id);
            }
            $query->execute();
            return $query->rowCount() > 0;
        } catch (Exception $e) {
            return false;
        }
    }

    public
    function deleteCategory($idCategory): bool
    {
        try {
            $sql = /** @lang text */
                "DELETE FROM category WHERE id = ?";
            $query = $this->conn->prepare($sql);
            $query->bindValue(1, $idCategory);
            $query->execute();
            return $query->rowCount() > 0;
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function getCategories($limit = 6): array
    {
        try {
            $sql =
                /** @lang text */
                "SELECT * FROM category LIMIT $limit";
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    public function getCategoriesWithProducts($limit = 6): false|array
    {
        try {
            $sql =
                /** @lang text */
                "SELECT c.id, c.name, c.created_at, c.img, COUNT(p.id) AS product_count
                FROM category c
                         LEFT JOIN product p ON c.id = p.id_category
                GROUP BY c.id
                HAVING product_count > 0 LIMIT $limit";
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    public function getCategoryById($id)
    {
        $sql =
            /** @lang text */
            "SELECT * FROM category WHERE id = ?";
        $query = $this->conn->prepare($sql);
        $query->bindParam(1, $id);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function quantityProductsByCategory($id)
    {
        try {
            $sql =
                /** @lang text */
                "SELECT COALESCE(COUNT(*), 0) AS quantity
                FROM product
                WHERE id_category = ?";
            $query = $this->conn->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return 0;
        }
    }
}