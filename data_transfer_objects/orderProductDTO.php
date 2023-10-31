<?php

namespace data_transfer_objects;

class orderProductDTO
{

    private $id;
    private $orderId;
    private $productId;
    private $quantity;

    public function __construct($id, $orderId, $productId, $quantity)
    {
        $this->id = $id;
        $this->orderId = $orderId;
        $this->productId = $productId;
        $this->quantity = $quantity;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getOrderId()
    {
        return $this->orderId;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }


}