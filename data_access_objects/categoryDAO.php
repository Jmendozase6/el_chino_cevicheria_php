<?php

namespace data_access_objects;
require_once '../datasource/db_connection.php';

use DbConnection;
use Exception;
use PDO;

class categoryDAO
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = DbConnection::connect();
    }

    public function getCategories(): false|array
    {
        try {
            $sql = /** @lang text */
                "SELECT * FROM category LIMIT 4";
            $query = $this->conn->prepare($sql);
            $query->execute();
            if ($query->rowCount() == 0) {
                return "Categorías no encontradas";
            }
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function getCategoryById($id): false|array
    {
        $sql = /** @lang text */
            "SELECT * FROM category WHERE id = ?";
        $query = $this->conn->prepare($sql);
        $query->bindParam(1, $id);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

}

$categoryDAO = new categoryDAO();
$categories = $categoryDAO->getCategories();
$category = $categoryDAO->getCategoryById(1);
print_r($categories);
print_r($category);