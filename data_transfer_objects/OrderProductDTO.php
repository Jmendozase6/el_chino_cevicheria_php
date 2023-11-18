<?php

namespace data_transfer_objects;

class OrderProductDTO
{

    private int $id;
    private int $orderId;
    private int $productId;
    private float $quantity;

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setOrderId($orderId): void
    {
        $this->orderId = $orderId;
    }

    public function setProductId($productId): void
    {
        $this->productId = $productId;
    }

    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getQuantity(): float
    {
        return $this->quantity;
    }

}