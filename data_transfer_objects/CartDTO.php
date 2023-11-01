<?php

namespace data_transfer_objects;

class CartDTO
{
    private $id;
    private $orderId;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getOrderId()
    {
        return $this->orderId;
    }

    public function __toString()
    {
        return "id=" . $this->id . ", orderId=" . $this->orderId;
    }


}