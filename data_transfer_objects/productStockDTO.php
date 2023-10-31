<?php

namespace data_transfer_objects;

class productStockDTO
{
    private $id;
    private $stock;

    public function __construct($id, $stock)
    {
        $this->id = $id;
        $this->stock = $stock;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getStock()
    {
        return $this->stock;
    }

}