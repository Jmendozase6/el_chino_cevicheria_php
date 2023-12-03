<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once __DIR__ . '/../datasource/db_connection.php';

class RoleDAO
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = DbConnection::connect();
    }

    public function changeRole($userId, $roleId): void
    {
        try {
            $sql = /** @lang text */
                "UPDATE user SET id_role = ? WHERE id = ?";
            $query = $this->conn->prepare($sql);
            $query->bindParam(1, $roleId);
            $query->bindParam(2, $userId);
            $query->execute();
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function getRoles(): array
    {
        try {
            $sql = /** @lang text */
                "SELECT * FROM role";
            $query = $this->conn->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

}