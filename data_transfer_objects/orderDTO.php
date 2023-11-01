<?php

namespace data_transfer_objects;

class orderDTO
{
    private int $id;
    private int $userId;
    private int $paymentId;
    private float $total;
    private string $createdAt;

    public function __construct($id, $userId, $paymentId, $total, $createdAt)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->paymentId = $paymentId;
        $this->total = $total;
        $this->createdAt = $createdAt;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    public function setPaymentMethodId($paymentId): void
    {
        $this->paymentId = $paymentId;
    }

    public function setTotal($total): void
    {
        $this->total = $total;
    }

    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getPaymentMethodId(): int
    {
        return $this->paymentId;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

}