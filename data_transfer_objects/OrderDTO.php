<?php

namespace data_transfer_objects;

class OrderDTO
{
    private $id;
    private $userId;
    private $paymentId;
    private $total;
    private $createdAt;


    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function setPaymentMethodId($paymentId)
    {
        $this->paymentId = $paymentId;
    }

    public function setTotal($total)
    {
        $this->total = $total;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getPaymentMethodId()
    {
        return $this->paymentId;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

}