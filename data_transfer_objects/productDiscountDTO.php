<?php

namespace data_transfer_objects;

class productDiscountDTO
{

    private $id;
    private $discount;

    public function __construct($id, $discount)
    {
        $this->id = $id;
        $this->discount = $discount;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setDiscount($discount)
    {
        $this->discount = $discount;
    }

}