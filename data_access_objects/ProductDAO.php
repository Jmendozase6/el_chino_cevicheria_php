<?php

require_once __DIR__ . '/../datasource/db_connection.php';
class ProductDAO
{

    private $conn;

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

    public function getProductsByIdCategory($id)
    {
        $sql =
            /** @lang text */
            "SELECT * FROM product WHERE id_category = ?";
        $query = $this->conn->prepare($sql);
        $query->bindParam(1, $id);
        $query->execute();
        if ($query->rowCount() == 0) {
            return "Productos no encontrados";
        }
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
