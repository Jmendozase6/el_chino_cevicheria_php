<?php
require_once __DIR__ . '/../datasource/db_connection.php';

class ReviewDAO
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = DbConnection::connect();
    }

    public function getReviews(): array
    {
        $sql =
            /** @lang text */
            "SELECT * FROM review";
        $query = $this->conn->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createReview($idUser, $rating, $comment): void
    {
        $sql =
            /** @lang text */
            "INSERT INTO review (user_id, rating, comment) VALUES (?,?,?)";
        $query = $this->conn->prepare($sql);
        $query->bindParam(1, $idUser);
        $query->bindParam(2, $rating);
        $query->bindParam(3, $comment);
        $query->execute();
    }

    public function deleteReview($idReview): void
    {
        $sql =
            /** @lang text */
            "DELETE FROM review WHERE id = ?";
        $query = $this->conn->prepare($sql);
        $query->bindParam(1, $idReview);
        $query->execute();
    }

}