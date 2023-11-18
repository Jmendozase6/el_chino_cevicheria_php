<?php

require_once __DIR__ . '/../datasource/db_connection.php';

class ProductDAO
{

    private PDO $conn;

    public function __construct()
    {
        $this->conn = DbConnection::connect();
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

    public function getProductsByIdCategory($id): false|array
    {
        $sql =
            /** @lang text */
            "SELECT * FROM product WHERE id_category = ?";
        $query = $this->conn->prepare($sql);
        $query->bindParam(1, $id);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
