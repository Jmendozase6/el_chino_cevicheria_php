<?php

require_once __DIR__ . '/../datasource/db_connection.php';

class UserDAO
{
    private PDO $conn;

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
            $sql = /** @lang text */
                "SELECT * FROM user WHERE email = ? AND password = ?";
            $query = $this->conn->prepare($sql);
            $query->bindParam(1, $email);
            $query->bindParam(2, $password);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function getUserById($id)
    {
        try {
            $sql = /** @lang text */
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
            $sql = /** @lang text */
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

    public function existsEmail($email)
    {
        try {
            $sql = /** @lang text */
                "SELECT email from user WHERE email = ?";
            $query = $this->conn->prepare($sql);
            $query->bindParam(1, $email);
            $query->execute();
            return $query->rowCount() > 0;
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function setNewPassword($password): bool
    {
        try {
            $this->startSession();
            $email = $_SESSION['recover-email'];
            $sql = /** @lang text */
                "UPDATE user SET password = ? WHERE email = ?";
            $query = $this->conn->prepare($sql);
            $query->bindParam(1, $password);
            $query->bindParam(2, $email);
            $query->execute();
            return $query->rowCount() > 0;
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function startSession(): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

}