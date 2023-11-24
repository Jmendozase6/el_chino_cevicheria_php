<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once __DIR__ . '/../datasource/db_connection.php';

class CartDAO
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = DbConnection::connect();
    }

    public function getProductsFromCart(): array
    {
        try {
            $idSession = session_id();
            $sql = /** @lang text */
                "SELECT product.id, product.name, product.description, product.image, product.price, cart.quantity FROM cart INNER JOIN product ON cart.id_product = product.id WHERE cart.id_session = ?";
            $query = $this->conn->prepare($sql);
            $query->bindParam(1, $idSession);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function addProductToCart($idProduct, $quantity): void
    {
        try {
            $idSession = session_id();
            $sql =
                /** @lang text */
                "INSERT INTO cart (id_session, id_product, quantity) VALUES (?, ?, ?)";
            $query = $this->conn->prepare($sql);
            $query->bindParam(1, $idSession);
            $query->bindParam(2, $idProduct);
            $query->bindParam(3, $quantity);
            $query->execute();
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function getProductsIdFromCart(): array
    {
        try {
            $idSession = session_id();
            $sql =
                /** @lang text */
                "SELECT id_product FROM cart WHERE id_session = ?";
            $query = $this->conn->prepare($sql);
            $query->bindParam(1, $idSession);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function deleteProductFromCart($idProduct): void
    {
        try {
            $idSession = session_id();
            $sql =
                /** @lang text */
                "DELETE FROM cart WHERE id_session = ? AND id_product = ?";
            $query = $this->conn->prepare($sql);
            $query->bindParam(1, $idSession);
            $query->bindParam(2, $idProduct);
            $query->execute();
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function changeQuantity($idProduct, $quantity): void
    {
        try {
            $idSession = session_id();
            $sql =
                /** @lang text */
                "UPDATE cart SET quantity = ? WHERE id_session = ? AND id_product = ?";
            $query = $this->conn->prepare($sql);
            $query->bindParam(1, $quantity);
            $query->bindParam(2, $idSession);
            $query->bindParam(3, $idProduct);
            $query->execute();
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function productAlreadyInCart($productId, $products): bool
    {
        try {
            $ids = $this->getProductsIdFromCart();
            foreach ($ids as $id) {
                foreach ($products as $productArray) {
                    foreach ($productArray as $product) {
                        if ($id['id_product'] == $productId) {
                            return true;
                        }
                    }
                }
            }
            return false;
        } catch (Exception $e) {
            return false;
        }
    }

    public function deleteCart($idSession): void
    {
        try {
            $sql = /** @lang text */
                "DELETE * FROM cart WHERE id_session = ?";
            $query = $this->conn->prepare($sql);
            $query->bindParam(1, $idSession);
            $query->execute();
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

}