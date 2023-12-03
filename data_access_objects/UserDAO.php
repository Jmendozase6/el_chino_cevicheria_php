<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once __DIR__ . '/../datasource/db_connection.php';

class UserDAO
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = DbConnection::connect();
    }

    public function signIn($email, $password)
    {
        try {
            $sql = /** @lang text */
                "SELECT * FROM user WHERE email = ? AND password = ?";
            $query = $this->conn->prepare($sql);
            $query->bindParam(1, $email);
//            encrypt password
            $password = md5($password);
            $query->bindParam(2, $password);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function signUp($email, $password, $name, $phone, $rolId = 2, $address = "", $lastName = ""): bool
    {
        try {
            $sql = /** @lang text */
                "INSERT INTO user (name, last_name, email, password, id_role, address, phone) VALUES (?,?,?,?,?,?,?)";
            $query = $this->conn->prepare($sql);
            $query->bindParam(1, $name);
            $query->bindParam(2, $lastName);
            $query->bindParam(3, $email);
//            encrypt password
            $password = md5($password);
            $query->bindParam(4, $password);
            $query->bindParam(5, $rolId);
            $query->bindParam(6, $address);
            $query->bindParam(7, $phone);
            $query->execute();
            return $query->rowCount() > 0;
        } catch (Exception $e) {
            return false;
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

    public function getBettersCustomers(): array
    {
        try {
            $sql = /** @lang text */
                "SELECT user.*, SUM(total) AS total FROM `order` JOIN user ON user.id = `order`.user_id GROUP BY user_id ORDER BY total DESC";
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
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

    public function setNewPassword($email, $password): bool
    {
        try {
            $sql = /** @lang text */
                "UPDATE user SET password = ? WHERE email = ?";
            $query = $this->conn->prepare($sql);
            $password = md5($password);
            $query->bindParam(1, $password);
            $query->bindParam(2, $email);
            $query->execute();
            return $query->rowCount() > 0;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getClients(): array
    {
        try {
            $sql = /** @lang text */
                "SELECT * FROM user WHERE id_role = 2";
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    public function getQuantityClients()
    {
        try {
            $sql = /** @lang text */
                "SELECT COUNT(*) AS quantity FROM user WHERE id_role = 2";
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC)['quantity'];
        } catch (Exception $e) {
            return 0;
        }
    }

    public function getQuantityClientsByDays(): array
    {
        try {
            $sql = /** @lang text */
                "SELECT SUM(IF(DAYOFWEEK(created_at) = 2, 1, 0)) AS Lunes,
                   SUM(IF(DAYOFWEEK(created_at) = 3, 1, 0)) AS Martes,
                   SUM(IF(DAYOFWEEK(created_at) = 4, 1, 0)) AS Miércoles,
                   SUM(IF(DAYOFWEEK(created_at) = 5, 1, 0)) AS Jueves,
                   SUM(IF(DAYOFWEEK(created_at) = 6, 1, 0)) AS Viernes,
                   SUM(IF(DAYOFWEEK(created_at) = 7, 1, 0)) AS Sábado,
                   SUM(IF(DAYOFWEEK(created_at) = 1, 1, 0)) AS Domingo
                        FROM user;";
            $query = $this->conn->prepare($sql);
            $query->execute();
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            return array_values($data[0]);
        } catch (PDOException $e) {
            return [0, 0, 0, 0, 0, 0, 0];
        }
    }

    public function getAdmins()
    {
        try {
            $sql = /** @lang text */
                "SELECT * FROM user WHERE id != 1 AND id_role = 1";
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function updateProfile($id, $name, $lastName, $address, $phone): bool
    {
        try {
            $sql = /** @lang text */
                "UPDATE user SET name = ?, last_name = ?, address = ?, phone = ? WHERE id = ?";
            $query = $this->conn->prepare($sql);
            $query->bindParam(1, $name);
            $query->bindParam(2, $lastName);
            $query->bindParam(3, $address);
            $query->bindParam(4, $phone);
            $query->bindParam(5, $id);
            $query->execute();
            return $query->rowCount() > 0;
        } catch (Exception $e) {
            return false;
        }
    }

    public function deleteUserById($id): bool
    {
        try {
            $sql = /** @lang text */
                "DELETE FROM user WHERE id = ?";
            $query = $this->conn->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            return $query->rowCount() > 0;
        } catch (Exception $e) {
            return false;
        }
    }

}