<?php

namespace data_access_objects;

require_once '../datasource/db_connection.php';

use DbConnection;
use Exception;
use PDO;

class userDAO
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
            if ($query->rowCount() == 0) {
                return "Usuario no encontrado";
            }
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

}

$userDAO = new userDAO();
$currentUser = $userDAO->signIn('jhair@gmail.com', '12345');
print_r($currentUser);

// Si el id no es nulo:
if (isset($currentUser['id'])) {
    echo "Bienvenido " . $currentUser['name'];
}