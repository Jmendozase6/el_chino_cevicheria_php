<?php

namespace data_transfer_objects;

class saleDTO
{
    private int $id;
    private int $orderId;

    public function __construct($id, $orderId)
    {
        $this->id = $id;
        $this->orderId = $orderId;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setOrderId($orderId): void
    {
        $this->orderId = $orderId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

}