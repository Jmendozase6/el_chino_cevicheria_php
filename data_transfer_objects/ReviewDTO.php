<?php

namespace data_transfer_objects;

class ReviewDTO
{
    private $id;
    private $userId;
    private $review;

    public function __construct($id, $userId, $review)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->review = $review;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function setReview($review)
    {
        $this->review = $review;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getReview()
    {
        return $this->review;
    }

}