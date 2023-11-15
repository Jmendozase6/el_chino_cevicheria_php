<?php

require_once __DIR__ . '/../datasource/db_connection.php';

class UserDAO
{
    private $conn;

    public function __construct()
    {
        $this->conn = DbConnection::connect();
    }

    /**
     * @throws Exception
     */
    public function signIn($email, $password)
    {
        try {
            $sql =
                /** @lang text */
                "SELECT * FROM user WHERE email = ? AND password = ?";
            $query = $this->conn->prepare($sql);
            $query->bindParam(1, $email);
            $query->bindParam(2, $password);
            $query->execute();
            if ($query->rowCount() == 0) {
                return "Usuario no encontrado";
            }
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function getUserById($id)
    {
        try {
            $sql =
                /** @lang text */
                "SELECT * FROM user WHERE id = ?";
            $query = $this->conn->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function getBettersCustomers()
    {
        try {
            $sql =
                /** @lang text */
                "SELECT user.*, SUM(total) AS total FROM `order` JOIN user ON user.id = `order`.user_id GROUP BY user_id ORDER BY total DESC";
            $query = $this->conn->prepare($sql);
            $query->execute();
            if ($query->rowCount() == 0) {
                return "Usuarios no encontrados";
            }
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }
}