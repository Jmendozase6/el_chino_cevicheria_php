<?php

require_once __DIR__ . '/../datasource/db_connection.php';

class CategoryDAO
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = DbConnection::connect();
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
//$categories = $categoryDAO->getCategories();
//$category = $categoryDAO->getCategoryById(1);
//print_r($categories);
//print_r($category);