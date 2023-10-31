<?php

namespace data_transfer_objects;

class orderDTO
{

    private $id;
    private $userId;
    private $paymentMethodId;
    private $total;
    private $createdAt;

    public function __construct($id, $userId, $paymentMethodId, $total, $createdAt)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->paymentMethodId = $paymentMethodId;
        $this->total = $total;
        $this->createdAt = $createdAt;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function setPaymentMethodId($paymentMethodId)
    {
        $this->paymentMethodId = $paymentMethodId;
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
        return $this->paymentMethodId;
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