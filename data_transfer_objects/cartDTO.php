<?php

namespace data_transfer_objects;

class cartDTO
{
    private $id;
    private $orderId;

    public function __construct($id, $orderId)
    {
        $this->id = $id;
        $this->orderId = $orderId;
    }

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


}