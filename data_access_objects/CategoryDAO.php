<?php

use data_transfer_objects\CategoryDTO;

require_once __DIR__ . '/../datasource/db_connection.php';

class CategoryDAO
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = DbConnection::connect();
    }

    public function createCategory(CategoryDTO $categoryDTO): bool
    {
        try {
            $sql =
                /** @lang text */
                "INSERT INTO category (name, img) VALUES (?, ?)";
            $query = $this->conn->prepare($sql);
            $query->bindValue(1, $categoryDTO->getName());
            $query->bindValue(2, $categoryDTO->getImg());
            $query->execute();
            return $query->rowCount() > 0;
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function updateCategory(CategoryDTO $categoryDTO)
    {
        try {
            $sql = /** @lang text */
                "UPDATE category SET name = ?, img = ? WHERE id = ?";
            $query = $this->conn->prepare($sql);
            $query->bindValue(1, $categoryDTO->getName());
            $query->bindValue(2, $categoryDTO->getImg());
            $query->bindValue(3, $categoryDTO->getId());
            $query->execute();
            return $query->rowCount() > 0;
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function deleteCategory($idCategory): bool
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

    public function getCategories($limit = 4)
    {
        try {
            $sql =
                /** @lang text */
                "SELECT * FROM category LIMIT $limit";
            $query = $this->conn->prepare($sql);
            $query->execute();
            if ($query->rowCount() == 0) {
                return null;
            }
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function getCategoriesById($id)
    {
        $sql =
            /** @lang text */
            "SELECT * FROM category WHERE id = ?";
        $query = $this->conn->prepare($sql);
        $query->bindParam(1, $id);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
//
//$categoryDAO = new categoryDAO();
//$categories_client = $categoryDAO->getCategories();
//$category = $categoryDAO->getCategoryById(1);
//print_r($categories_client);
//print_r($category);