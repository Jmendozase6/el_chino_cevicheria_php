<?php

namespace data_transfer_objects;

class ReviewDTO
{
    private int $id;
    private int $userId;
    private string $review;

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    public function setReview($review): void
    {
        $this->review = $review;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getReview(): string
    {
        return $this->review;
    }

}