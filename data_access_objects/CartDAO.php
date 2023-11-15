<?php

require_once __DIR__ . '/../datasource/db_connection.php';

class CartDAO
{
    private $conn;

    public function __construct()
    {
        $this->conn = DbConnection::connect();
    }

    public function getProductsFromCart()
    {
        try {
            $this->initSession();
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

    public function addProductToCart($idProduct, $quantity)
    {
        try {
            $this->initSession();
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

    public function getProductsIdFromCart()
    {
        try {
            $this->initSession();
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

    public function deleteProductFromCart($idProduct)
    {
        try {
            $this->initSession();
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

    public function updateQuantity($idProduct, $quantity)
    {
        try {
            $this->initSession();
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

    public function productAlreadyInCart($idProduct)
    {
        try {
            $ids = $this->getProductsIdFromCart();
            foreach ($ids as $id) {
                if ($id == $idProduct) {
                    return true;
                }
            }
            return false;
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function deleteCart()
    {
        try {
            $this->initSession();
            $sql = /** @lang text */
                "DELETE * FROM cart WHERE id_session = ?";
            $query = $this->conn->prepare($sql);
            $query->bindParam(1, $idSession);
            $query->execute();
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function initSession()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

}