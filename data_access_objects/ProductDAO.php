<?php

require_once 'C:\xampp\htdocs\el_chino_cevicheria\datasource\db_connection.php';

class ProductDAO
{

    private $conn;

    public function __construct()
    {
        $this->conn = DbConnection::connect();
    }

    public function getProductById($id)
    {
        $sql = /** @lang text */
            "SELECT * FROM product WHERE id = :id";
        $query = $this->conn->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

}