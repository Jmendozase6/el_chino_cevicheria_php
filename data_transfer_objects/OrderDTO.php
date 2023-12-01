<?php

namespace data_transfer_objects;

class OrderDTO
{
    private int $id;
    private int $userId;
    private int $paymentId;
    private float $total;
    private string $orderStatus;
    private string $createdAt;

    public static function createFromResponse($response): OrderDTO
    {
        $orderDTO = new OrderDTO();
        $orderDTO->setId($response['id']);
        $orderDTO->setUserId($response['user_id']);
        $orderDTO->setPaymentId($response['payment_id']);
        $orderDTO->setTotal($response['total']);
        $orderDTO->setOrderStatus($response['order_status']);
        $orderDTO->setCreatedAt($response['created_at']);
        return $orderDTO;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    public function setPaymentId($paymentId): void
    {
        $this->paymentId = $paymentId;
    }

    public function setTotal($total): void
    {
        $this->total = $total;
    }

    public function setOrderStatus($orderStatus): void
    {
        $this->orderStatus = $orderStatus;
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

    public function getPaymentId(): int
    {
        return $this->paymentId;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function getOrderStatus(): string
    {
        return $this->orderStatus;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

}